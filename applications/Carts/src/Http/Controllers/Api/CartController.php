<?php

namespace Rezyon\Applications\Carts\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Rezyon\Applications\Carts\Exceptions\ActivityException;
use Rezyon\Applications\Carts\Http\Requests\Api\CartDestroyRequest;
use Rezyon\Applications\Carts\Http\Requests\Api\CartStoreRequest;
use Rezyon\Applications\Carts\Http\Requests\Api\CartUpdateRequest;
use Rezyon\Applications\Carts\Http\Requests\Api\DiscountRequest;
use Rezyon\Applications\Carts\Http\Requests\Api\RemoveDiscountRequest;
use Rezyon\Applications\Carts\Http\Resources\CartCollection;
use Rezyon\Carts\Carts;
use Rezyon\Carts\Exceptions\ActivityAlreadyInCartException;
use Rezyon\Carts\Services\CartService;
use Rezyon\Discounts\Services\DiscountService;
use Rezyon\Supplier\Enums\ActivityStatusEnum;
use Rezyon\Supplier\Enums\PriceRuleGenders;
use Rezyon\Supplier\Enums\PriceRuleOperators;
use Rezyon\Supplier\Enums\PriceRules;
use Rezyon\Supplier\Enums\PriceTypes;
use Rezyon\Supplier\Services\ActivityService;

class CartController extends Controller
{
    public function check(
        Request $request,
        CartService $service
    )
    {
        $items = $service->getCart($request->user()->id);
        foreach($items as $item) {
            if($item->activity && $item->activity->status && $item->activity->tourismCompanyProfitability && $item->activity->status === ActivityStatusEnum::ACTIVE) {
                $selectedDate = Carbon::parse($item->selected_time);
                $selectedDay = ($selectedDate->dayOfWeek + 6) % 7 + 1;
                $session = $item->activity->sessions->filter(function($session) use ($service, $item) {
                    return $session->id === $item->activity_session_id;
                })->first();
                if($session) {
                    $capacityCount = $service->getCapacityCount($session->id, $item->selected_time, $item->activity_id);
                    if(($item->adult + $item->child + $item->baby) > $session->capacity || $capacityCount >= $session->capacity) {
                        $service->delete($item->id);
                        throw new ActivityException("{$item->activity->name} has been removed from your basket as the capacity of the activity in your selected session has been reached.", 400);
                    }
                }
                foreach($item->activity->closedDays as $closedDay) {
                    if($closedDay->day === $selectedDay) {
                        $service->delete($item->id);
                        throw new ActivityException("{$item->activity->name} activity has been removed from your basket as it was closed by the supplier on the date you selected.", 400);
                    }
                }
                foreach($item->activity->privateDays as $privateDay) {
                    if($privateDay->is_closed && $selectedDate->between($privateDay->start_date, $privateDay->end_date)) {
                        $service->delete($item->id);
                        throw new ActivityException("{$item->activity->name} activity has been removed from your basket as it was closed by the supplier on the date you selected.", 400);
                    }
                }
            } else {
                $service->delete($item->id);
                throw new ActivityException("{$item->activity->name} has been removed from your cart as the activity is no longer available.", 400);
            }
        }
        return response()->json(["status" => "success"]);
    }

    public function index(
        Request $request,
        CartService $service
    )
    {
        return new CartCollection($service->getCart($request->user()->id));
    }

    /**
     * @param CartStoreRequest $request
     * @param CartService $cartService
     * @param Carts $cart
     * @param ActivityService $activityService
     * @return JsonResponse
     * @throws ActivityException
     */
    public function store(
        CartStoreRequest $request,
        CartService      $cartService,
        Carts            $cart,
        ActivityService $activityService
    ): JsonResponse
    {
        $user = $request->user();

        $activity = $activityService->find($request->post('activity_id'));

        $profit = $activity->tourismCompanyProfitability->profitability;

        $selectedDate = Carbon::parse($request->post('selected_time'));

        $sessionId = $request->post('activity_session_id');

        $total = null;

        $adult = $request->post('adult');
        $child = $request->post('child');
        $baby = $request->post('baby');

        if($request->has('activity_session_id')) {
            $session = $activity->sessions->filter(function($session) use ($sessionId, $selectedDate, $activity, $request) {
                return $session->id === $sessionId;
            })->first();
            if($session) {
                $capacityCount = $cartService->getCapacityCount($session->id, $selectedDate, $activity->id);
                if(($adult+$child+$baby) > $session->capacity || $capacityCount >= $session->capacity) {
                    throw new ActivityException("Selected session capacity is full.", 400);
                }
            }
        }

        $specialDay = $activity->prices->filter(function ($price) {
            return $price->type === PriceTypes::SPECIAL_DAY->value;
        })->first();

        if($specialDay && $selectedDate->between($specialDay->start_date, $specialDay->end_date)) {
            $total = $specialDay->price + ($specialDay->price / 100 * $profit);
        } else {
            foreach ($activity->prices as $price) {
                if ($price->type === PriceTypes::ALL->value) {
                    $total = $price->price + ($price->price / 100 * $profit);
                    break;
                }

                if ($selectedDate->isWeekend() && $price->type === PriceTypes::WEEKEND->value) {
                    $total = $price->price + ($price->price / 100 * $profit);
                    break;
                }

                if ($selectedDate->isWeekday() && $price->type === PriceTypes::WEEK->value) {
                    $total = $price->price + ($price->price / 100 * $profit);
                    break;
                }
            }
        }

        $selectedDay = ($selectedDate->dayOfWeek + 6) % 7 + 1;
        foreach($activity->closedDays as $closedDay) {
            if($closedDay->day === $selectedDay) {
                throw new ActivityException("Activity is closed on the selected date.", 400);
            }
        }

        foreach($activity->privateDays as $privateDay) {
            if($privateDay->is_closed && $selectedDate->between($privateDay->start_date, $privateDay->end_date)) {
                throw new ActivityException("Activity is closed on the selected date.", 400);
            }
        }

        $subtotal = $total;
        $total = $total * ($adult+$child+$baby);

        foreach($activity->priceRules as $rule) {
            if($rule->age <= 2 && $baby) {
                if($rule->rule === PriceRules::FREE) {
                    $total = $total - ($subtotal * $baby);
                } else if($rule->rule === PriceRules::DISCOUNT) {
                    $total = $total - ($subtotal - ($subtotal / 100 * $rule->discount_rate)) * $baby;
                }
            } else if($rule->age <= 12 && $child) {
                if($rule->rule === PriceRules::FREE) {
                    $total = $total - ($subtotal * $child);
                } else if($rule->rule === PriceRules::DISCOUNT) {
                    $total = $total - ($subtotal - ($subtotal / 100 * $rule->discount_rate)) * $child;
                }
            } else if ($rule->age > 12 && $adult) {
                if($rule->rule === PriceRules::FREE) {
                    $total = $total - ($subtotal * $adult);
                } else if($rule->rule === PriceRules::DISCOUNT) {
                    $total = $total - ($subtotal - ($subtotal / 100 * $rule->discount_rate)) * $adult;
                }
            }
        }

        $cart->setActivity($request->post('activity_id'));
        $cart->setUser($user->id);
        $cart->setPrice($total);
        $cart->setSelectedTime($selectedDate);
        $cart->setSession($sessionId);
        $cart->setAdult($adult);
        $cart->setChild($child);
        $cart->setBaby($baby);
        $cart->setStatus(0);

        try {
            if($cartService->addToCart($cart)) {
                return response()->json(['status' => 'success', 'message' => 'Item successfully added to cart.']);
            }
            return response()->json(['status' => 'error', 'message' => 'Item could not be added to cart.'], 400);
        } catch (ActivityAlreadyInCartException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 406);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An unexpected error occurred.'], 500);
        }
    }

    /**
     * @param CartUpdateRequest $request
     * @param CartService $service
     * @return JsonResponse
     */
    public function update(
        CartUpdateRequest $request,
        CartService $service
    ): JsonResponse
    {
        $cart = $service->getById($request->input('id'));
        if($request->has('activity_session_id')) {
            $session = $cart->activity->sessions->filter(function($session) use ($cart, $request) {
                return $session->id === $cart->activity_session_id;
            })->first();
            if($session) {
                $capacityCount = $service->getCapacityCount($session->id, $cart->selected_time, $cart->activity->id);
                if(($cart->adult+$cart->child+$cart->baby) > $session->capacity || $capacityCount >= $session->capacity) {
                    throw new ActivityException("Selected session capacity is full.", 400);
                }
            }
        }
        $selectedDate = Carbon::parse($cart->selected_time);
        $activity = $cart->activity;
        $selectedDay = ($selectedDate->dayOfWeek + 6) % 7 + 1;
        foreach($activity->closedDays as $closedDay) {
            if($closedDay->day === $selectedDay) {
                throw new ActivityException("Activity is closed on the selected date.", 400);
            }
        }
        foreach($activity->privateDays as $privateDay) {
            if($privateDay->is_closed && $selectedDate->between($privateDay->start_date, $privateDay->end_date)) {
                throw new ActivityException("Activity is closed on the selected date.", 400);
            }
        }
        if($service->update($request->input('id'), $request->validated())) {
            return response()->json(['status' => 'success', 'message' => 'Cart updated successfully.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Cart could not be updated.'], 400);
    }

    /**
     * @param CartDestroyRequest $request
     * @param CartService $service
     * @param DiscountService $discountService
     * @return JsonResponse
     */
    public function destroy(
        CartDestroyRequest $request,
        CartService        $service,
        DiscountService $discountService
    ): JsonResponse
    {
        if($service->delete($request->input('id'))) {
            if(count($service->getCart($request->user()->id)) <= 0) {
                $discountService->getUserDiscounts($request->user()->id)->map(function($discount) use($discountService) {
                    $discountService->removeCode($discount->id);
                });
            }
            return response()->json(['status' => 'success', 'message' => 'Item successfully removed from cart.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Item could not be removed from cart.'], 400);
    }

    public function applyDiscount(
        DiscountRequest $request,
        DiscountService $discountService,
        CartService $cartService,
    )
    {
        $user = $request->user()->load('cartDiscount.discount');
        if($user->cartDiscount && $user->cartDiscount->count() > 0) {
            $user->cartDiscount->delete();
        }
        $discount = $discountService->findByCode($request->post('discount'));
        $useCode = $discountService->useCode($user->id, $discount->id);
        $amount = $cartService->getTotal($user->id);
        $cartData = $cartService->getCart($user->id);
        if(count($cartData) <= 0) {
            return response()->json(['status' => 'error', 'message' => 'There are no items in your cart.'], 422);
        }
        if($useCode) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $useCode->id,
                    'discount_rate' => $discount->discount_rate,
                    'total' => number_format($amount, 2),
                    'discounted_total' => number_format($amount - ($amount/100*$discount->discount_rate), 2),
                    'discount_amount' => number_format($amount/100*$discount->discount_rate, 2)
                ]
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'An error occurred'], 400);
        }
    }

    public function removeDiscount(
        Request $request,
        DiscountService $discountService
    )
    {
        $discountService->removeCode($request->user()->id);
        return response()->json(['status' => 'success', 'message' => 'Discount code removed successfully from cart']);
    }

    public function cartByDate(
        Request $request,
        CartService $cartService
    )
    {
        return response()->json($cartService->getActivityOrdersByDates($request->input('activity_id')));
    }
}
