@foreach($activity->rules as $rule)
    <div class="d-flex m-auto border-bottom pb-4 mb-4">
        <i class="fa-regular fa-circle my-auto me-3 fs-4"></i>
        <p class="my-auto">{{ __("activity.rules.age", ["age" => $rule->age]) }} {{ __("activity.rules.operator.".strtolower($rule->operator)) }} {{ $rule->gender !== "ALL" ? __("activity.rules.gender.".strtolower($rule->gender)) : '' }} {{ __("activity.rules.rule.".strtolower($rule->rule)) }}</p>
    </div>
@endforeach