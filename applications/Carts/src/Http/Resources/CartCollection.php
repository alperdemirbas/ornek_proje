<?php

namespace Rezyon\Applications\Carts\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;

class CartCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->route('lang') ?? App::getLocale();

        $total = $this->collection->sum(function ($item) {
            return $item->price;
        });

        $user = $request->user()->load('cartDiscount.discount');

        $items = $this->collection->map(function ($item) use ($locale) {
            $isSessionBased = $item->activity->sessions->count() > 0;

            $cartItem = [
                "id" => $item->id,
                "price" => $item->price,
                "selected_time" => Carbon::parse($item->selected_time)->format('Y-m-d'),
                "adult" => $item->adult,
                "child" => $item->child,
                "baby" => $item->baby,
                "activity" => [
                    "id" => $item->activity->id,
                    "name" => $item->activity->getTranslations('name', [$locale])[$locale] ?? null,
                    "image" => $item->activity->images->first()->path,
                    "session_based" => $isSessionBased,
                    'closed_days' => $item->activity->closedDays->pluck('day'),
                    'private_days' => $item->activity->privateDays->map(function($day) {
                        return [
                            'start_date' => $day->start_date->format('Y-m-d H:i:s'),
                            'end_date' => $day->end_date->format('Y-m-d H:i:s'),
                            'is_closed' => (bool) $day->is_closed,
                        ];
                    }),
                ]
            ];

            if($isSessionBased) {
                $cartItem['activity']['sessions'] = $item->activity->sessions->map(function ($session) {
                    return [
                        "id" => $session->id,
                        "start_time" => $session->start_time->format('H:i'),
                        "end_time" => $session->end_time->format('H:i'),
                        "capacity" => $session->capacity,
                        "day" => $session->day
                    ];
                });
            }

            if($item->session) {
                $cartItem['selected_session'] = [
                    "id" => $item->session->id,
                    "start_time" => $item->session->start_time->format('H:i'),
                    "end_time" => $item->session->end_time->format('H:i'),
                    "capacity" => $item->session->capacity,
                    "day" => $item->session->day
                ];
            }

            return $cartItem;
        })->toArray();

        if($user->cartDiscount) {
            return [
                "items" => $items,
                "total" => (float) $total,
                "discounted" => true,
                "discount" => [
                    "discount_rate" => $user->cartDiscount->discount->discount_rate,
                    "discounted_total" => number_format($total - ($total/100*$user->cartDiscount->discount->discount_rate), 2),
                    "discount_amount" => number_format($total/100*$user->cartDiscount->discount->discount_rate, 2),
                    "discount_code" => $user->cartDiscount->discount->code,
                    "discount_id" => $user->cartDiscount->id
                ]
            ];
        } else {
            return [
                "items" => $items,
                "total" => $total,
                "discounted" => false,
            ];
        }
    }
}
