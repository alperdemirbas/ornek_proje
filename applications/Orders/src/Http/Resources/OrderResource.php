<?php

namespace Rezyon\Applications\Orders\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->route('lang') ?? App::getLocale();
        return $this["order"]->cart->map(function($cart) use ($locale) {
            $data = [
                "activity" => [
                    "name" => $cart->activity->getTranslations('name', [$locale])[$locale] ?? null,
                    "detail" => $cart->activity->address->detail,
                    "directions" => $cart->activity->address->directions,
                    "street" => $cart->activity->address->street->street_name,
                    "neighbourhood" => $cart->activity->address->street->neighborhood->neighborhood_name,
                    "district" => $cart->activity->address->street->neighborhood->district->district_name,
                    "city" => $cart->activity->address->street->neighborhood->district->city->city_name
                ],
                "is_cancelled" => isset($cart->cancelled),
                "group" => array_values($this["group"]->filter(function ($user) use ($cart) {
                    foreach ($cart->tickets as $ticket) {
                        if ($ticket->owner_id === $user->id) {
                            return false;
                        }
                    }
                    return true;
                })->map(function ($user) {
                    return [
                        "id" => $user->id,
                        "pnr" => $user->pnr,
                        "firstname" => $user->firstname,
                        "lastname" => $user->lastname
                    ];
                })->toArray()),
                "session" => null,
                "tickets" => $cart->tickets->map(function($ticket) use ($locale, $cart) {
                    $data = [
                        "id" => $ticket->id,
                        "validity" => [
                            "start_date" => $ticket->start_time,
                            "end_date" => $ticket->end_time
                        ],
                        "used_at" => $ticket->used_at,
                        "price" => $cart->price,
                    ];
                    if(isset($ticket->owner)) {
                        $data['owner'] = [
                            "pnr" => $ticket->owner->pnr,
                            "firstname" => $ticket->owner->firstname,
                            "lastname" => $ticket->owner->lastname,
                            "email" => $ticket->owner->email,
                        ];
                        $data['base64_qr_code'] = base64_encode(QrCode::size(512)
                            ->generate(
                                Crypt::encrypt($ticket->id),
                            ));
                    } else {
                        $data['owner'] = null;
                        $data['base64_qr_code'] = null;
                        $data['code'] = $ticket->code;
                    }
                    return $data;
                })->toArray()
            ];
            if($cart->session) {
                $data['session'] = [
                    "start_time" => $cart->session->start_time->format('H:i:s'),
                    "end_time" => $cart->session->end_time->format('H:i:s')
                ];
            }
            return $data;
        })->toArray();
    }
}
