@extends('layouts.admin')
@section('title', trans('title.activity_pool'))

@section('main-content')
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-block">
                            <h4 class="card-title mb-2">{{ $activity->name }} @lang('activity.detail')</h4>
                        </div>
                        <div class="card-body pb-0">
                            <h4 class="card-title mb-3">@lang('activity.pool.request.detail.company_details')</h4>
                            <div class="row mb-3">
                                <div class="col-xl-6">
                                    <ul class="list-style-1 list-flex">
                                        <li><label class="form-label mb-0 custom-label">@lang('company.name') :</label><p class="mb-0"> {{ $activity->company->name }}</p></li>
                                        <li><label class="form-label mb-0 custom-label">@lang('general.email'):</label><p class="mb-0"> {{ $activity->company->email }}</p></li>
                                        <li><label class="form-label mb-0 custom-label">@lang('general.phone'):</label><p class="mb-0"> {{ phone($activity->company->phone, $activity->company->phone_country)->formatE164() }}</p></li>
                                        <li><label class="form-label mb-0 custom-label">@lang('general.address'):</label><p class="mb-0"> {{ $activity->company->address }}</p></li>
                                        <li><a href="{{ route('admin.activity.pendings.detail', ['id' => $activity->id]) }}" class="btn btn-primary btn-xs me-2 mb-1">@lang('activity.detail')</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <div>
                                @can('admin.activity.pending.confirm')
                                    <a href="javascript:void(0);" id="confirm" class="btn btn-success me-2 mb-1"><i class="far fa-check-circle me-2"></i>@lang('general.confirm')</a>
                                @endcan
                                @can('admin.activity.pending.reject')
                                    <a href="javascript:void(0);" id="reject" class="btn btn-danger me-2 mb-1"><i class="fas fa-xmark me-2"></i>@lang('general.reject')</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#confirm').click(function() {
            _Swal({
                icon: 'question',
                title: '@lang('activity.confirm.text')',
                showCancelButton: true,
                confirmButtonText: '@lang('general.confirm')',
                cancelButtonText: '@lang('general.cancel')',
            }).then(function (response) {
                if(response.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('admin.activity.pendings.confirm', ['id' => $activity->id]) }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        beforeSend: function () {
                            Swal.showLoading();
                        },
                        success: function () {
                            _Swal({
                                title: '@lang('general.success')',
                                icon: 'success',
                                text: '@lang('activity.confirm.success')',
                                confirmButtonText: '@lang('general.ok')',
                            }).then(function() {
                                window.location.replace("{{ route('admin.activity.pendings') }}");
                            });
                        },
                        error: function (error) {
                            let html = "<ul>";
                            $.each(error.responseJSON.errors, function(key, value) {
                                html += `<li>${value}</li>`;
                            })
                            html += "</ul>";
                            _Swal({
                                title: '@lang('general.error')',
                                icon: 'error',
                                html: html,
                                confirmButtonText: '@lang('general.ok')',
                            })
                        }
                    });
                }
            })
        });

        $('#reject').click(function() {
            _Swal({
                icon: 'question',
                title: '@lang('activity.reject.text')',
                input: "text",
                inputAttributes: {
                    placeholder: "@lang('activity.reject.reason')",
                    required: true,
                    id: 'rejected_reason'
                },
                showCancelButton: true,
                confirmButtonText: '@lang('general.confirm')',
                cancelButtonText: '@lang('general.cancel')',
            }).then(function (response) {
                if(response.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('admin.activity.pendings.reject', ['id' => $activity->id]) }}',
                        headers: {
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            rejected_reason: $('#rejected_reason').val()
                        },
                        dataType: 'json',
                        beforeSend: function () {
                            Swal.showLoading();
                        },
                        success: function () {
                            _Swal({
                                title: '@lang('general.success')',
                                icon: 'success',
                                text: '@lang('activity.reject.success')',
                                confirmButtonText: '@lang('general.ok')',
                            }).then(function() {
                                window.location.replace("{{ route('admin.activity.pendings') }}");
                            });
                        },
                        error: function (error) {
                            let html = "<ul>";
                            $.each(error.responseJSON.errors, function(key, value) {
                                html += `<li>${value}</li>`;
                            })
                            html += "</ul>";
                            _Swal({
                                title: '@lang('general.error')',
                                icon: 'error',
                                html: html,
                                confirmButtonText: '@lang('general.ok')',
                            })
                        }
                    });
                }
            })
        });
    </script>
@endpush