@extends('layouts.admin')
@section('title', 'Otel Ekle')
@section('MainPage', 'Oteller')
@section('MainPageUrl', route('hotels.index'))
@section('SubPage', 'Otel Ekle')
{{-- @todo dil eklenecek --}}
@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">Otel Ekle</h6>
                </div>
                <form action="{{ route('hotels.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 my-3">
                                <label class="form-label">Otel Adı<span class="text-red">*</span></label>
                                <input required type="text" class="form-control" name="name">
                            </div>

                            <div class="col-sm-6 my-3">
                                <div class="mb-3">
                                    <label class="text-label form-label">Telefon<span class="text-red">*</span><span
                                                class="text-danger">*</span></label>
                                    <div class="mb-3 d-flex phone-group">
                                        <select id="phone_country" name="phone_country" class="select2 countrySelect w-25" required></select>
                                        <input type="text" name="phone" id="phone" class="form-control phone-mask" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('general.city')}}<span class="text-red">*</span></label>
                                <select required name="city" class="form-control mb-3 select2">
                                    <option>{{__('general.please_make_your_choice')}}</option>
                                </select>
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('general.district')}}<span class="text-red">*</span></label>
                                <select required name="district" class="form-control mb-3 select2">

                                </select>
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('general.status')}}<span class="text-red">*</span></label>
                                <select required name="status" class="form-control mb-3 select2">
                                    @foreach(\Rezyon\Hotels\Enums\StatusEnum::cases() as $status)
                                        <option value="{{ $status->value }}">{{ __('general.'.$status->value) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 my-3">
                                <label class="form-label">{{__('general.address')}}<span class="text-red">*</span></label>
                                <textarea required class="form-control" name="address"></textarea>
                            </div>



                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Oluştur</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/imask/imask.min.js') }}"></script>
    <script src="{{ asset('assets/js/phone-codes.js') }}"></script>
    <script>
        const phoneMask1 = IMask(
            document.querySelector('#phone'),
            {
                mask: '(000)000-0000',
                lazy: false,
                placeholderChar: '_'
            }
        );


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
            } else {
                phoneMask1.updateOptions({
                    mask: Number,
                });
            }
        });

        // Locations List
        !(()=>{
            let city_id;
            let districtList;

            const options = {
                method: 'GET',
            };

            fetch('/locations', options)
                .then(response => response.json())
                .then(body => {
                    $.each(body,(index,value)=>{
                        $("[name='city']").append(`<option value=${value.id}>${value.city_name}</option>`);
                    })
                });

            $(document).on('change',"[name='city']",(e)=>{
                $("[name='district'] ").empty();
                $("[name='district']").empty().append(`<option>{{__('general.loading')}}</option>`);
                city_id = $("[name='city']").val();
                fetch('/locations?sort=+id&filter[id]='+city_id+'&include=district', options)
                    .then(response => response.json())
                    .then(body => {
                        $("select[name='district']").empty().append(`<option>{{__('general.please_make_your_choice')}}</option>`);
                        $.each(body,(index,value)=>{
                            districtList = value.district;
                            $.each(districtList,(districtIndex,districtValue)=>{
                                $("[name='district']").append(`<option value=${districtValue.id}>${districtValue.district_name}</option>`);
                            });
                        });
                    });
            });
        })();
    </script>
@endpush