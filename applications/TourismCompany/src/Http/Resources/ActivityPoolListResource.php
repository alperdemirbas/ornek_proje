<?php

namespace Rezyon\Applications\TourismCompany\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Rezyon\Supplier\Enums\ActivityExtraTypeEnum;
use Rezyon\Supplier\Enums\PriceTypes;

class ActivityPoolListResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->route('lang') ?? App::getLocale();
        return $this->collection->map(function ($data) use ($request, $locale) {
            $includePrices = null;
            $notIncludePrices = null;
            $advices = null;
            foreach($data->activity->extras as $extra) {
                switch ($extra->key) {
                    case ActivityExtraTypeEnum::INCLUDE_PRICE:
                        $includePrices[] = $extra->getTranslations('value', [$locale])[$locale] ?? null;
                        break;
                    case ActivityExtraTypeEnum::NOT_INCLUDE_PRICE:
                        $notIncludePrices[] = $extra->getTranslations('value', [$locale])[$locale] ?? null;
                        break;
                    case ActivityExtraTypeEnum::ADVICE:
                        $advices[] = $extra->getTranslations('value', [$locale])[$locale] ?? null;
                        break;
                }
            }
            return [
                'id'=>$data->activity->id,
                'session_based' => $data->activity->sessions->count() > 0,
                'name' => $data->activity->getTranslations('name', [$locale])[$locale] ?? null,
                'description' => $data->activity->getTranslations('description', [$locale])[$locale] ?? null,
                'address' => [
                    'latitude' => doubleval($data->activity->address->latitude),
                    'longitude' => doubleval($data->activity->address->longitude),
                    'city' => strtoupper($data->activity->address->street->neighborhood->district->district_name),
                    'district' => strtoupper($data->activity->address->street->neighborhood->district->city->city_name)
                ],
                'images' => $data->activity->images->sortBy('order')->map(function($image) {
                    return [
                        'url' => $image->path,
                    ];
                })->values(),
                'participants' => $data->activity->participants->map(function($participant) {
                    return $this->convertNameToFormat($participant->user->firstname, $participant->user->lastname);
                }),
                'participants_count' => $data->activity->participants->count(),
                'include_price' => $includePrices,
                'not_include_price' => $notIncludePrices,
                'advice' => $advices,
                'activity_duration' => $data->activity->duration,
                'start_time' => $data->activity->start_time->format('H:i:s'),
                'end_time' => $data->activity->end_time->format('H:i:s'),
                'currency' => $data->activity->currency,
                'closed_days' => $data->activity->closedDays->pluck('day'),
                'private_days' => $data->activity->privateDays->map(function($day) {
                    return [
                        'start_date' => $day->start_date->format('Y-m-d H:i:s'),
                        'end_date' => $day->end_date->format('Y-m-d H:i:s'),
                        'is_closed' => (bool) $day->is_closed,
                    ];
                }),
                'sessions' => $data->activity->sessions->map(function($session) {
                    return [
                        "id" => $session->id,
                        "start_time" => $session->start_time->format('H:i'),
                        "end_time" => $session->end_time->format('H:i'),
                        "capacity" => $session->capacity,
                        "day" => $session->day
                    ];
                }),
                'rules' => $data->activity->rules->map(function($rule) use ($locale) {
                    $string = trans("activity.rules.age", ["age" => $rule->age], $locale).' '.trans("activity.rules.operator.".strtolower($rule->operator->value), [], $locale).' ';
                    if($rule->gender !== "ALL") {
                        $string.=trans("activity.rules.gender." . strtolower($rule->gender->value), [], $locale).' ';
                    }
                    $string.=trans("activity.rules.rule.".strtolower($rule->rule->value), [], $locale);
                    return $string;
                }),
                'category' => [
                    'id' => $data->activity->category->categoryType->id,
                    'name' => $data->activity->category->categoryType->getTranslations('name', [$locale])[$locale] ?? null,
                ],
                'price' => $this->calculatePricesWithProfitability($data->activity->prices, $data->profitability)[0],
            ];
        })->toArray();
    }

    protected function calculatePricesWithProfitability($prices, $profitability)
    {
        return $prices->map(function ($price) use ($profitability) {
            if($price->type === PriceTypes::ALL->value) {
                $price->price = $price->price + ($price->price * $profitability / 100);
                return $price->price;
            }
        });
    }

    protected function convertNameToFormat($firstname, $lastname, $separator = ' ') {
        $convertedFirstName = substr($firstname, 0, 1) . str_repeat('*', strlen($firstname) - 1);
        $convertedLastName = substr($lastname, 0, 1) . str_repeat('*', strlen($lastname) - 1);
        return $convertedFirstName . $separator . $convertedLastName;
    }
}
