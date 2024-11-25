@extends('layouts.core')

@section('content')
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <svg class="logo-abbr" xmlns="http://www.w3.org/2000/svg" width="62.074" height="65.771" viewBox="0 0 62.074 65.771">
                    <g id="search_11_" data-name="search (11)" transform="translate(12.731 12.199)">
                        <rect class="rect-primary-rect" id="Rectangle_1" data-name="Rectangle 1" width="60" height="60" rx="30" transform="translate(-10.657 -12.199)" fill="#f73a0b"/>
                        <path id="Path_2001" data-name="Path 2001" d="M32.7,5.18a17.687,17.687,0,0,0-25.8,24.176l-19.8,21.76a1.145,1.145,0,0,0,0,1.62,1.142,1.142,0,0,0,.81.336,1.142,1.142,0,0,0,.81-.336l19.8-21.76a17.687,17.687,0,0,0,29.357-13.29A17.57,17.57,0,0,0,32.7,5.18Zm-1.62,23.392A15.395,15.395,0,0,1,9.312,6.8,15.395,15.395,0,1,1,31.083,28.572Zm0,0" transform="translate(1 0)" fill="#fff" stroke="#fff" stroke-width="1"/>
                        <path id="Path_2002" data-name="Path 2002" d="M192.859,115.547a4.523,4.523,0,0,0,.7-2.415v-2.284a4.55,4.55,0,0,0-9.1,0v2.284a4.523,4.523,0,0,0,.7,2.415,4.954,4.954,0,0,0-3.708,4.788v1.623a2.4,2.4,0,0,0,2.4,2.4h10.323a2.4,2.4,0,0,0,2.4-2.4v-1.623a4.954,4.954,0,0,0-3.708-4.788Zm-6.114-4.7a2.259,2.259,0,0,1,4.518,0v2.284a2.259,2.259,0,1,1-4.518,0Zm7.53,11.111a.11.11,0,0,1-.11.11H183.843a.11.11,0,0,1-.11-.11v-1.623a2.656,2.656,0,0,1,2.653-2.653h5.237a2.656,2.656,0,0,1,2.653,2.653Zm0,0" transform="translate(-168.591 -98.178)" fill="#fff" stroke="#fff" stroke-width="1"/>
                    </g>
                </svg>

                <svg class="brand-title" xmlns="http://www.w3.org/2000/svg" width="134.01" height="48.365" viewBox="0 0 134.01 48.365">
                    <g id="Group_38" data-name="Group 38" transform="translate(-133.99 -40.635)">
                        <text id="Job_Admin_Dashboard" data-name="Job Admin Dashboard" transform="translate(134 85)" fill="#787878" font-size="12" font-family="Poppins-Light, Poppins" font-weight="300"><tspan x="0" y="0">Job Admin Dashboard</tspan></text>
                        <path id="Path_1948" data-name="Path 1948" d="M.36,6.616a1.661,1.661,0,0,0,1.094-.422,1.287,1.287,0,0,0,.5-1.016V-11.738H7.52L7.551,5.271A8.16,8.16,0,0,1,6.91,8.789a4.074,4.074,0,0,1-2.2,1.985,11.542,11.542,0,0,1-4.346.657ZM17.651,9.68A7.316,7.316,0,0,1,13.7,8.617a7.008,7.008,0,0,1-2.626-2.97,9.786,9.786,0,0,1-.922-4.315,9.276,9.276,0,0,1,.907-4.174,6.935,6.935,0,0,1,2.6-2.877,7.438,7.438,0,0,1,4-1.047,7.607,7.607,0,0,1,4.018,1.032,6.8,6.8,0,0,1,2.611,2.861,9.349,9.349,0,0,1,.907,4.205,9.759,9.759,0,0,1-.922,4.33,6.993,6.993,0,0,1-2.642,2.955A7.4,7.4,0,0,1,17.651,9.68Zm0-4.565a1.753,1.753,0,0,0,1.438-.954,5.2,5.2,0,0,0,.625-2.83,4.8,4.8,0,0,0-.594-2.626,1.73,1.73,0,0,0-1.47-.907,1.694,1.694,0,0,0-1.454.907,4.908,4.908,0,0,0-.578,2.626,5.309,5.309,0,0,0,.61,2.83A1.718,1.718,0,0,0,17.651,5.115Zm17.478,4.6q-2.345,0-5.972-.375L27.75,9.18V-12.238h5.44V-6.11q.25-.094.844-.3a6.64,6.64,0,0,1,1.079-.281,6.807,6.807,0,0,1,1.079-.078,5.75,5.75,0,0,1,4.737,1.939q1.579,1.939,1.579,6.285,0,4.377-1.767,6.316T35.129,9.711Zm-.594-4.878a2.3,2.3,0,0,0,1.876-.719A4.131,4.131,0,0,0,37,1.551Q37-1.92,34.754-1.92q-.719,0-1.563.063v6.6A10.43,10.43,0,0,0,34.535,4.834ZM45.134-6.36h5.44V9.274h-5.44Zm.031-6.222h5.44V-7.36h-5.44ZM59.611,9.68a5.9,5.9,0,0,1-4.909-2q-1.595-2-1.595-6.222a12.451,12.451,0,0,1,.844-5.143A4.635,4.635,0,0,1,56.3-6.125a9.87,9.87,0,0,1,3.846-.641,13.2,13.2,0,0,1,2.095.188q1.157.188,3.033.625L65.145-1.7q-2.908-.219-3.627-.219a4.459,4.459,0,0,0-1.845.3,1.565,1.565,0,0,0-.844.985,6.976,6.976,0,0,0-.219,2A7.45,7.45,0,0,0,58.845,3.5a1.625,1.625,0,0,0,.86,1.032,4.362,4.362,0,0,0,1.813.3l3.6-.219L65.27,8.9A27.641,27.641,0,0,1,59.611,9.68Zm8.473-21.918h5.44V-.325l1.032-.406L76.714-6.36H82.78L79.4,1.207,83,9.274H76.9L74.744,3.958l-1.219.406V9.274h-5.44Z" transform="translate(133.63 53.217)" fill="#464646"/>
                    </g>
                </svg>
            </a>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <form action="" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="dropdown-item ai-icon">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">@lang('auth.logout') </span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="content-body ms-auto">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-5 offset-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Ödeme</h4>
                                <form class="needs-validation" id="payment-form" action="https://www.paytr.com/odeme" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-name"  class="form-label">Kart Sahibi</label>
                                            <input type="text" class="form-control" id="cc-name" name="cc_owner" placeholder="" required>
                                            <small class="text-muted">Kart üzerinde gösterilen tam ad</small>
                                            <div class="invalid-feedback">
                                                Bu alan gereklidir.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-number"  class="form-label">Kart Numarası</label>
                                            <input type="text" class="form-control" id="cc-number" name="card_number" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Bu alan gereklidir.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="cc-expiration-month"  class="form-label">Ay</label>
                                                    <input type="text" class="form-control" id="cc-expiration-month" name="expiry_month" placeholder="" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cc-expiration-year"  class="form-label">Yıl</label>
                                                    <input type="text" class="form-control" id="cc-expiration-year" name="expiry_year" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-expiration"  class="form-label">Güvenlik Kodu (CVV)</label>
                                            <input type="text" class="form-control" id="cc-cvv" name="cvv" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Bu alan gereklidir.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-none">
                                        <label for="payment_type"></label>
                                        <input type="text" class="form-control" name="payment_type" id="payment_type" value="card">
                                    </div>
                                    <div class="d-block mb-2 d-flex justify-content-start">
                                        <div class="form-check custom-radio me-3">
                                            <input type="radio" class="form-check-input" value="1" name="installment"
                                                   id="installment">
                                            <label class="form-check-label" for="credit">Taksitli</label>
                                        </div>
                                        <div class="form-check custom-radio">
                                            <input type="radio" class="form-check-input" value="0" name="installment"
                                                   id="no_installment" checked>
                                            <label class="form-check-label" for="debit">Tek Çekim</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" id="installment_select">
                                            <select class="default-select form-control wide w-100 d-none" name="installment_count">
                                                <option selected value="0">0</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6" id="card_type_select">

                                        </div>
                                    </div>
                                    <div class="col-md-5" id="meta_data">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card h-auto">
                            <div class="card-body">
                                <h4 class="mb-3">Hesap Durumu</h4>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        Bugün ödenmesi gereken
                                        <strong class="fs-4">100₺</strong>
                                    </li>
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        KDV %20
                                        <strong>20₺</strong>
                                    </li>
                                </ul>
                                <div class="form-check custom-checkbox mt-5">
                                    <input type="checkbox" class="form-check-input"
                                           name="terms_conditions"
                                           id="terms_conditions">
                                    <label class="form-check-label" for="terms_conditions">
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                           data-bs-target="#tosModal">Kullanım
                                            Sözleşmesi</a>'ni okudum kabul ediyorum.</label>
                                </div>
                                <button class="btn btn-primary btn-block" id="payment" type="button">Ödeme Yap</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title">
                                <div class="cpa">
                                    Taksit Seçenekleri
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body form excerpt">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="nowrap text-center" scope="col">Taksit</th>
                                                    <th scope="col">World</th>
                                                    <th scope="col">Maximum</th>
                                                    <th scope="col">CardFinans</th>
                                                    <th scope="col">Paraf</th>
                                                    <th scope="col">Advantage</th>
                                                    <th scope="col">Combo</th>
                                                    <th scope="col">Bonus</th>
                                                    <th scope="col">SağlamKart</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        1 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        2 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        3 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        4 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        5 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        6 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        7 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        8 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        9 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        10 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        11 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" nowrap>
                                                        12 Taksit
                                                    </td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                    <td class="text-center">%10</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg" id="tosModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg my-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kullanım Sözleşmesi</h5>
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
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal" id="rejectTos">Kabul
                        Etmiyorum
                    </button>
                    <button type="button" class="btn btn-success light" id="acceptTos">Kabul Ediyorum</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('library.js')
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/cms.js') }}"></script>
@endpush

@push('library.css')
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/toastr/css/toastr.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('assets/vendor/imask/imask.min.js') }}"></script>
    <script>
        IMask(
            document.getElementById('cc-expiration-month'),
            {
                mask: IMask.MaskedRange,
                from: 1,
                to: 12
            }
        )

        IMask(
            document.getElementById('cc-expiration-year'),
            {
                mask: IMask.MaskedRange,
                from: 23,
                to: 30
            }
        )

        IMask(
            document.getElementById('cc-number'),
            {
                mask: '0000 0000 0000 0000',
            }
        )

        IMask(
            document.getElementById('cc-cvv'),
            {
                mask: '000[0]',
            }
        )

        $(document).ready(function() {
            $('.SlideToolHeader').click()
        })

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

        $('#payment').click(function() {
            if (!$('[name="terms_conditions"]').is(':checked')) {
                _Swal({
                    icon: 'error',
                    title: 'Hata!',
                    text: 'Kullanım sözleşmesini onaylamanız gerekmektedir.',
                    confirmButtonText: 'Tamam'
                })
            } else {
                // Kredi kartı inputunu maskeyi kaldırarak al
                var creditCardInput = $('#cc-number');
                var unmaskedValue = creditCardInput.val().replace(/\D/g, ''); // Sadece sayıları al

                // Maske kaldırılmış değeri inputa set et
                creditCardInput.val(unmaskedValue);

                // Formu submit et
                $('#payment-form').submit();
            }

        });

        @if(!empty($data['installments']) && !empty($data['credit_cards']))
        const installments = @json($data['installments']);
        const card_types = @json($data['credit_cards']);
        $('input[type=radio][name=installment]').change(function () {
            const installment = $(this).val();
            let installmentHtml = "";
            let cardTypeHtml = "";
            if (installment === "1") {
                installmentHtml = `<label class="form-label" for="installment_count">Taksit Seçenekleri</label><select class="default-select form-control wide w-100" name="installment_count" id="installment_count">`;
                for (let k in installments) {
                    const selected = (k === '0') ? 'selected' : "";
                    const item = installments[k];
                    installmentHtml += `<option value="${k}" ${selected}>${item} Taksit</option>`;
                }
                installmentHtml += `</select>`;

                cardTypeHtml = `<label class="form-label" for="card_type">Kart Türü</label><select class="default-select form-control wide w-100 mb-3"  name="card_type" id="card_type">`;
                for (let k in card_types) {
                    const item = card_types[k];
                    const selected = (k === '0') ? 'selected' : "";
                    cardTypeHtml += `<option value="${k}" ${selected}>${item}</option>`;
                }
                cardTypeHtml += `</select>`;
            } else {
                installmentHtml = `<select class="default-select form-control wide w-100 d-none" name="installment_count">`;
                installmentHtml += `<option selected value="0">0</option>`;
                installmentHtml += `</select>`;
            }

            $('#installment_select').html(installmentHtml);
            $('#card_type_select').html(cardTypeHtml);
        });
        @endif
        function getData() {
            const data = {};
            data._token = '{{ csrf_token() }}';
            data.installment_count = $('body').find('input[name="installment_count"]').val() ?? 0;
            console.log(data);
            $.post('{{ _route('payment.generate.data') }}', data, function (data) {

                let html = '';
                for (let k in data) {
                    html += ` <input type="hidden" class="form-control" name="${k}" id="${k}" value="${data[k]}">`
                }
                $('#meta_data').html(html);
            });
            return data;
        }
        $(document).on('change', '[name="installment_count"]', function() {
            getData()
        })
        $(document).on('change', '[name="card_type"]', function() {
            getData()
        })
        getData();
    </script>
@endpush
