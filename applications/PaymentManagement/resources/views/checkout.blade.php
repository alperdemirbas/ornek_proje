<!DOCTYPE html>
<html lang="tr" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} - Checkout</title>
    {{--<meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    <link rel="shortcut icon" type="image/png" href="#">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
</head>

<body class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" id="payment-form" action="https://www.paytr.com/odeme" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name"  class="form-label">Kart Sahibi</label>
                                <input type="text" class="form-control" id="cc-name" name="cc_owner" placeholder="" required>
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
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="cc-expiration-month"  class="form-label">Ay</label>
                                <input type="text" class="form-control" id="cc-expiration-month" name="expiry_month" placeholder="" required>
                            </div>
                            <div class="col-4">
                                <label for="cc-expiration-year"  class="form-label">Yıl</label>
                                <input type="text" class="form-control" id="cc-expiration-year" name="expiry_year" placeholder="" required>
                            </div>
                            <div class="col-4">
                                <label for="cc-expiration"  class="form-label">CVV</label>
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
                        <div class="form-check custom-checkbox mt-3">
                            <input type="checkbox" class="form-check-input"
                                   name="terms_conditions"
                                   id="terms_conditions">
                            <label class="form-check-label" for="terms_conditions">
                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                   data-bs-target="#tosModal">Kullanım
                                    Sözleşmesi</a>'ni okudum kabul ediyorum.</label>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Taksit Seçenekleri</h3>
                </div>
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

            <div class="summary cart-bottom">
                <div id="dropUpContent" style="display:none">
                    <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
                        <span>Lorem ipsum</span>
                        <span class="text-dark text-black">2000₺</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="m-auto mx-2">
                        <a class="text-primary" href="javascript:void(0);" id="dropUp"><i class="fa-solid fa-chevron-up"></i></a>
                    </div>
                    <div class="d-grid w-100">
                        <span class="fw-bold text-dark">Toplam</span>
                        <span class="total">1.483,99 ₺</span>
                    </div>
                    <button type="button" id="confirmCart" class="btn btn-primary btn-lg w-100">Onayla ve Bitir</button>
                </div>
            </div>
        </div>
    </div>

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
</body>
<script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/js/dlabnav-init.js') }}"></script>

<script src="{{ asset('assets/js/dashboard/cms.js') }}" ></script>

<!-- Start : Extent Javascript -->
<script src="{{ asset('assets/js/smooth.scroll.js') }}"></script>


{{--<script>
    const csrf =  $('meta[name="csrf-token"]').attr('content');
</script>--}}
<script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<script src="{{ asset('assets/vendor/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/cms.js') }}"></script>
<script src="{{ asset('assets/vendor/imask/imask.min.js') }}"></script>
<script>
    $('#dropUp').click(function() {
        $("#dropUpContent").slideToggle();
    });

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
        $('.SlideToolHeader').click();
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
        $.post('{{ route('payment.generate.data', ['subdomain' => $domain]) }}', data, function (data) {
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
</html>