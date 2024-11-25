<?php

namespace Rezyon\Applications\Supplier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Applications\Supplier\Enums\PermissionsEnum;
use Rezyon\Supplier\Enums\PriceCurrency;
use Rezyon\Supplier\Enums\PriceTypes;
use Rezyon\Users\Enums\Types;

class ActivityStoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (Auth::guard('companies')->user()->can(PermissionsEnum::SUPPLIER_ACTIVITY_STORE->value));
    }
    public function rules(): array
    {
        return [
            'id' => 'required|exists:users,id,type,'.Types::SUPPLIER->value,

            'activity_category_id' => 'required|exists:activity_categories,id',
            'name'=> 'required',
            'price_currency'=> ['required',new Enum(PriceCurrency::class)],
            'price' => 'required',
            'price.*' => 'required',
            'price.*.type' => ['required',new Enum(PriceTypes::class)],
            'price.*.price' => 'required|numeric|min:1',
            'description' => 'required|array',
            'start_time' => 'nullable|date_format:H:i',
            'end_time'=>'required_with:start_time|nullable|date_format:H:i|after:start_time',
            'files' => 'required|array',
            'files.*' => 'image',

            'closed_days' => 'nullable|array',
            'closed_days.*' => 'required|integer',

            'private_days' => 'nullable|array',
            'private_days.*.start_date' => 'required|date',
            'private_days.*.end_date' => 'required|date',
            'private_days.*.is_closed' => 'nullable|boolean',

            'duration' =>'nullable',
            'duration.hours' => 'required_with:duration|numeric|min:0|max:24',
            'duration.minutes' => 'required_with:duration|numeric|min:0|max:60',

            'sessions' => 'nullable|array',
            'sessions.*.start_time' => 'required|date_format:H:i',
            'sessions.*.end_time' => 'required|date_format:H:i',
            'sessions.*.capacity' => 'required|numeric|min:0',
            'sessions.*.days.*' => 'nullable',

            'cancellation_rules' => 'nullable|array',
            'cancellation_rules.*.hour' => 'required|numeric',
            'cancellation_rules.*.discount_rate' => 'required|numeric',

            'extras' => 'nullable|array',
            'extras.*.description' => 'required',
            'extras.*.type' => ['required', new Enum(\Rezyon\Supplier\Enums\ActivityExtraTypeEnum::class)],


            'price_rules' => 'nullable|array',
            'price_rules.*.rule' => 'required',
            'price_rules.*.gender' => 'required',
            'price_rules.*.age' => 'required',
            'price_rules.*.operator' => 'required',
            'price_rules.*.start_date' => 'nullable|date',
            'price_rules.*.end_date' => 'required_with:price_rules.*.start_date|nullable|date|after:price_rules.*.start_date',

            'city' =>'required|numeric|exists:cities,id',
            'district' => 'required|numeric|exists:districts,id',
            'neighborhood'=>'required|numeric|exists:neighborhoods,id',
            'street' => 'required|numeric|exists:streets,id',
            'latitude' => 'required|min:2',
            'longitude' => 'required|min:2'
        ];
    }

    protected function prepareForValidation()
    {
        $this->private_days = collect($this->private_days)->map(function ($privateDay) {
            if(isset($privateDay['is_closed'])) {
                $privateDay['is_closed'] = (bool) $privateDay['is_closed'];
            }
            return $privateDay;
        })->toArray();
        $this->merge([
            'id' => $this->user()->id,
            'private_days' => $this->private_days,
        ]);
    }
}