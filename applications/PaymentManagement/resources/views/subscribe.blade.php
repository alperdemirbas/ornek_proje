@extends('applications.payment.management::layouts.core')

@push('styles')
    <link href="{{ asset('assets/vendor/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/custom.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Banner  -->
    <div class="dz-bnr-inr dz-bnr-inr-sm text-center overlay-primary-dark"
         style="background-image: url('assets/images/banner/bnr1.jpg');">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>@lang('subscribe.subscribe.title')</h1>
                <!-- Breadcrumb Row -->
                <nav aria-label="breadcrumb" class="breadcrumb-row m-t15">
                    <ul class="breadcrumb">

                        <li class="breadcrumb-item active" aria-current="page">@lang('subscribe.subscribe.title')</li>
                    </ul>
                </nav>
                <!-- Breadcrumb Row End -->
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!--Wizard Area-->
    <section class="content-inner overflow-hidden position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 style-1 p-0 mx-0 my-3">
                        <div class="card-body">
                            <form id="subscription-form" enctype="multipart/form-data" >
                                <div id="smartwizard" class="form-wizard order-create">
                                    <ul class="nav nav-wizard mb-3">
                                        <li>
                                            <a class="nav-link" href="#type">
                                                <span>1</span>
                                            </a>
                                            <p>@lang('subscribe.subscribe.type')</p>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#information">
                                                <span>2</span>
                                            </a>
                                            <p>@lang('subscribe.fill.info')</p>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#documents">
                                                <span>3</span>
                                            </a>
                                            <p>@lang('subscribe.upload.documents.title')</p>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#summary">
                                                <span>4</span>
                                            </a>
                                            <p>@lang('subscribe.summary.title')</p>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-5">
                                        <div id="type" class="tab-pane" role="tabpanel">
                                            <div class="row justify-content-center mb-5">
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 m-b30">
                                                    <div class="pricing-wrapper small type rounded">
                                                        <span class="ribbon fa-solid fa-check"></span>
                                                        <div class="card-body text-center">
                                                            <h5 class="mb-4"><i
                                                                        class="fa-solid fa-location-dot fs-1"></i></h5>
                                                            <h5 class="card-title">@lang('subscribe.type.tourism.title')</h5>
                                                            <p class="card-text">@lang('subscribe.type.tourism.text')</p>
                                                            <input type="radio" class="d-none company-type" name="type"
                                                                   value="TOURISM_COMPANY">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 m-b30">
                                                    <div class="pricing-wrapper small type rounded">
                                                        <span class="ribbon fa-solid fa-check"></span>
                                                        <div class="card-body text-center">
                                                            <h5 class="mb-4"><i
                                                                        class="fa-solid fa-location-dot fs-1"></i></h5>
                                                            <h5 class="card-title">@lang('subscribe.type.supplier.title')</h5>
                                                            <p class="card-text">@lang('subscribe.type.supplier.text')</p>
                                                            <input type="radio" class="d-none company-type" name="type"
                                                                   value="SUPPLIER">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="information" class="tab-pane" role="tabpanel">
                                            <div class="row">
                                                <h4 class="fs-6 mb-3">@lang('subscribe.company.info'):</h4>
                                                <div class="col-lg-12 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.company.name')<span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" name="name" id="name" class="form-control"
                                                               placeholder="Örn. Bilge Turizm" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.company.email')<span
                                                                    class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="email" id="email"
                                                               placeholder="Örn. example@example.com" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <label class="text-label form-label">@lang('subscribe.company.phone')<span
                                                                class="text-danger">*</span></label>
                                                    <div class="mb-3 d-flex phone-group">
                                                        <select id="phone_country" name="phone_country" class="select2 countrySelect w-50" required></select>
                                                        <input type="text" name="phone" id="phone" class="form-control phone-mask"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.company.desc')<span
                                                                    class="text-danger">*</span></label>
                                                        <textarea name="description" id="description"
                                                                  class="form-control" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.company.address')<span
                                                                    class="text-danger">*</span></label>
                                                        <textarea name="address" id="address" class="form-control"
                                                                  rows="3" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <h4 class="fs-6 mb-3">@lang('subscribe.official.info'):</h4>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.official.firstname')<span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" name="official_first_name"
                                                               id="official_first_name" class="form-control"
                                                               placeholder="Örn. Ahmet" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.official.lastname')<span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" name="official_last_name"
                                                               id="official_last_name" class="form-control"
                                                               placeholder="Örn. Demir" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.official.email')<span
                                                                    class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="official_email"
                                                               id="official_email"
                                                               placeholder="Örn. example@example.com" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.official.phone')<span
                                                                    class="text-danger">*</span></label>
                                                        <div class="mb-3 d-flex phone-group">
                                                            <select id="official_phone_country" name="official_phone_country" class="select2 countrySelect w-50" required></select>
                                                            <input type="text" name="official_phone" id="official_phone" class="form-control phone-mask" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-2">
                                                    <div class="mb-3">
                                                        <label class="text-label form-label">@lang('subscribe.official.title')<span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" name="official_title" id="official_title"
                                                               class="form-control" placeholder="Örn. Yönetici"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="documents" class="tab-pane" role="tabpanel">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="card docs mb-3">
                                                        <div class="card-body d-flex align-items-center bg-light">
                                                            <div>
                                                                <p>@lang('subscribe.upload.documents.info.text')</p>
                                                                <div id="reqDocs">
                                                                    <span class="mb-2 d-flex"><i
                                                                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.tax')</span>
                                                                    <span class="mb-2 d-flex"><i
                                                                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.foundation')</span>
                                                                    <span class="mb-2 d-flex"><i
                                                                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.tursab')</span>
                                                                    <span class="mb-2 d-flex"><i
                                                                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.company.sign')</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div id="myDropzone" class="dropzone">
                                                        <div class="dz-message">
                                                            {!! trans('subscribe.upload.documents.drop') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 m-2">
                                                    <div class="form-check custom-checkbox mt-5">
                                                        <input type="checkbox" class="form-check-input"
                                                               name="terms_conditions"
                                                               id="terms_conditions">
                                                        <label class="form-check-label" for="terms_conditions">
                                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                               data-bs-target="#tosModal">{!! trans('subscribe.accept.tos.text') !!}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="summary" class="tab-pane" role="tabpanel">
                                            <div class="row">
                                                <div class="mb-3 row">
                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                                        <div class="icon-bx-wraper style-2 text-center">
                                                            <div class="icon-content">
                                                                <h4 class="fs-20">@lang('subscribe.summary.info1.title')</h4>
                                                                <p class="text">@lang('subscribe.summary.info1.text')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                                        <div class="icon-bx-wraper style-2 text-center">
                                                            <div class="icon-content">
                                                                <h4 class="fs-20">@lang('subscribe.summary.info2.title')</h4>
                                                                <p class="text">@lang('subscribe.summary.info2.text')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                                        <div class="icon-bx-wraper style-2 text-center">
                                                            <div class="icon-content">
                                                                <h4 class="fs-20">@lang('subscribe.summary.info3.title')</h4>
                                                                <p class="text">@lang('subscribe.summary.info3.text')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="alert alert-warning" role="alert">
                                                    {!! trans('subscribe.last_step.alert') !!}
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-xl-6 col-md-6">
                                                    <h4 class="fs-6 text-dark mb-3">@lang('subscribe.company.info')</h4>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.company.name'):</span><span
                                                                class="font-w400 custom-label-3" id="name-label"></span>
                                                    </p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.company.email'):</span><span
                                                                class="font-w400 custom-label-3"
                                                                id="email-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.company.country.code'):</span><span
                                                                class="font-w400 custom-label-3"
                                                                id="phone_country-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.company.phone'):</span><span
                                                                class="font-w400 custom-label-3"
                                                                id="phone-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.company.desc'):</span><span
                                                                class="font-w400 custom-label-3"
                                                                id="description-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.company.address'):</span><span
                                                                class="font-w400 custom-label-3"
                                                                id="address-label"></span></p>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <h4 class="fs-6 text-dark mb-3">@lang('subscribe.official.info')</h4>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.official.firstname'):</span>
                                                        <span class="font-w400 custom-label-3"
                                                              id="official_first_name-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.official.lastname'):</span>
                                                        <span class="font-w400 custom-label-3"
                                                              id="official_last_name-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.official.email'):</span><span
                                                                class="font-w400 custom-label-3"
                                                                id="official_email-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.official.country.code'):</span>
                                                        <span class="font-w400 custom-label-3"
                                                              id="official_phone_country-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.official.phone'):</span>
                                                        <span class="font-w400 custom-label-3"
                                                              id="official_phone-label"></span></p>
                                                    <p class="font-w600 mb-2 d-grid d-md-flex"><span class="custom-label-2">@lang('subscribe.official.title'):</span><span
                                                                class="font-w400 custom-label-3"
                                                                id="official_title-label"></span></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <ul class="nav nav-pills justify-content-center mb-5 paymentFrequency">
                                                    <li class="nav-item">
                                                        <a href="javascript:void(0)" data-id="fee"
                                                           class="nav-link cycle active" data-bs-toggle="tab"
                                                           aria-expanded="false" aria-selected="false" role="tab"
                                                           tabindex="-1"><input type="radio" class="d-none"
                                                                                name="billingCycle" value="MONTHLY">@lang('subscribe.monthly')</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="javascript:void(0)" data-id="quarter_yearly_discount" class="nav-link cycle">
                                                            <input type="radio" class="d-none" name="billingCycle"
                                                                   value="QUARTER">@lang('subscribe.quarterly')
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="javascript:void(0)" data-id="half_yearly_discount" class="nav-link cycle">
                                                            <input type="radio" class="d-none" name="billingCycle"
                                                                   value="HALF_YEARLY">@lang('subscribe.semiannually')</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="javascript:void(0)"  data-id="yearly_discount" class="nav-link cycle">
                                                            <input type="radio" class="d-none" name="billingCycle"
                                                                   value="YEARLY">@lang('subscribe.annually')</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <div class="packages col col-sm-12">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Wizard Area End-->

    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg" id="tosModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg my-5 mx-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('subscribe.tos')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bu Kullanım Sözleşmesi ("Sözleşme"), aşağıda ayrıntıları belirtilen şartlar ve koşullar
                        dahilinde, [ŞİRKET ADI], ("Şirket") ile bu internet sitesini veya uygulamayı ("Platform")
                        kullanmayı kabul eden her bir kullanıcı ("Kullanıcı") arasında akdedilmiştir. Lütfen bu
                        Sözleşme'yi dikkatle okuyun ve anladığınızdan emin olmadan Platform'u kullanmayın. Bu Sözleşme,
                        Platform'un kullanımıyla ilgili haklarınızı ve yükümlülüklerinizi düzenler.<br/><br/><br/>


                        <strong>1-) Platform Kullanımı</strong><br/>
                        1.1. Kullanıcı, Platform'u yalnızca yasal amaçlar için kullanabilir. Platform'un herhangi bir
                        yasa dışı amaçla kullanılması kesinlikle yasaktır.<br/><br/>

                        1.2. Kullanıcı, Platform'u sadece kişisel kullanımı için kullanabilir. Platform'un ticari
                        amaçlarla kullanılması yasaktır.<br/><br/>

                        1.3. Kullanıcı, Platform'u kullanırken diğer kullanıcıların haklarına ve gizliliğine saygı
                        göstermelidir. Herhangi bir şekilde taciz, tehdit, iftira, hakaret veya diğer kullanıcıları
                        rahatsız eden davranışlar yasaktır.<br/><br/>

                        <strong>2-) Hesap Oluşturma ve Güvenlik</strong><br/>
                        2.1. Platform'u kullanmak isteyen Kullanıcılar, kayıt işlemi sırasında doğru, güncel ve eksiksiz
                        bilgiler sağlamalıdır.<br/><br/>

                        2.2. Kullanıcı, Platform hesabının güvenliği ve gizliliğinden kendisi sorumludur. Hesap
                        bilgilerini paylaşmak veya başkalarına erişim izni vermek yasaktır.<br/><br/>

                        2.3. Kullanıcı, hesabının yetkisiz kullanımını derhal Şirket'e bildirmelidir.<br/><br/>

                        <strong>3-) Fikri Mülkiyet Hakları</strong><br/>
                        3.1. Platform'da bulunan tüm içerik, yazılım, tasarımlar, metinler, grafikler ve diğer
                        materyaller Şirket'in fikri mülkiyet haklarına tabidir.<br/><br/>

                        3.2. Kullanıcı, Platform'u kullanarak bu materyallere erişim hakkı kazanır, ancak bu
                        materyallerin kopyalanması, dağıtılması, değiştirilmesi veya başka bir şekilde kullanılması
                        yasaktır.<br/><br/>

                        <strong>4-) Gizlilik Politikası</strong><br/>
                        4.1. Kullanıcı, Platform'un Gizlilik Politikası'nı okuyup anladığını kabul eder. Gizlilik
                        Politikası, Kullanıcıların kişisel bilgilerinin nasıl işlendiği konusunda önemli bilgiler
                        içerir.<br/><br/>

                        <strong>5-) İptal ve Sonlandırma</strong><br/>
                        5.1. Şirket, herhangi bir bildirimde bulunmaksızın herhangi bir Kullanıcı'nın hesabını askıya
                        alma veya sonlandırma hakkını saklı tutar.<br/><br/>

                        5.2. Kullanıcı, bu Sözleşme'ye uymadığı takdirde Şirket'in hesabını sonlandırma hakkını kabul
                        eder.<br/><br/>

                        <strong>6-) Sorumluluk Reddi</strong><br/>
                        6.1. Platform, "OLDUĞU GİBİ" sunulur. Şirket, Platform'un kesintisiz veya hatasız olacağını
                        garanti etmez.<br/><br/>

                        6.2. Şirket, Kullanıcıların Platform'u kullanmaları sonucunda oluşan herhangi bir kayıp, zarar
                        veya mali zarardan sorumlu değildir.<br/><br/>

                        <strong>7-) Değişiklikler</strong><br/>
                        7.1. Şirket, bu Sözleşme'yi dilediği zaman değiştirme hakkını saklı tutar. Değişiklikler
                        Platform üzerinden duyurulur.<br/><br/>

                        <strong>8-) İletişim</strong><br/>
                        8.1. İletişim veya sorular için [ŞİRKET İLETİŞİM BİLGİLERİ] kullanılabilir.<br/><br/>

                        Bu Kullanım Sözleşmesi, Kullanıcı ve Şirket arasındaki ilişkiyi düzenler. Kullanıcı, bu
                        Sözleşme'yi kabul etmekle, Platform'u kullanırken bu şartları ve koşulları kabul ettiğini beyan
                        eder. Bu Sözleşme 2023 tarihinde yürürlüğe girecektir.<br/><br/>

                        [ŞİRKET ADI]<br/>
                        [ŞİRKET ADRESİ]<br/>
                        [ŞİRKET İLETİŞİM BİLGİLERİ]<br/><br/>

                        Tarih: [TARİH]</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal" id="rejectTos">@lang('subscribe.reject')</button>
                    <button type="button" class="btn btn-success light" id="acceptTos">@lang('subscribe.accept.text')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/imask/imask.min.js') }}"></script>
    <script src="{{ asset('assets/js/phone-codes.js') }}"></script>

    <script>
        const wizardEl = $('#smartwizard');

        //create input masks
        const phoneMask1 = IMask(
            document.querySelector('#phone'),
            {
                mask: '(000)000-0000',
                lazy: false,
                placeholderChar: '_'
            }
        );
        const phoneMask2 = IMask(
            document.querySelector('#official_phone'),
            {
                mask: '(000)000-0000',
                lazy: false,
                placeholderChar: '_'
            }
        );

        $('#goToStepFirst').click(function () {
            wizardEl.smartWizard("goToStep", 0, true);
        })

        $(document).ready(function () {
            $('[data-id="{{ request()->route()->cycle ?? "fee" }}"]').click();

            //wizard initialization
            wizardEl.smartWizard({
                enableUrlHash: false,
                lang: {
                    next: '@lang('subscribe.next_step')',
                    previous: '@lang('subscribe.prev_step')'
                },
                keyboard: {
                    keyNavigation: false,
                },
                anchor: {
                    enableNavigation: false, // Enable/Disable anchor navigation
                },
            });

            //reset wizard
            wizardEl.smartWizard("goToStep", 0, true);
            wizardEl.smartWizard("reset");
            $('.sw-btn-prev').hide();

            //disable arrow keys click
            $(document).off("keydown");

            const supportedRegions = @JSON(phone_supported_regions());
            const trRegion  = supportedRegions.find((element) => element === "TR");

            const filteredPhoneList = phoneList.filter(item => supportedRegions.includes(item.code));
            filteredPhoneList.sort((a, b) => (a.code === trRegion ? -1 : b.code === trRegion ? 1 : 0));

            const select = $(".countrySelect");
            filteredPhoneList.forEach(item => {
                select.append($('<option>', {
                    value: item.code,
                    text: item.emoji + ' ' + item.dial_code,
                    "data-mask": item.mask
                }));
            });

            select.on('change', function (e) {
                let selectedOption = $(this).find(':selected');
                let maskValue = selectedOption.attr('data-mask');
                if(maskValue) {
                    phoneMask1.updateOptions({
                        mask: maskValue,
                    });
                    phoneMask2.updateOptions({
                        mask: maskValue,
                    });
                } else {
                    phoneMask1.updateOptions({
                        mask: Number,
                    });
                    phoneMask2.updateOptions({
                        mask: Number,
                    });
                }
            });
        });

        const boxTemp = "checkbox";

        Dropzone.autoDiscover = false; // Dropzone otomatik algılamayı devre dışı bırak

        // Dropzone yapılandırması
        Dropzone.autoDiscover = false; // Dropzone otomatik algılamayı devre dışı bırak
        var myDropzone = new Dropzone("#myDropzone", {
            url: "/your-upload-url", // Sunucuya yükleme URL'sini buraya ekleyin
            autoProcessQueue: false, // Otomatik yükleme devre dışı bırakılır
            paramName: "file", // Sunucu tarafında dosyanın adı
            maxFilesize: 5, // Maksimum dosya boyutu (MB)
            acceptedFiles: ".pdf", // Kabul edilen dosya türleri
        });

        $('.pricing-wrapper.small.type').click(function () {
            const $type = $('#type');

            $type
                .find('.pricing-wrapper.small.type.border-primary.selected.active')
                .removeClass('border-primary selected active');

            $type
                .find('a.disabled')
                .removeClass('disabled')
                .text('Seç');

            if (!$(this).is('.border-primary, .selected, .active')) {
                $(this).addClass('border-primary selected active');
            }
            $(this).find('input').prop('checked', true).change();
            $('a', this).addClass('disabled').text('Seçildi');
        });


        $('#acceptTos').click(function () {
            const $tos = $('#terms_conditions');
            $tos.prop("checked", true);
            $('#tosModal').modal('toggle')
        })

        $('#rejectTos').click(function () {
            const $tos = $('#terms_conditions');
            $tos.prop("checked", false);
            $('#tosModal').modal('toggle')
        })

        $('#terms_conditions').change(function () {
            const $this = $(this);
            const $modal = $('#tosModal');
            if ($(this).is(':checked') === true) {
                $this.prop("checked", false);
                $modal.modal('toggle');
            }
        })

        wizardEl.on("leaveStep", function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
            $("html, body").animate({
                scrollTop: $(".content-inner").offset().top
            }, 10);

            console.log(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection)

            const steps = [0, 1, 2, 3, 4];
            if(!$(anchorObject.prevObject[nextStepIndex]).hasClass('done')) {
                if (steps.indexOf(currentStepIndex) !== -1 && steps.indexOf(nextStepIndex) !== -1) {
                    if (steps.indexOf(nextStepIndex) - steps.indexOf(currentStepIndex) === 1 || steps.indexOf(currentStepIndex) - steps.indexOf(nextStepIndex) === 1) {
                        //
                    } else {
                        e.preventDefault();
                    }
                }
            }

            if (currentStepIndex === 0) {
                if (!$('[name="type"]').is(':checked')) {
                    e.preventDefault();
                    _Swal({
                        icon: 'error',
                        title: '@lang('general.error')',
                        text: '@lang('subscribe.select.company.type')',
                        confirmButtonText: '@lang('general.ok')'
                    })
                }
            }

            setTimeout(function() {
                if ($('#type').css('display') === 'none') {
                    $('.sw-btn-prev').show();
                } else {
                    $('.sw-btn-prev').hide();
                }
            }, 200);

            if(currentStepIndex === 1 && nextStepIndex > 1) {
                const unmaskedValue1 = phoneMask1.unmaskedValue;
                const unmaskedValue2 = phoneMask2.unmaskedValue;

                if (unmaskedValue1 === '' || unmaskedValue1.length !== 10 || unmaskedValue2 === '' || unmaskedValue2.length !== 10) {
                    e.preventDefault();
                    _Swal({
                        icon: 'error',
                        title: '@lang('general.error')',
                        text: '@lang('general.phone.validation.error')',
                        confirmButtonText: '@lang('general.ok')'
                    })
                }
            }

            if(currentStepIndex === 2 && nextStepIndex > 2) {
                if(myDropzone.files.length === 0) {
                    e.preventDefault();
                    _Swal({
                        icon: 'error',
                        title: '@lang('general.error')',
                        text: '@lang('subscribe.accept.tos.error')',
                        confirmButtonText: '@lang('general.ok')'
                    })
                } else if (!$('[name="terms_conditions"]').is(':checked')) {
                    e.preventDefault();
                    _Swal({
                        icon: 'error',
                        title: '@lang('general.error')',
                        text: '@lang('subscribe.upload.documents.error')',
                        confirmButtonText: '@lang('general.ok')'
                    })
                }
            }

            if(currentStepIndex === 1 && nextStepIndex !== 0) {
                $('#information input, #information textarea, #information select').each(function(key, elem) {
                    if(elem.checkValidity() === false || $('#official_phone').val() === '(___) ___ ____' || $('#phone').val() === '(___) ___ ____') {
                        e.preventDefault();
                        elem.reportValidity();
                    }

                    let elementId = $(elem).attr('id');
                    let elementValue = $(elem).val();

                    $('#' + elementId + '-label').text(elementValue);
                });
            }

            function formatPhoneNumber(phoneNumber) {
                return phoneNumber.replace(/\D/g, '');
            }

            const nextButton = $('.sw-btn-next');

            setTimeout(function() {
                if($('#summary').css('display') === 'block'){
                    nextButton.text('@lang('subscribe.complete')');
                    nextButton.removeClass('disabled');
                    nextButton.attr('id', 'complete');
                    $(document).on('click', '#complete', function() {
                        const packageInput = $('[name="package_id"]');
                        const cycleInput = $('[name="billingCycle"]');
                        const official_phone = $('[name="official_phone"]');
                        const phone = $('[name="phone"]');

                        _Swal({
                            icon: 'warning',
                            title: '@lang('general.warning')',
                            showLoaderOnConfirm: true,
                            text: '@lang('subscribe.register.warn')',
                            confirmButtonText: '@lang('general.yes')',
                            cancelButtonText: '@lang('general.no')',
                            showCancelButton: true,
                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                            if (result.value === true) {
                                let formData = new FormData($("#subscription-form")[0]);

                                formData.append('payment_frequency', cycleInput.val());
                                formData.append('package_id', packageInput.val());
                                formData.set('official_phone', formatPhoneNumber(official_phone.val()));
                                formData.set('phone', formatPhoneNumber(phone.val()));

                                myDropzone.files.forEach(function (file) {
                                    formData.append("files[]", file);
                                });

                                $.ajax({
                                    url: "{{ route("companies.register.request") }}",
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: "@lang('general.please.wait')",
                                            allowEscapeKey: false,
                                            allowOutsideClick: false,
                                            didOpen: () => {
                                                Swal.showLoading();
                                            }
                                        });
                                    },
                                    success: function () {
                                        _Swal({
                                            title: '@lang('general.success')',
                                            icon: 'success',
                                            text: '@lang('subscribe.register.success')',
                                            confirmButtonText: '@lang('general.ok')',
                                            showCancelButton: false,
                                        }).then(function() {
                                            window.location.replace("{{ url('/') }}");
                                        });
                                    },
                                    error: function (error) {
                                        console.log(error.responseJSON.errors)
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
                                            showCancelButton: false,
                                        })
                                    }
                                });
                            }
                        });
                    })
                } else {
                    nextButton.text('@lang('subscribe.next_step')');
                    nextButton.attr('id', '');
                }
            }, 200)
        });
    </script>
    @include('applications.payment.management::includes.pricing')
@endpush