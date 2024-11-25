@extends('layouts.admin')
@section('title', trans('title.activity_pool'))

@section('main-content')
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-block">
                            <h4 class="card-title mb-2">{{ $data->activity->name }} @lang('activity.pool.request.detail.title')</h4>
                        </div>
                        <div class="card-body pb-0">
                            <h4 class="card-title mb-3">@lang('activity.pool.request.detail.company_details')</h4>
                            <div class="row mb-3">
                                <div class="col-xl-6">
                                    <ul class="list-style-1 list-flex">
                                        <li><label class="form-label mb-0 custom-label">@lang('company.name') :</label><p class="mb-0"> {{ $data->company->name }}</p></li>
                                        <li><label class="form-label mb-0 custom-label">@lang('general.email'):</label><p class="mb-0"> {{ $data->company->email }}</p></li>
                                        <li><label class="form-label mb-0 custom-label">@lang('general.phone'):</label><p class="mb-0"> {{ $data->company->phone }}</p></li>
                                        <li><label class="form-label mb-0 custom-label">@lang('general.address'):</label><p class="mb-0"> {{ $data->company->address }}</p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <div>
                                <a href="javascript:void(0);" id="approve" class="btn btn-success me-2 mb-1"><i class="far fa-check-circle me-2"></i>@lang('general.confirm')</a>
                                <a href="javascript:void(0);" id="reject" class="btn btn-danger me-2 mb-1"><i class="fas fa-xmark me-2"></i>@lang('general.reject')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script>
        $('#approve').click(function() {
            _Swal({
                icon: 'question',
                title: '@lang('activity.pool.pending.approve.alert.title')',
                text: '@lang('activity.pool.pending.approve.alert.text', ['company' => $data->company->name, 'activity' => $data->activity->name, 'profit' => $data->profitability])',
                showCancelButton: true,
                confirmButtonText: '@lang('general.confirm')',
                cancelButtonText: '@lang('general.cancel')'
            }).then(function(res) {
                if(res.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '{{ _route('supplier.activity.pool.pending.approve', ['id' => $data->id]) }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        beforeSend: function() {
                          Swal.showLoading();
                        },
                        success: function(data) {
                            Swal.close();
                            _Swal({
                                icon: 'success',
                                title: data.message,
                                confirmButtonText: '@lang('general.ok')',
                            }).then(() => {
                                window.location.replace("{{ _route('supplier.activity.pool.pending') }}");
                            });
                        },
                        error: function(error) {
                            Swal.close();
                            _Swal({
                                icon: 'error',
                                title: error.responseJSON.message,
                                confirmButtonText: '@lang('general.ok')',
                            }).then(() => {
                                window.location.replace("{{ _route('supplier.activity.pool.pending') }}");
                            });
                        }
                    })
                }
            })
        });

        $('#reject').click(function() {
            _Swal({
                icon: 'question',
                title: '@lang('activity.pool.pending.reject.alert.title')',
                text: '@lang('activity.pool.pending.reject.alert.text', ['company' => $data->company->name, 'activity' => $data->activity->name])',
                showCancelButton: true,
                confirmButtonText: '@lang('general.confirm')',
                cancelButtonText: '@lang('general.cancel')'
            }).then(function(res) {
                if(res.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '{{ _route('supplier.activity.pool.pending.reject', ['id' => $data->id]) }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            Swal.showLoading();
                        },
                        success: function(data) {
                            Swal.close();
                            _Swal({
                                icon: 'success',
                                title: data.message,
                                confirmButtonText: '@lang('general.ok')',
                            }).then(() => {
                                window.location.replace("{{ _route('supplier.activity.pool.pending') }}");
                            });
                        },
                        error: function(error) {
                            Swal.close();
                            _Swal({
                                icon: 'error',
                                title: error.responseJSON.message,
                                confirmButtonText: '@lang('general.ok')',
                            }).then(() => {
                                window.location.replace("{{ _route('supplier.activity.pool.pending') }}");
                            });
                        }
                    })
                }
            })
        });
    </script>
@endpush