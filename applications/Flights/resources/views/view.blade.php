@extends('layouts.admin')
@section('MainPage',$mainPage ?? "")
@section('SubPage', $subPage ??"")

@section('main-content')
    <div class="d-flex align-items-center mb-4 flex-wrap">
        <h3 class="me-auto">@lang('flight.details')</h3>
        <div>
            <a href="javascript:void(0);" id="addCustomers" class="btn btn-primary me-3 btn-sm"><i class="fas fa-plus me-2"></i>@lang('add_customers')</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-xxl-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="fs-20 mb-0"><span class="text-primary">#{{ $flight->flight_number }}</span> Numaralı Uçuş Detayları @lang('flight.details_of_flight', ['flight' => $flight->flight_number])</h4>
                        </div>
                        <div class="card-body pt-4">
                            <div class="mb-3 d-flex">
                                <h5 class="mb-1 fs-14 custom-label me-2">@lang('flight.flight_number'):</h5>
                                <span>{{ $flight->flight_number }}</span>
                            </div>
                            <div class="mb-3 d-flex">
                                <h5 class="mb-1 fs-14 custom-label me-2">@lang('flight.departure_datetime'):</h5>
                                <span>{{ $flight->departure_time }}</span>
                            </div>
                            <div class="mb-3 d-flex">
                                <h5 class="mb-1 fs-14 custom-label me-2">@lang('flight.departure_iata'):</h5>
                                <span>{{ $flight->departure_airport }}</span>
                            </div>
                            <div class="mb-3 d-flex">
                                <h5 class="mb-1 fs-14 custom-label me-2">@lang('flight.arrival_datetime'):</h5>
                                <span>{{ $flight->arrival_time }}</span>
                            </div>
                            <div class="mb-3 d-flex">
                                <h5 class="mb-1 fs-14 custom-label me-2">@lang('flight.arrival_iata'):</h5>
                                <span>{{ $flight->arrival_airport }}</span>
                            </div>
                            <div class="mb-3 d-flex">
                                <h5 class="mb-1 fs-14 custom-label me-2">@lang('flight.return_datetime'):</h5>
                                <span>{{ $flight->return }}</span>
                            </div>
                            <div class="mb-3 d-flex">
                                <h5 class="mb-1 fs-14 custom-label">@lang('general.status'):</h5>
                                @if($flight->status === \Rezyon\Flights\Enums\FlightStatusEnums::ACTIVE->value)
                                    <span class="badge badge-success badge-lg light">@lang('flight.active')</span>
                                @elseif($flight->status === \Rezyon\Flights\Enums\FlightStatusEnums::LANDED->value)
                                    <span class="badge badge-warning badge-lg light">@lang('flight.landed')</span>
                                @elseif($flight->status === \Rezyon\Flights\Enums\FlightStatusEnums::RETURNED->value)
                                    <span class="badge badge-primary badge-lg light">@lang('flight.returned')</span>
                                @else
                                    <span class="badge badge-danger badge-lg light">@lang('flight.cancelled')</span>
                                @endif
                            </div>
                            <div class="mb-3 d-flex">
                                <h5 class="mb-1 fs-14 custom-label">@lang('flight.details'):</h5>
                                <span>{{ $flight->detail }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-xxl-8">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-3">
                        <div class="table-responsive">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('library.css')
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/buttons/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush
@push('library.js')
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/buttons/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/datatable-init.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>

    {{ $dataTable->scripts() }}
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {

            const dataTable = window.LaravelDataTables['flightcustomers-table'];

            $('#addCustomers').click(function() {
                Swal.fire({
                    title: '@lang('flight.add_customers_to_flight')',
                    customClass: 'addCustomers',
                    html: `<select class="multi-select-placeholder js-states" name="addCustomers[]" multiple="multiple">
                                        @foreach($customers as $customer)
                                            <option data-firstname="{{ $customer->firstname }}" data-lastname="{{ $customer->lastname }}" value="{{ $customer->id }}">#{{ $customer->pnr }} - {{ $customer->firstname }} {{ $customer->lastname }}</option>
                                        @endforeach
                                    </select>`,
                    heightAuto: true,
                    confirmButtonText: '@lang('general.ok')',
                    cancelButtonText: '@lang('general.cancel')',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let selectedValues = $('[name="addCustomers[]"]').val();
                        let selectedCustomers = [];
                        selectedValues.forEach(function(value) {
                            let option = $('option[value="' + value + '"]');
                            let firstname = option.data('firstname');
                            let lastname = option.data('lastname');
                            selectedCustomers.push({ id: value, firstname: firstname, lastname: lastname });
                        });

                        $.ajax({
                            type: "post",
                            url: "{{ _route('flights.addCustomer', ['flight' => $flight->id]) }}",
                            dataType: "json",
                            data: {
                                _token: csrf,
                                customers: selectedCustomers,
                            },
                            success: function(response) {
                                console.log(response)

                                Swal.fire({
                                    title: '@lang('general.success')',
                                    html: response.message,
                                    icon: 'success',
                                    confirmButtonText: '@lang('general.ok')',
                                })

                                window.LaravelDataTables['flightcustomers-table'].ajax.reload();
                            },
                            error: function(response) {
                                console.log(response)
                                const data = response.responseJSON.data;
                                if(data.length > 0) {
                                    Swal.fire({
                                        title: '@lang('general.error')',
                                        html: response.responseJSON.message + '<br/>@lang('flight.confirm_transfer')',
                                        icon: 'error',
                                        confirmButtonText: '@lang('general.ok')',
                                        cancelButtonText: '@lang('general.cancel')',
                                        showCancelButton: true,
                                    }).then((response) => {
                                        if(response.isConfirmed) {
                                            $.ajax({
                                                type: "post",
                                                url: "{{ _route('flights.transferCustomer', ['flight' => $flight->id]) }}",
                                                dataType: "json",
                                                data: {
                                                    _token: csrf,
                                                    customers: data,
                                                },
                                                success: function(response) {
                                                    console.log(response)

                                                    Swal.fire({
                                                        title: '@lang('general.success')',
                                                        html: response.message,
                                                        icon: 'success',
                                                        confirmButtonText: '@lang('general.ok')',
                                                    })

                                                    window.LaravelDataTables['flightcustomers-table'].ajax.reload();
                                                },
                                                error: function (response) {
                                                    console.log(response)
                                                }
                                            });
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: '@lang('general.error')',
                                        html: response.responseJSON.message,
                                        icon: 'error',
                                        confirmButtonText: '@lang('general.ok')',
                                    })
                                }
                            }
                        })
                    }
                },
                $(".multi-select-placeholder").select2({
                    placeholder: "@lang('flight.select_customer')",
                    dropdownParent: $('.addCustomers'),
                }));
            })

            $('body').on('click', '.changeStatus', function (e) {
                e.preventDefault();
                let $this = $(this);
                let data = {};
                let selectedRowsData = [];
                if($this.hasClass('check_in')) {
                    let selectedRows = dataTable.rows({ selected: true }).data(); // Seçili tüm satırların verilerini al
                    selectedRows.each(function(data) {
                        selectedRowsData.push(data.id);
                    });
                    data= {
                        _token: csrf,
                        row: {{ request()->route('flight') }},
                        uid: selectedRowsData,
                        role: 'check_in'
                    }
                } else if ($this.hasClass('check_out')) {
                    let selectedRows = dataTable.rows({ selected: true }).data(); // Seçili tüm satırların verilerini al
                    selectedRows.each(function(data) {
                        selectedRowsData.push(data.id);
                    });
                    data = {
                        _token: csrf,
                        row: {{ request()->route('flight') }},
                        uid: selectedRowsData,
                        role: 'check_out'
                    }
                } else {
                    data = {
                        _token: csrf,
                        row: $this.data('id'),
                        uid: $this.data('uid'),
                        role: $this.data('role')
                    };
                }
                $.ajax({
                    type: 'post',
                    url: '{{ _route('flights.changeStatus') }}',
                    data: data,
                    dataType: 'json',
                    complete: function () {
                        window.LaravelDataTables['flightcustomers-table'].ajax.reload();
                    }
                });
            });



            var bulkCheckInButton = $('.bulk-check-in');
            var bulkCheckOutButton = $('.bulk-check-out');

            function updateBulkCheckInButton() {
                var anyCheckboxChecked = false;

                // DataTables ile oluşturulan checkboxları seçme durumunu kontrol et
                $('.form-check-input', dataTable.rows().nodes()).each(function() {
                    if ($(this).is(':checked')) {
                        anyCheckboxChecked = true;
                        return false; // Döngüyü sonlandır
                    }
                });

                // Eğer en az bir checkbox seçiliyse disabled classını kaldır
                if (anyCheckboxChecked) {
                    bulkCheckInButton.removeClass('btn-light disabled').addClass('btn-success');
                    bulkCheckOutButton.removeClass('btn-light disabled').addClass('btn-danger');
                } else {
                    // Eğer hiçbir checkbox seçili değilse disabled classını ekle
                    bulkCheckInButton.removeClass('btn-success').addClass('btn-light disabled');
                    bulkCheckOutButton.removeClass('btn-danger').addClass('btn-light disabled');
                }
            }

            // Sayfa yüklendiğinde ve checkbox durumu değiştiğinde fonksiyonu çağır
            $(document).ready(function() {
                updateBulkCheckInButton();

                // DataTables'ta sayfa değiştikçe checkboxları tekrar kontrol etmek için
                dataTable.on('draw', function() {
                    updateBulkCheckInButton();
                });

                // #checkAll checkbox'ına tıklandığında tüm checkboxları seç
                $('#checkAll').change(function() {
                    var checked = this.checked;
                    $('.form-check-input', dataTable.rows().nodes()).each(function() {
                        $(this).prop('checked', checked);
                    });
                    updateBulkCheckInButton();
                });

                // DataTables içindeki .form-check-input class'ına sahip checkboxlara tıklandığında fonksiyonu çağır
                dataTable.on('change', '.form-check-input', function() {
                    updateBulkCheckInButton();
                });
            });

        });
    </script>
@endpush