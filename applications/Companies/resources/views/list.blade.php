@extends('layouts.datatable')
@section('title', trans('title.company.list'))
@section('sub-content')

    <div class="row">
        <div class="col-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i>{{__('general.filter')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="SlideToolHeader expand"><i
                                    class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt" style="">
                    <div class="card-body">
                        <div class="row">

                            <!-- Start : Firma Tipi -->
                            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                    <label for="">{{__('company.type')}}</label>
                                    <select class="form-control default-select dashboard-select-2 h-auto wide"
                                            aria-label="Default select example" tabindex="null" id="company_type">
                                        <option selected value="">{{__('general.all')}}</option>
                                        @foreach($companyType as $company)
                                            <option value="{{$company}}">{{__("company.".strtolower($company))}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Start : Paket Tipi -->
                            <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                                <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                    <label for="">{{__('company.package_type')}}</label>
                                    <select class="form-control default-select dashboard-select-2 h-auto wide"
                                            aria-label="Default select example" tabindex="null" id="package_id">
                                        <option selected value="">{{__('general.all')}}</option>
                                        @foreach($packages as $package)
                                            <option value="{{$package->id}}">{{$package->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Start : Ödeme Durumu -->
                            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                    <label for="">{{__('company.payment_status')}}</label>
                                    @php
                                        $notVisibleStatus = [
                                            \Rezyon\Companies\Enums\PaymentStatusesEnums::WAITING_APPROVAL->value,
                                            \Rezyon\Companies\Enums\PaymentStatusesEnums::WAITING_VERIFICATION->value,
                                        ];
                                    @endphp
                                    <select class="form-control form-control default-select dashboard-select-2 h-auto wide"
                                            aria-label="Default select example" tabindex="null" id="payment_status">
                                        <option selected value="">{{__('general.all')}}</option>
                                        @foreach($paymentStatus as $status)
                                            @if(!in_array($status,$notVisibleStatus))
                                                <option value="{{$status}}">{{__($status)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-xl-3 col-sm-6">
                                <label for="" class="d-block w-100">&nbsp;</label>
                                <button id="btn_filter" class="btn btn-info w-100" type="button"><i
                                            class="fa fa-search me-1"></i>{{__('general.filter')}}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let company_filter_data;
        const variables = {
            "btn_filter": $("#btn_filter"),
            "company_type": $("#company_type"),
            "package_id": $("#package_id"),
            "payment_status": $("#payment_status"),
        };

        $(variables.btn_filter).on('click', () => {
            let obj = {};

            if (variables.company_type.val() != "") obj.company_type = variables.company_type.val();
            if (variables.package_id.val() != "") obj.package_id = variables.package_id.val();
            if (variables.payment_status.val() != "") obj.payment_status = variables.payment_status.val();

            company_filter_data = obj;
            window.LaravelDataTables['companies-table'].ajax.reload();

        });

    </script>
@endpush