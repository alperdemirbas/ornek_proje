@extends('layouts.admin')
@section('title', trans('title.package.create'))

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">{{__('general.package_create')}}</h6>
                </div>
                <form action="{{route('packages.view.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('general.package_name')}}</label>
                                <input required type="text" class="form-control" placeholder="Örnek : Mega Paket" name="package_name">
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label ">{{__('package.type')}}</label>
                                <div class="dropdown bootstrap-select nice-select default-select form-control wide mh-auto">
                                    <select required class="selectpicker nice-select default-select form-control wide mh-auto" name="package_type">
                                        <option value="">{{__('general.make_a_choose',['type'=>__('package.type')])}}</option>
                                        @foreach($packageType as $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('general.sale_price')}}</label>
                                <input required type="number" min="1.00" step="0.1" class="form-control" placeholder="Örnek : ₺1000" value="1.00" name="sale_price">
                            </div>

                            <div class="col-4 my-3">
                                <label class="form-label">{{__('general.quarter_yearly_discount')}}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">%</div>
                                    <input type="number" class="form-control" min="0" max="100" value="0" name="quarter_yearly_discount">
                                </div>
                            </div>

                            <div class="col-4 my-3">
                                <label class="form-label">{{__('general.half_yearly_discount')}}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">%</div>
                                    <input required type="number" class="form-control" min="0" max="100" value="0" name="half_yearly_discount">
                                </div>
                            </div>
                            <div class="col-4 my-3">
                                <label class="form-label">{{__('general.yearly_discount')}}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">%</div>
                                    <input required type="number" class="form-control" min="0" max="100" value="0" name="yearly_discount">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">{{__('general.package_create')}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection