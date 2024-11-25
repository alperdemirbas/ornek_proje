<div class="row">
    <div class="col-lg-6 col-12 mb-3">
        <label class="form-label">@lang('general.start_date')</label>
        <input type="text" class="form-control date-picker" id="closed_days_start_date">
    </div>
    <div class="col-lg-6 col-12 mb-3">
        <label class="form-label">@lang('general.finish_date')</label>
        <input type="text" class="form-control date-picker" id="closed_days_end_date">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <button type="button" id="addClosedDays" class="btn btn-primary btn-sm float-end my-3">
            @lang('activity.add.closed.day')
        </button>
    </div>
</div>
<div id="closedDaysList">

</div>
@push('styles')
    <link href="{{ asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script>
    $('.date-picker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD'
    });
    !(function() {
        let y = 0;
        const closedDays = function() {
            $(document).on('click', '[data-action="deleteClosedDays"]', function() {
                $(this).closest('.closedDays').remove()
            });

            $('#addClosedDays').click(function() {

                let start_date = $('#closed_days_start_date');
                let end_date =$('#closed_days_end_date');
                let id = $('#closedDays').data('id');

                const closedDaysHtml = `
                            <div class="closedDays">
                                <div class="card my-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <input type="hidden" name="closed_days[${y}][tourism_activity_id]" value="${id}">
                                            <div class="col-lg-6 col-12 mb-3">
                                                <label class="form-label">@lang('general.start_date')</label>
                                                <input type="text" class="form-control date-picker" name="closed_days[${y}][start_date]" value="${start_date.val()}">
                                            </div>
                                            <div class="col-lg-6 col-12 mb-3">
                                                <label class="form-label">@lang('general.finish_date')</label>
                                                <input type="text" class="form-control date-picker" name="closed_days[${y}][end_date]" value="${end_date.val()}">
                                            </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-danger btn-sm float-end" data-action="deleteClosedDays">@lang('general.delete')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                $('#closedDaysList').append(closedDaysHtml);

                start_date.val('');
                end_date.val('');

                dateTimeInit();

                y++;
            })
        };
        const renderData = function(event) {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');
            let targetModal = button.getAttribute('data-bs-target');
            modal = $(targetModal);
            modal.attr('data-id', id);

            targetId = id;

            const activity = JSON.parse(data[id]);
            console.log(activity);


            $('#closedDaysList').empty();
            $.each(activity.closed_days, function( key, value ) {
                const closedDaysHtml = `
                        <div class="closedDays">
                            <div class="card my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">@lang('general.start_date')</label>
                                            <input type="text" class="form-control date-picker" value="${value.start_date}" disabled>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">@lang('general.finish_date')</label>
                                            <input type="text" class="form-control date-picker" value="${value.end_date}" disabled>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-danger btn-sm float-end" data-action="deleteClosedDays" data-permission="delete" data-id="${value.id}">@lang('general.delete')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                $('#closedDaysList').append(closedDaysHtml);
            });

            modal.attr('data-id', activity.id);

            $('[data-permission="delete"]').click(function() {
                let id = $(this).data('id');
                let url = '{{ _route('tourism.activity.pool.delete.closed.day', ['id' => '__id']) }}';
                url = url.replace('__id', id);

                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        _Swal({
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            didOpen: function() {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function (data) {
                        Swal.close();
                        _Swal({
                            icon: 'success',
                            title: '@lang('general.success')',
                            text: data.message,
                            confirmButtonText: '@lang('general.ok')'
                        });
                        window.LaravelDataTables['activitypool-table'].ajax.reload();
                    },
                    error: function (error) {
                        console.log(error);
                        Swal.close();
                        _Swal({
                            icon: 'error',
                            title: '@lang('general.error')',
                            text: error.responseJSON.message,
                            confirmButtonText: '@lang('general.ok')'
                        });
                        window.LaravelDataTables['activitypool-table'].ajax.reload();
                    }
                });
            });
        };
        const save = function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ _route('tourism.activity.pool.add.closed.day') }}',
                type: "POST",
                data: $(event.target).serialize(),
                dataType: "json",
                beforeSend: function() {
                    _Swal({
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: function() {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(data) {
                    Swal.close();
                    _Swal({
                        icon: 'success',
                        title: '@lang('general.success')',
                        text: data.message,
                        confirmButtonText: '@lang('general.ok')'
                    });
                    modal.modal('hide');
                    window.LaravelDataTables['activitypool-table'].ajax.reload();
                },
                error: function(error) {
                    Swal.close();
                    if(error.responseJSON.errors) {
                        let html = "<ul>";
                        $.each(error.responseJSON.errors, function(key, value) {
                            html += "<li>"+value+"</li>";
                        })
                        html += "</ul>";
                        _Swal({
                            icon: 'error',
                            title: '@lang('general.error')',
                            html: html,
                            confirmButtonText: '@lang('general.ok')'
                        });
                    } else {
                        _Swal({
                            icon: 'error',
                            title: '@lang('general.error')',
                            text: error.responseJSON.message,
                            confirmButtonText: '@lang('general.ok')'
                        });
                    }
                    window.LaravelDataTables['activitypool-table'].ajax.reload();
                }
            });
        };
        const events = function() {
            $('#closedDays').on('show.bs.modal', (event) => {renderData(event)});
            $('#editClosedDays').submit((event) => {save(event)});
        };

        events();
        closedDays();
    })();
</script>
@endpush