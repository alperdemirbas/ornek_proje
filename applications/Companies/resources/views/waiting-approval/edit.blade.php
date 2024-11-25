@extends('layouts.admin')
@section('MainPage',$mainPage ?? "")
@section('SubPage', $subPage ??"")
@section('title', trans('title.pending_approval_edit'))
@section('main-content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">@lang('subscription.edit_subscription')</h6>
                </div>
                <form id="subscription-update" method="POST" action="{{ route('application.companies::companyWaitingUpdate', ['id' => $data->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <h5 class="title my-4">@lang('subscription.company_info')</h5>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">@lang('company.name')</label>
                                <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">@lang('general.email')</label>
                                <input type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">@lang('general.phone')</label>
                                <div class="input-group phone-group mb-3">
                                    <select class="default-select form-control border-right-end w-25 countrySelect" name="phone_country" required></select>
                                    <input type="text" class="form-control phone-mask" name="phone" value="{{ $data->phone }}" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">@lang('general.address')</label>
                                <textarea type="text" rows="3" class="form-control" name="address" required>{{ $data->address }}</textarea>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">@lang('subscription.company_desc')</label>
                                <textarea type="text" rows="3" class="form-control" name="description">{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="title my-4">@lang('subscription.person_info')</h5>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">@lang('subscription.person_firstname')</label>
                                <input type="text" class="form-control" name="official_first_name" value="{{ $data->officials->first()->first_name }}" required>
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">@lang('subscription.person_lastname')</label>
                                <input type="text" class="form-control" name="official_last_name" value="{{ $data->officials->first()->last_name }}" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">@lang('subscription.person_email')</label>
                                <input type="text" class="form-control" name="official_email" value="{{ $data->officials->first()->email }}" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label">@lang('subscription.person_phone')</label>
                                <div class="input-group phone-group mb-3">
                                    <select class="default-select form-control border-right-end w-25 countrySelect" name="official_phone_country" required></select>
                                    <input type="text" class="form-control phone-mask" name="official_phone" value="{{ $data->officials->first()->phone }}" required>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">@lang('subscription.person_title')</label>
                                <input type="text" class="form-control" name="official_title" value="{{ $data->officials->first()->title }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="title my-4">@lang('subscription.uploaded_docs')</h5>
                            <div class="row mb-3">
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
                            <div class="col-md-12 my-4">
                                <input class="form-control" type="file" name="files[]" id="formFileMultiple" multiple="" accept=".pdf">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary me-2">@lang('general.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('assets/vendor/lightgallery/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendor/lightgallery/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imask/imask.min.js') }}"></script>
    <script src="{{ asset('assets/js/phone-codes.js') }}"></script>
    <script>
        $('.open-pdf').lightGallery({
            selector: 'this',
        });

        //create input masks
        $('.phone-mask').each(function(key, el) {
            IMask(
                el,
                {
                    mask: '(000) 000 0000',
                    prepare: function (str) {
                        return str[0] !== '0' ? str : '';
                    },
                    lazy: false,
                    placeholderChar: '_'
                }
            )
        })

        const select = $(".countrySelect");
        $.each(phoneList, function(index, item) {
            select.append($('<option>', {
                value: item.code,
                text: item.code+' '+item.dial_code
            }));
        });

        $('[name="official_phone_country"]').find('[value="{{ $data->officials->first()->phone_country }}"]').prop('selected', true)
        $('[name="phone_country"]').find('[value="{{ $data->phone_country }}"]').prop('selected', true)

        function formatPhoneNumber(phoneNumber) {
            return phoneNumber.replace(/\D/g, '');
        }

        $('#subscription-update button').click(function(e) {
            const official_phone = $('[name="official_phone"]');
            const phone = $('[name="phone"]');
            official_phone.val(formatPhoneNumber(official_phone.val()));
            phone.val(formatPhoneNumber(phone.val()));
            $('#subscription-update').submit();
        })

    </script>
@endpush