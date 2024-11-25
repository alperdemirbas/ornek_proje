@extends('layouts.admin')
@section('MainPage',$mainPage ?? "")
@section('SubPage', $subPage ??"")
@section('title', trans('title.pending_approval_show'))
@section('main-content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">@lang('subscription.edit_subscription')</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-style-1">
                                <li><label class="custom-label-2 mb-0">@lang('subscription.company_type') :</label>@lang("company.".strtolower($data->type->value))</li>
                                <li><label class="custom-label-2 mb-0">@lang('subscription.payment_frequency') :</label>@lang("company.".strtolower($data->packages->first()->payment_frequency->value))</li>
                                <li><label class="custom-label-2 mb-0">@lang('company.app_date') :</label>{{ $data->created_at }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('company.domain') :</label>{{ $data->domain ?? trans('company.not_yet_app') }}</li><li>
                                    <label class="custom-label-2 mb-0">@lang('company.verify_at') :</label>{{ $data->verify_at ?? trans('company.not_yet_app') }}</li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-6">
                            <h5 class="title my-4">@lang('subscription.company_info')</h5>
                            <ul class="list-style-1">
                                <li><label class="custom-label-2 mb-0">@lang('company.name') :</label>{{ $data->name }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('general.email') :</label>{{ $data->email }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('general.phone') :</label>{{ $data->phone }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('general.address') :</label>{{ $data->address }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('subscription.company_desc') :</label>{{ $data->description }}</li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-6">
                            <h5 class="title my-4">@lang('subscription.person_info')</h5>
                            <ul class="list-style-1">
                                <li><label class="custom-label-2 mb-0">@lang('subscription.person_firstname') :</label>{{ $data->officials->first()->first_name }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('subscription.person_lastname') :</label>{{ $data->officials->first()->last_name }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('subscription.person_email') :</label>{{ $data->officials->first()->email }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('subscription.person_phone') :</label>{{ $data->officials->first()->phone }}</li>
                                <li><label class="custom-label-2 mb-0">@lang('subscription.person_phone') :</label>{{ $data->officials->first()->title }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="title my-4">@lang('subscription.uploaded_docs')</h5>
                        <div class="row">
                            @foreach($data->documents as $file)
                            <div class="col-md-3">
                                @php
                                    $url = Illuminate\Support\Facades\Storage::disk('s3')
                                    ->temporaryUrl(
                                        $file->name,
                                        now()->addMinutes(15)
                                    );
                                @endphp
                                <a
                                    href="{{ $url }}"
                                    class="fs-4 text-primary open-pdf"
                                    data-iframe="true"
                                    data-src="{{ $url }}"
                                >
                                    <img class="img-fluid pdf-img" src="{{ asset('assets/images/icons/pdf.png') }}">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($data->verify_at === null)
                <div class="card-footer">
                    @can(\Rezyon\Applications\Companies\Enums\AdminPermissionsEnum::ADMIN_CHECK_DOMAIN->value)
                        <button id="confirm" class="btn btn-success me-2">@lang('general.confirm')</button>
                    @endcan
                    <button id="reject" class="btn btn-danger me-2">@lang('general.reject')</button>
                    <button class="btn btn-primary">@lang('company.request_change')</button>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('assets/vendor/lightgallery/css/lightgallery.min.css')}}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendor/lightgallery/js/lightgallery-all.min.js') }}"></script>
    <script>
        $('.open-pdf').lightGallery({
            selector: 'this',
        });

        $('#reject').click(function(e) {
            e.preventDefault();

            _Swal({
                icon: 'error',
                title: "@lang('subscription.reject_swal_title')",
                text: '@lang('subscription.reject_swal_text')',
                showCancelButton: true,
                confirmButtonText: "@lang('general.confirm')",
                cancelButtonText: "@lang('general.cancel')",
            });
        })

        $('#confirm').click(function(e) {
            e.preventDefault();

            let domain = null;

            _Swal({
                icon: 'warning',
                title: '@lang('subscription.confirm_swal_title')',
                text: '@lang('subscription.confirm_swal_text')',
                showCancelButton: true,
                confirmButtonText: "@lang('general.confirm')",
                cancelButtonText: "@lang('general.cancel')",
            }).then((result) => {
                if (result.isConfirmed) {
                    _Swal({
                        title: '@lang('subscription.select_domain')',
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off',
                            id: 'checkDomain'
                        },
                        showCancelButton: true,
                        confirmButtonText: "@lang('general.confirm')",
                        cancelButtonText: "@lang('general.cancel')",
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: (elem) => {
                            const confirmButton = $('.swal2-confirm')

                            confirmButton.attr('disabled', true)

                            let delayTimer;
                            $('#checkDomain').on('input', function() {
                                clearTimeout(delayTimer);
                                delayTimer = setTimeout(function() {
                                    const $this = $('#checkDomain');
                                    const subdomain = $this.val();
                                    domain = subdomain;

                                    if (/[^a-zA-Z0-9.-]/.test(subdomain)) {
                                        Swal.showValidationMessage(
                                            `@lang('subscription.domain_valid_error')`
                                        )
                                        confirmButton.attr('disabled', true)
                                    } else if(subdomain.trim() === "") {
                                        Swal.showValidationMessage(
                                            `@lang('subscription.domain_valid_empty')`
                                        )
                                        confirmButton.attr('disabled', true)
                                    } else {
                                        $.ajax({
                                            url: '{{ route('companies.domain.check') }}',
                                            type: 'POST',
                                            data: {
                                                '_token': csrf,
                                                'domain': subdomain,
                                                'company_id': {{ $data->id }},
                                            },
                                            dataType: 'json',
                                            success: function(response) {
                                                confirmButton.attr('disabled', false)
                                                Swal.showValidationMessage(response.message)
                                                $('.swal2-validation-message').addClass('success');
                                            },
                                            error: function(response) {
                                                Swal.showValidationMessage(response.responseJSON.message)
                                                $('.swal2-validation-message').removeClass('success');
                                                console.log(response);
                                                confirmButton.attr('disabled', true)
                                            }
                                        });
                                    }
                                }, 1000);
                            });
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('appliaction.companies::confirm') }}',
                                type: 'POST',
                                data: {
                                    '_token': csrf,
                                    'domain': domain,
                                    'company_id': {{ $data->id }},
                                },
                                dataType: 'json',
                                success: function(response) {
                                    _Swal({
                                        icon: 'success',
                                        title: "@lang('subscription.confirm_success')",
                                        confirmButtonText: "@lang('general.ok')",
                                        didDestroy: () => {
                                            window.location.replace("{{ route('application.companies::getWaitingApproval') }}");
                                        }
                                    })
                                },
                                error: function(response) {
                                    _Swal({
                                        icon: 'error',
                                        title: "@lang('subscription.confirm_error')",
                                        confirmButtonText: "@lang('general.ok')",
                                        didDestroy: () => {
                                            window.location.replace("{{ route('application.companies::getWaitingApproval') }}");
                                        }
                                    })
                                }
                            });
                        }
                    })
                }
            })
        });
    </script>
@endpush