@extends('layouts.admin')
@section('title', trans('title.activity.add'))

@section('main-content')
    <div class="row">
        <div class="col-12 text-end mb-2">
            <!-- Start : Grup Oluştur -->
            <input type="button"
                   class="btn btn-sm btn-outline-success"
                   value="Grup Oluştur"
                   data-card="create-group">

            <!-- Start : Yolcu Kartı Oluştur -->
            <input type="button" class="btn btn-sm btn-outline-success" value="Yolcu Kartı Ekle"
                   data-card="add-customer-card"></div>
        <div class="col-xl-12">
            <form action="{{ _route('company.customer.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row customers">

                    <!-- Start : Personal Card -->
                    <div class="col-12 customer-card">
                        <div class="card">
                            <div class="text-end card-title">
                                <button type="button" class="btn btn-sm btn-transparent m-2 close"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="filter cm-content-box box-primary">
                                        <div class="cm-content-body publish-content form excerpt">

                                            <div class="row">
                                                <!-- Start : Müşteri Adı -->
                                                <div class="col-4 mb-3">
                                                    <label class="form-label d-block">{{__('customer.first_name')}}</label>
                                                    <input required type="text" name="first_name[]" class="form-control"
                                                           value="John">
                                                </div>

                                                <!-- Start : Müşteri Soyadı -->
                                                <div class="col-4 mb-3">
                                                    <label class="form-label d-block">{{__('customer.last_name')}}</label>
                                                    <input required type="text" name="last_name[]" class="form-control"
                                                           value="Doe">
                                                </div>

                                                <!-- Start : Müşteri Mail Adresi -->
                                                <div class="col-4 mb-3">
                                                    <label class="form-label d-block">{{__('general.email')}}</label>
                                                    <input required type="email" name="email[]" class="form-control"
                                                           value="{{ Str::random(8).'@example.com' }}">
                                                </div>

                                                <!-- Start : Müşteri Doğum Tarihi -->
                                                <div class="col-4 mb-3">
                                                    <label class="form-label d-block">{{__('general.birthdate')}}</label>
                                                    <input required type="text" name="birthdate[]" class="form-control"
                                                           value="1987-01-15"/>
                                                </div>

                                                <!-- Start : Müşteri Cinsiyet -->
                                                <div class="col-4 mb-3">
                                                    <label>{{__('general.gender')}}</label>
                                                    <select required class="form-control" name="gender[]">
                                                        <option value="">{{__('general.please_make_your_choice')}}</option>
                                                        @foreach($data['gender'] as $item=>$value)
                                                            <option value="{{$value}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-4 mb-3">
                                                    <label for="group">Grup Adı (DB'den çek)</label>
                                                    <select required name="group[]" class="form-control">
                                                        <option value="" selected>Seçim Yapınız</option>
                                                        @foreach($data['groups'] as $item=>$group)
                                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Start : Geliş Tarihi -->
                                                <div class="col-3 mb-3">
                                                    <label class="form-label d-block">{{__('user.customer_arrival_date')}}</label>
                                                    <input required type="text" name="customer_arrival_date[]"
                                                           class="form-control" value="2024-03-11"/>
                                                </div>

                                                <!-- Start : Dönüş Tarihi -->
                                                <div class="col-3 mb-3">
                                                    <label class="form-label d-block">{{__('user.customer_return_date')}}</label>
                                                    <input required type="text" name="customer_return_date[]"
                                                           class="form-control" value="2024-03-18"/>
                                                </div>

                                                <!-- Start :  Grup Tipi -->
                                                <div class="col-3 mb-3">
                                                    <label for="group">Grup Tipi</label>
                                                    <select required name="group_type[]" class="form-control">
                                                        <option selected value="">Lütfen bir seçim yapınız.</option>
                                                        @foreach($data['groupType'] as $item=>$value)
                                                            <option value="{{$value}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Start :  Status -->
                                                <div class="col-3 mb-3">
                                                    <label for="group">Durumu</label>
                                                    <select required name="status[]" class="form-control">
                                                        <option selected value="">Lütfen bir durum seçiniz.</option>
                                                        @foreach($data['statusType'] as $item=>$value)
                                                            <option value="{{$value}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End : Personal Card -->

                    <div class="col-12">
                        <button type="submit" class="btn btn-success float-end mb-3">{{__('general.save')}}</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(() => {

            const variables = {
                "btn_creat_group": $("[data-card='create-group']"),
                "group_select": $("[name='group[]']"),
                "add_customer_card": $("[data-card='add-customer-card']"),
                "customer_card": $(".customer-card")[0],
                "close_card": $(".close"),
            };

            function groupCreateModal() {
                Swal.fire({
                    icon: 'info',
                    title: 'Grup Oluştur',
                    inputPlaceholder: 'Örnek : VIP Müşteriler, Araçla gelenler, yabancı müşteri ...',
                    showCancelButton: true,
                    reverseButtons: true,
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Grup Oluştur",
                    footer: 'Bir grup oluşturarak belirli kişileri bir başlık altında toplayabilirsiniz.',
                    cancelButtonText: "Vazgeç",
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: "btn btn-light",
                        confirmButton: "ms-2 btn btn-success",
                    }
                }).then((resolve) => {
                    if (resolve.isConfirmed) {
                        console.log(resolve.value);
                        $.ajax({
                            type: "POST",
                            url: 'blablabla',
                            data: {
                                name: '', // Grup adı
                            },
                            success: () => {
                                console.log("bitti");
                            },
                            dataType: 'JSON'
                        });

                        try {
                            const githubUrl = `https://api.github.com/users/${login}`;
                            const response = fetch(githubUrl);
                            if (!response.ok) {
                                return Swal.showValidationMessage(`
                                    ${JSON.stringify(response.json())}
                                `);
                            }
                            return response.json();
                        } catch (error) {
                            Swal.showValidationMessage(`
                            Request failed: ${error}
                            `);
                        }

                        // Eğer grup oluşturma işlemi olursa aşağıdaki verileri değiştir.
                        var optgroup = $("[name='group[]'] optgroup[label='Aktif Gruplar']");
                        optgroup.append("<option value='asd'>" + resolve.value + "</option>");

                    } else {

                        console.log("Grup oluşturma iptal oldu");
                    }
                });
            }

            /**
             * Grup oluştur modal aç
             */
            $(variables.btn_creat_group).on('click', (e) => {
                groupCreateModal();
            });

            /**
             * SelectBox'dan YENİ GRUP OLUŞTUR butonu tıkladığında modal aç.
             */
            $(variables.group_select).on('change', (e) => {
                let select = $(e.target).val();
                if (select === "newGroup") {
                    groupCreateModal();
                }
                /**
                 * unique bir grup adı oluştur. Araçla gelenler, VIP yolcular, yabancılar, v.b.
                 * selectbox'a ekle
                 *
                 */
            });

            /**
             * Yolcu Katı Ekle Modal Aç
             */
            $(variables.add_customer_card).on('click', (e) => {
                const htmlTemplate = `<div class='text-start'>
                            <h4>Yolcu kartı nedir?</h4>
                            <p>Farklı bir yolcu daha eklemeniz için açılan bir kart.</p>
                    </div>`
                Swal.fire({
                    title: "Yolcu Kartı Yarat",
                    icon: "info",
                    html: htmlTemplate,
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonText: "Yolcu Ekle",
                    cancelButtonText: "Vazgeç",
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: "btn btn-light",
                        confirmButton: "ms-2 btn btn-success",
                    }
                })
                    .then((resolve) => {
                        if (resolve.isConfirmed) {
                            var customer_card = $(variables.customer_card).clone();
                            $(".customers").prepend(customer_card);

                            $(".customer-card")[0].animate({
                                opacity: 0.0,
                                transition:"-20px",
                            }, 200, null);
                        }
                    });
            });

            /**
             * Yolcu kartı kapat
             */
            $(document).on("click",".close", (e) => {
                e.preventDefault();
                const card = e.target;
                Swal.fire({
                    title: "Yolcu Kartını Kaldır",
                    icon: "question",
                    html: "Bu yolcu kartını kaldırmak istediğinize emin misiniz?",
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonText: "Evet eminim, kapat",
                    cancelButtonText: "Vazgeç",
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: "btn btn-light",
                        confirmButton: "ms-2 btn btn-success",
                    }
                }).then((resolve)=>{
                    if(resolve.isConfirmed){
                        let e = $(card).closest(".customer-card").remove();
                        console.log(e);

                    }
                });
            })

        });
    </script>
@endpush