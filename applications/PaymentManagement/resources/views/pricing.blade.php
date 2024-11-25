@extends('applications.payment.management::layouts.core')

@section('content')
    <!-- Banner  -->
    <div class="dz-bnr-inr dz-bnr-inr-sm text-center overlay-primary-dark"
         style="background-image: url('assets/images/banner/bnr1.jpg');">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>@lang('general.pricing')</h1>
                <!-- Breadcrumb Row -->
                <nav aria-label="breadcrumb" class="breadcrumb-row m-t15">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">@lang('general.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('general.pricing')</li>
                    </ul>
                </nav>
                <!-- Breadcrumb Row End -->
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <section class="content-inner bg-white position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row">
                    <ul class="nav nav-pills justify-content-center mb-5 companyType">

                        <li class="nav-item">
                            <input id="type_1" type="radio" class="d-none company-type" name="type" value="TOURISM_COMPANY" checked>
                            <label href="javascript:void(0)" class="nav-link active" for="type_1">
                                <i class="fa-solid fa-location-dot me-2"></i>
                                @lang('subscribe.type.tourism.title')
                            </label>
                        </li>

                        <li class="nav-item">
                            <input id="type_2" type="radio" class="d-none company-type" name="type" value="SUPPLIER" id="1">
                            <label href="javascript:void(0)" class="nav-link" for="type_2">
                                <i class="fa-solid fa-location-dot me-2"></i>
                                @lang('subscribe.type.supplier.title')
                            </label>
                        </li>

                    </ul>
                </div>
                <div class="row">
                    <ul class="nav nav-pills justify-content-center mb-5 paymentFrequency">
                        <li class="nav-item">
                            <a href="javascript:void(0)" data-id="fee"
                               class="nav-link cycle" data-bs-toggle="tab"
                               aria-expanded="false" aria-selected="false" role="tab"
                               tabindex="-1"><input type="radio" class="d-none"
                                                    name="billingCycle" value="monthly">@lang('packages.monthly')</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" data-id="quarter_yearly_discount" class="nav-link cycle">
                                <input type="radio" class="d-none" name="billingCycle"
                                       value="quarterly">@lang('packages.quarterly')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" data-id="half_yearly_discount" class="nav-link cycle">
                                <input type="radio" class="d-none" name="billingCycle"
                                       value="semiannually">@lang('packages.semiannually')</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" data-id="yearly_discount" class="nav-link cycle">
                                <input type="radio" class="d-none" name="billingCycle"
                                       value="annually">@lang('packages.annually')</a>
                        </li>
                    </ul>
                </div>
                <div class="row packages">

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('.companyType .nav-link').click(function () {
            $(".companyType .nav-link").removeClass('active');
            $('.companyType').each(function (key, elem) {
                $(elem).find('a').addClass('active');
            })
            $('input', this).prop('checked', true);
            $(this).addClass('active');
            setTimeout(() => {
                $('.paymentFrequency a.active').closest('.nav-item').click();
            }, 100);
        });
        const boxTemp = "table";
    </script>

    @include('applications.payment.management::includes.pricing')
@endpush