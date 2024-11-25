@extends('layouts.admin')
@section('title', 'Transfer Ekle')
@section('MainPageUrl', _route('transfers.index'))
@section('MainPage', 'Transferler')
@section('SubPage', 'Transfer Ekle')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">Transfer Ekle</h6>
                </div>
                <form action="{{ _route('transfers.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 my-3">
                                <label class="form-label">Aktivite<span class="text-red">*</span></label>
                                <select class="form-control select2" id="activity" name="activity_id" required>
                                    <option value="">Aktivite Seçiniz</option>
                                    @foreach($activities as $activity)
                                        <option data-start="{{ $activity->activity->start_time }}" data-end="{{ $activity->activity->end_time }}" value="{{ $activity->activity->id }}">@lang($activity->activity->name)</option>
                                    @endforeach
                                </select>
                                <select class="form-control d-none" id="sessions" name="activity_session_id" required>
                                    <option value="">Seans Seçiniz</option>
                                </select>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Aktivite Tarihi<span class="text-red">*</span></label>
                                <select class="form-control select2" id="order_date" name="date" required>
                                    <option value="">Tarih Seçiniz</option>
                                </select>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Transfer Aracı<span class="text-red">*</span></label>
                                <select class="form-control select2" name="cars_id" required>
                                    <option value="">Araç Seçiniz</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}">@lang($car->name)</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Buluşma Yeri<span class="text-red">*</span></label>
                                <select class="form-control select2" name="hotel_id" required>
                                    <option value="">Otel Seçiniz</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}">@lang($hotel->name)</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Buluşma Zamanı<span class="text-red">*</span></label>
                                <input type="text" class="form-control time-picker" name="time" required>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Sürücü Adı<span class="text-red">*</span></label>
                                <input required type="text" class="form-control" name="driver_name" required>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="text-label form-label">Sürücü Telefonu<span class="text-red">*</span></label>
                                <div class="mb-3 d-flex phone-group">
                                    <select id="phone_country" name="driver_phone_country" class="select2 countrySelect w-25" required></select>
                                    <input type="text" name="driver_phone" id="phone" class="form-control phone-mask" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">@lang('general.save')</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/imask/imask.min.js') }}"></script>
    <script src="{{ asset('assets/js/phone-codes.js') }}"></script>
    <script>
        $('#activity').change(function() {
            let selectedStartDateStr = $('option:selected', this).attr('data-start');
            let selectedEndDateStr = $('option:selected', this).attr('data-end');
            let selectedStartDate = new Date(selectedStartDateStr);
            let selectedEndDate = new Date(selectedEndDateStr);
            selectedStartDate = new Date(selectedStartDate.setHours(selectedStartDate.getHours() - 2));
            selectedEndDate = new Date(selectedEndDate.setHours(selectedEndDate.getHours() - 2));

            let time_picker = $('.time-picker');
            time_picker.bootstrapMaterialDatePicker('destroy');
            time_picker.off();
            time_picker.removeData();
            time_picker.bootstrapMaterialDatePicker({
                date: false,
                format: 'HH:mm',
                minDate: selectedStartDate,
                maxDate: selectedEndDate,
                time: true,
                weekStart : 1,
                switchOnClick : true
            })

            let url =  "{{ _route('supplier.activity.sessions', ['activity' => '__']) }}";
            url = url.replace('__', $(this).val());
            $.ajax({
                type: "GET",
                url: url,
                header: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if(response.length > 0) {
                        $('#sessions').removeClass('d-none').select2();
                        $.each(response, function(key, elem) {
                            $('#sessions').append(`<option value="${elem.id}">${elem.start_time} - ${elem.end_time}</option>`);
                        })
                    } else {
                        $('#sessions').addClass('d-none').select2('destroy');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#sessions').addClass('d-none').select2('destroy');
                    console.log(jqXHR, textStatus, errorThrown)
                }
            })

            $.ajax({
                type: "GET",
                url: "{{ _route('cart.by.date') }}",
                header: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: {
                  "activity_id": $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if(response.length > 0) {
                        $.each(response, function(key, elem) {
                            $('#order_date').append(`<option value="${elem}">${moment(elem).format('DD/MM/YYYY')}</option>`);
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown)
                }
            })
        });

        $('form').submit(function(event) {
            $('#phone').val(phoneMask1.unmaskedValue)
            _Swal({
                title: "Lütfen Bekleyiniz...",
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });

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
    </script>
@endpush