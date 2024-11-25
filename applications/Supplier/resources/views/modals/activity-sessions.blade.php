@foreach($activity->sessions as $session)
    <div class="d-flex m-auto border-bottom pb-4 mb-4">
        <i class="fa-regular fa-circle my-auto me-3 fs-4"></i>
        <div class="d-grid my-auto">
            <span class="mb-2">
                @lang('activity.sessions.start_time'): {{ $session->start_time->format('H:i') }}
            </span>
            <span class="mb-2">
                @lang('activity.sessions.end_time'): {{ $session->end_time->format('H:i') }}
            </span>
            <span class="mb-2">
                @lang('activity.sessions.capacity'): {{ $session->capacity }}
            </span>
            <span class="mb-2">
                @lang('activity.sessions.days'): {{ $session->day }}
            </span>
        </div>
    </div>
@endforeach