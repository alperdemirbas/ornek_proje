@php use Rezyon\TourismCompany\Enums\ActivityStatus; @endphp
@php use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum; @endphp
<div class="dropdown ms-auto text-end">
        <div class="btn-link" data-bs-toggle="dropdown">
                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
        </div>
        <div class="dropdown-menu dropdown-menu-end">
                @can(PermissionsEnum::TOURISM_ACTIVITY_UPDATE->value)
                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editPool" data-bs-id="{{ $row->id }}">@lang('general.edit')</a>
                        @if($row->status === ActivityStatus::ACTIVE)
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#closedDays" data-bs-id="{{ $row->id }}">@lang('activity.closed.day.title')</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-action="disable" data-id="{{ $row->id }}">@lang('general.make.inactive')</a>
                        @elseif($row->status === ActivityStatus::PASSIVE)
                                <a class="dropdown-item" href="javascript:void(0)" data-action="enable" data-id="{{ $row->id }}">@lang('general.make.active')</a>
                        @endif
                @endcan
                @can(PermissionsEnum::TOURISM_ACTIVITY_DELETE->value)
                        <a class="dropdown-item" href="javascript:void(0)" data-action="delete" data-id="{{ $row->id }}">@lang('activity.delete.from.pool.button')</a>
                @endcan
        </div>
</div>
<script>
        data[{{ $row->id }}] = '@JSON($row)';
        $('[data-action="delete"]').on('click', function () {
                const id = $(this).data('id');
                let url = '{{ _route('tourism.activity.pool.delete', ['id' => '__id']) }}';
                url = url.replace('__id', id);
                _Swal({
                        icon: 'warning',
                        title: '@lang('activity.delete.from.pool.title')',
                        text: '@lang('activity.delete.from.pool.text')',
                        showCancelButton: true,
                        confirmButtonText: '@lang('general.yes')',
                        cancelButtonText: '@lang('general.cancel')',
                }).then(function (response) {
                        if (response.isConfirmed) {
                                $.ajax({
                                        url: url,
                                        type: 'DELETE',
                                        dataType: 'json',
                                        headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        success: function (response) {
                                                _Swal({
                                                        icon: 'success',
                                                        title: '@lang('general.success')',
                                                        confirmButtonText: '@lang('general.ok')'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        },
                                        error: function (response) {
                                                _Swal({
                                                        icon: 'error',
                                                        title: '@lang('general.error')',
                                                        text: response.responseJSON.message,
                                                        confirmButtonText: '@lang('general.ok')'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        }
                                })
                        }
                })
        });
        $('[data-action="disable"]').on('click', function () {
                const id = $(this).data('id');
                let url = '{{ _route('tourism.activity.pool.disable', ['id' => '__id']) }}';
                url = url.replace('__id', id);
                _Swal({
                        icon: 'warning',
                        title: '@lang('activity.disable.from.pool.title')',
                        text: '@lang('activity.disable.from.pool.text')',
                        showCancelButton: true,
                        confirmButtonText: '@lang('general.yes')',
                        cancelButtonText: '@lang('general.cancel')',
                }).then(function (response) {
                        if (response.isConfirmed) {
                                $.ajax({
                                        url: url,
                                        type: 'PUT',
                                        dataType: 'json',
                                        headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        success: function (response) {
                                                _Swal({
                                                        icon: 'success',
                                                        title: '@lang('general.success')',
                                                        confirmButtonText: '@lang('general.ok')'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        },
                                        error: function (response) {
                                                _Swal({
                                                        icon: 'error',
                                                        title: '@lang('general.error')',
                                                        text: response.responseJSON.message,
                                                        confirmButtonText: '@lang('general.ok')'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        }
                                })
                        }
                })
        });
        $('[data-action="enable"]').on('click', function () {
                const id = $(this).data('id');
                let url = '{{ _route('tourism.activity.pool.enable', ['id' => '__id']) }}';
                url = url.replace('__id', id);
                _Swal({
                        icon: 'warning',
                        title: '@lang('activity.enable.from.pool.title')',
                        text: '@lang('activity.enable.from.pool.text')',
                        showCancelButton: true,
                        confirmButtonText: '@lang('general.yes')',
                        cancelButtonText: '@lang('general.cancel')',
                }).then(function (response) {
                        if (response.isConfirmed) {
                                $.ajax({
                                        url: url,
                                        type: 'PUT',
                                        dataType: 'json',
                                        headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        success: function (response) {
                                                _Swal({
                                                        icon: 'success',
                                                        title: '@lang('general.success')',
                                                        confirmButtonText: '@lang('general.ok')'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        },
                                        error: function (response) {
                                                _Swal({
                                                        icon: 'error',
                                                        title: '@lang('general.error')',
                                                        text: response.responseJSON.message,
                                                        confirmButtonText: '@lang('general.ok')'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        }
                                })
                        }
                })
        });
</script>
