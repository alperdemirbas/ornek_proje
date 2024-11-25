<?php

namespace Rezyon\Applications\Orders\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;
use Rezyon\Orders\Enums\OrderStatusEnum;

class OrdersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->route('lang') ?? App::getLocale();
        $data = $this->collection->map(function ($order) use ($locale) {
            $data = [
                'order_id' => $order->id,
                'order_number' => $order->merchant_oid,
                'order_amount' => $order->amount,
                'order_total_amount' => $order->total_amount,
                'order_status' => $order->status,
                'order_status_enums' => [
                    OrderStatusEnum::COMPLETED,
                    OrderStatusEnum::FAILED,
                    OrderStatusEnum::PENDING,
                    OrderStatusEnum::CANCELLED
                ],
                'order_date' => $order->created_at,
                'order_cart' => $order->cart->map(function ($cart) use ($locale) {
                     $data = [
                         'cart_id' => $cart->id,
                         'cart_selected_time' => $cart->selected_time,
                         'cart_session' => $cart->session ?? null,
                         'cart_is_cancelled' => false,
                         'cart_activity' => [
                             'activity_id' => $cart->activity->id,
                             'activity_name' => $cart->activity->getTranslations('name', [$locale])[$locale] ?? null,
                             'activity_image' => $cart->activity->images->first()->path
                         ]
                     ];

                     if($cart->cancelled) {
                         $data['cart_is_cancelled'] = true;
                     }

                    $cart_tickets = $cart->tickets->map(function($ticket) {
                        if ($ticket->owner_id === null) {
                            return false;
                        }
                        return true;
                    });

                    $data['cart_is_assigned'] = !$cart_tickets->contains(false);

                     return $data;
                })
            ];

            if($order->discount) {
                $data['order_discount'] = [
                    'discount_code' => $order->discount->code,
                    'discount_rate' => $order->discount->discount_rate
                ];
            }

            return $data;
        })->toArray();

        return ['confirmed_order' => $data];
    }
}
