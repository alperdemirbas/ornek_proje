<?php

namespace Rezyon\Applications\Tickets\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->route('lang') ?? App::getLocale();

        $data = [
            "id" => $this->id,
            "validity" => [
                "start_date" => $this->start_time,
                "end_date" => $this->end_time
            ],
            "used_at" => $this->used_at ?? false,
            "price" => $this->cart->price,
            "session" => $this->cart->session ? [
                "start_time" => $this->cart->session->start_time->format('H:i:s'),
                "end_time" => $this->cart->session->end_time->format('H:i:s')
            ] : null,
            "activity" => [
                "name" => $this->activity->getTranslations('name', [$locale])[$locale] ?? null,
                "detail" => $this->activity->address->detail,
                "directions" => $this->activity->address->directions,
                "street" => $this->activity->address->street->street_name,
                "neighbourhood" => $this->activity->address->street->neighborhood->neighborhood_name,
                "district" => $this->activity->address->street->neighborhood->district->district_name,
                "city" => $this->activity->address->street->neighborhood->district->city->city_name
            ],
            "ticket_code" => $this->code,
            "base64_qr_code" => base64_encode(QrCode::size(512)
                ->generate(
                    Crypt::encrypt($this->id),
                ))
        ];

        if(isset($this->owner)) {
            $data['owner'] = [
                "pnr" => $this->owner->pnr,
                "firstname" => $this->owner->firstname,
                "lastname" => $this->owner->lastname,
                "email" => $this->owner->email,
            ];
        } else {
            $data['owner'] = null;
        }

        return $data;
    }
}
