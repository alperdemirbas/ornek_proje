@extends('layouts.admin')
@section('main-content')

    <div class="row">
        <!-- Start : Kullanıcı Detayı -->
        <div class="col-xl-12 col-lg-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title text-primary"><i class="fa-solid fa-circle-info me-2"></i>{{__('user.details')}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 col-12 mb-3">
                            <label class="form-label">{{__('general.firstname')}}</label>
                            <input type="text" class="form-control" value="{{$data->firstname}}" disabled="" readonly>
                        </div>
                        <div class="col-sm-3 col-12 mb-3">
                            <label class="form-label">{{__('general.lastname')}}</label>
                            <input type="text" class="form-control" value="{{$data->lastname}}" disabled="" readonly>
                        </div>
                        <div class="col-sm-3 col-12 mb-3">
                            <label class="form-label">{{__('general.email')}}</label>
                            <input type="text" class="form-control" value="{{$data->email}}" disabled="" readonly>
                        </div>
                        <div class="col-sm-3 col-12 mb-3">
                            <label class="form-label">{{__('user.type')}}</label>
                            <input type="text" class="form-control" value="{{$data->type}}" disabled="" readonly>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End : Kullanıcı Detayı -->

        @foreach($permissions as $index=>$value)
            <!-- Start : Yetkileri -->
            <div class="col-12">
                <div class="card card-bx m-b30">
                    <div class="card-header bg-primary">
                        <h6 class="title text-white"><i class="fa-solid fa-gears me-1"></i>{{__('permission.'.$index)}}
                        </h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($value as $per)
                                @foreach($per as $permission)

                                    <div class="col mb-3">
                                        <div class="form-check text-nowrap">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="{{$permission}}">
                                            <label class="form-check-label" for="{{$permission}}">
                                                {{__('permission.'.$permission)}}
                                            </label>
                                        </div>
                                    </div>

                                @endforeach
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
        <!-- End : Yetkileri -->


        <!-- Start : Geçmişi -->
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h6 class="title text-white"><i class="fa-solid fa-clock-rotate-left me-2"></i>{{__('user.history')}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <label class="form-label">Bu kullanıcının yaptığı tüm aktivitelerin logları tutulacak.</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End : Geçmişi -->

    </div>

@endsection