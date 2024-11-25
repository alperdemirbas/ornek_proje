<div class="dropdown custom-dropdown">
    <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
    </div>
    <div class="dropdown-menu dropdown-menu-end" style="">
        <a href="{{ _route('flights.show', ['flight' => $row->id]) }}" class="dropdown-item status-action"><i class="fa-solid fa-eye me-2"></i>@lang('general.show')</a>

        <a class="dropdown-item status-action" href="javascript:void(0);" data-id="{{ $row->id }}" data-role="edit" data-bs-toggle="modal" data-bs-target="#editFlightModal"><i class="fa-solid fa-pencil me-2"></i>@lang('general.edit')</a>

        <a class="dropdown-item status-action" href="javascript:void(0);" data-id="{{ $row->id }}" data-role="delete" data-bs-toggle="modal" data-bs-target="#editFlightModal"><i class="fa-solid fa-trash me-2"></i>@lang('general.edit')</a>


        @if($row->status !== \Rezyon\Flights\Enums\FlightStatusEnums::CANCELLED)
            @if($row->status === \Rezyon\Flights\Enums\FlightStatusEnums::ACTIVE)
                <a class="dropdown-item status-action" href="javascript:void(0);" data-id="{{ $row->id }}" data-role="confirm"  data-bs-toggle="tooltip" data-bs-placement="top" title="Uçağın indiğini onaylamak için tıklayın."><i class="fa-solid fa-check me-2"></i>@lang('flight.landed')</a>
            @endif
            @if($row->status !== \Rezyon\Flights\Enums\FlightStatusEnums::RETURNED)
                @if($row->status === \Rezyon\Flights\Enums\FlightStatusEnums::LANDED)
                    <a class="dropdown-item status-action" href="javascript:void(0);" data-id="{{ $row->id }}" data-role="return" data-bs-toggle="tooltip" data-bs-placement="top" title="Uçağın geri döndüğünü onaylamak için tıklayın."><i class="fa-solid fa-rotate-left me-2"></i>@lang('flight.returned')</a>
                @endif
                <a class="dropdown-item status-action" href="javascript:void(0);" data-id="{{ $row->id }}" data-role="cancel" data-bs-toggle="tooltip" data-bs-placement="top" title="Uçuşun iptal olduğunu onaylamak için tıklayın."><i class="fa-solid fa-xmark me-2"></i>@lang('flight.cancelled')</a>
            @endif
        @endif
    </div>
</div>

