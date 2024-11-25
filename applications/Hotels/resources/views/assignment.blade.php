@extends('layouts.datatable')

@section('sub-content')
    <div class="row">
        <div class="col-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i>Otele Kullanıcı Ekle
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="SlideToolHeader expand"><i
                                    class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt" style="">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                                <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                    <label for="">Kullanıcı</label>
                                    <select class="form-control default-select dashboard-select-2 h-auto wide"
                                            aria-label="Default select example" tabindex="null" id="user">
                                        <option selected value="">{{__('general.all')}}</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                    <label for="">Otel</label>
                                    <select class="form-control default-select dashboard-select-2 h-auto wide"
                                            aria-label="Default select example" tabindex="null" id="hotel">
                                        <option selected value="">{{__('general.all')}}</option>
                                        @foreach($hotels as $hotel)
                                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <label for="" class="d-block w-100">&nbsp;</label>
                                <button id="btn_filter" class="btn btn-info w-100" type="button"><i
                                            class="fa fa-search me-1"></i>@lang('general.add')</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection