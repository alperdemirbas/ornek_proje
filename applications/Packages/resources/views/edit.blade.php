@extends('layouts.admin')
@section('title', trans('title.package.edit'))
@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">{{__('package.update')}}</h6>
                </div>
                <form action="{{route('packages.update',['id'=>$detail->id])}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <!-- Start : Paket Adı -->
                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('general.package_name')}}</label>
                                <input required type="text" class="form-control" placeholder="@lang('general.example'). Mega" name="package_name" value="{{$detail->name}}">
                            </div>

                            <!-- Sart : Paket Tipi -->
                            <div class="col-sm-4 my-3">
                                <label class="form-label ">{{__('package.type')}}</label>
                                <div class="dropdown bootstrap-select nice-select default-select form-control wide mh-auto">
                                    <select required class="selectpicker nice-select default-select form-control wide mh-auto" name="package_type">
                                        <option value="">{{__('general.make_a_choose',['type'=>__('package.type')])}}</option>
                                        @foreach($types as $type)
                                            <option {{ ($type == $detail->type->value) ? "selected":"" }} value="{{$type}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Sart : Satış fiyatı -->
                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('general.sale_price')}}</label>
                                <input required type="number" min="1.00" step="0.1" class="form-control" placeholder="@lang('general.example'). 1000" value="{{ $detail->fee }}" name="sale_price">
                            </div>

                            <!-- Start : 3 Aylık iskonto bedeli-->
                            <div class="col-4 my-3">
                                <label class="form-label">{{__('general.quarter_yearly_discount')}}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">%</div>
                                    <input type="number" class="form-control" min="0" max="100" name="quarter_yearly_discount" value="{{$detail->quarter_yearly_discount}}">
                                </div>
                            </div>

                            <!-- Start : 6 Aylık iskonto bedeli-->
                            <div class="col-4 my-3">
                                <label class="form-label">{{__('general.half_yearly_discount')}}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">%</div>
                                    <input required type="number" class="form-control" min="0" max="100" name="half_yearly_discount" value="{{$detail->half_yearly_discount}}">
                                </div>
                            </div>

                            <!-- Start : 12 Aylık iskonto bedeli-->
                            <div class="col-4 my-3">
                                <label class="form-label">{{__('general.yearly_discount')}}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">%</div>
                                    <input required type="number" class="form-control" min="0" max="100" value="{{$detail->yearly_discount}}" name="yearly_discount">
                                </div>
                            </div>

                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input
                                            type="checkbox"
                                            class="form-check-input"
                                            name="status"
                                            {{
                                                ($detail->is_active) ? 'checked' : ''
                                            }}
                                            />
                                        {{__('package.status')}}
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">{{__('package.btn_update')}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection