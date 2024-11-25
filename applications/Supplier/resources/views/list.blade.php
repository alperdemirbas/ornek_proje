@extends('layouts.datatable')
@section('title', trans('title.activity.list'))
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
                                    <label for="">@lang('general.status')</label>
                                    <select class="form-control default-select dashboard-select-2 h-auto wide"
                                            aria-label="Default select example" tabindex="null" id="status">
                                        @foreach(\Rezyon\Supplier\Enums\ActivityStatusEnum::values() as $status)
                                            <option value="{{ $status }}">@lang('general.'.$status)</option>
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
        let activityFilter = {};

        const variables = {
            "btn_filter": $("#btn_filter"),
            "status": $("#status"),
        };

        $(variables.btn_filter).on('click', () => {
            let obj = {};

            if (variables.status.val() !== "") obj.status = variables.status.val();

            activityFilter = obj;
            window.LaravelDataTables['activitylist-table'].ajax.reload();

        });

    </script>
@endpush