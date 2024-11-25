@extends('layouts.admin')
@section('title', trans('title.package.show'))

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card  card-bx m-b30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 my-3">
                            <label class="form-label">{{__('general.package_name')}}</label>
                            <input type="text" class="form-control" value="{{$detail->name}}" readonly disabled>
                        </div>

                        <div class="col-sm-4 my-3">
                            <label class="form-label ">{{__('package.package')}}</label>
                            <div class="dropdown bootstrap-select nice-select default-select form-control wide mh-auto">
                                <input type="text" class="form-control" value="{{$detail->type}}" readonly disabled>
                            </div>
                        </div>

                        <div class="col-sm-4 my-3">
                            <label class="form-label">{{__('general.sale_price')}}</label>
                            <input class="form-control" value="{{$detail->fee}}" readonly disabled>
                        </div>

                        <div class="col-4 my-3">
                            <label class="form-label">{{__('general.quarter_yearly_discount')}}</label>
                            <div class="input-group mb-2">
                                <div class="input-group-text">%</div>
                                <input type="text" class="form-control" value="{{$detail->quarter_yearly_discount}}"
                                       readonly disabled>
                            </div>
                        </div>

                        <div class="col-4 my-3">
                            <label class="form-label">{{__('general.half_yearly_discount')}}</label>
                            <div class="input-group mb-2">
                                <div class="input-group-text">%</div>
                                <input type="text" class="form-control" value="{{$detail->half_yearly_discount}}"
                                       readonly disabled>
                            </div>
                        </div>
                        <div class="col-4 my-3">
                            <label class="form-label">{{__('general.yearly_discount')}}</label>
                            <div class="input-group mb-2">
                                <div class="input-group-text">%</div>
                                <input type="text" class="form-control" value="{{$detail->yearly_discount}}" readonly
                                       disabled>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection