@extends('layouts.admin')
@section('title', __('sidebar.mobil_version'))

@section('main-content')
    <div class="row">

        <!-- Start : DeadLock -->
        <div class="col-12 text-end mb-2">
            <div class="card">
                <h4 class="card-header">{{__('general.deadlock')}}</h4>
                <div class="card-body">
                    <form action="{{route('mobile.app.version.update')}}" method="POST" class="row">
                        @csrf
                        <div class="col-12 col-lg-3">
                            <select name="deadlock" class="form-control">
                                <option {{ ($deadlock=='all')?'selected':''}} value="all">All</option>
                                <option {{ ($deadlock=='android')?'selected':''}} value="android">Android</option>
                                <option {{ ($deadlock=='ios')?'selected':''}} value="ios">iOS</option>
                                <option {{ ($deadlock=='none')?'selected':''}} value="none">None</option>
                            </select>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <input class="btn btn-sm btn-success" type="submit" value="{{__('general.save')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End : DeadLock -->

        <!-- Start : Android Ayarları -->
        <div class="col-12 text-end mb-2">
            <div class="card">
                <h4 class="card-header">{{__('general.android')}}</h4>

                <div class="card-body">
                    <form action="{{route('mobile.app.version.update')}}" name="andriod" method="POST" class="row">
                        @csrf
                        <div class="col-12 col-lg-3"><input name="android['current_version']" class="form-control my-2"
                                                            type="text"
                                                            value="{{$platforms['android']['current_version']}}"
                                                            placeholder="{{__('mobile.current_version')}}"/></div>
                        <div class="col-12 col-lg-3"><input name="android['supported_version']"
                                                            class="form-control my-2" type="text"
                                                            value="{{$platforms['android']['supported_version']}}"
                                                            placeholder="{{__('mobile.supported_version')}}"/></div>
                        <div class="col-12 col-lg-3"><input name="android['store_url']" class="form-control my-2"
                                                            type="text" value="{{$platforms['android']['store_url']}}"
                                                            placeholder="{{__('mobile.store_url')}}"/></div>
                        <div class="col-12 col-lg-3"><input name="android['store_id']" class="form-control my-2"
                                                            type="text" value="{{$platforms['android']['store_id']}}"
                                                            placeholder="{{__('mobile.store_id')}}"/></div>
                        <div class="col-12 text-end mt-3">
                            <input class="btn btn-sm btn-success" type="submit" value="{{__('general.save')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End : Android Ayarları -->

        <!-- Start : iOS Ayarları -->
        <div class="col-12 text-end mb-2">
            <div class="card">
                <h4 class="card-header">{{__('general.ios')}}</h4>

                <div class="card-body">
                    <form action="{{route('mobile.app.version.update')}}" method="POST" class="row">
                        @csrf
                        <div class="col-12 col-lg-3"><input name="ios['current_version']" class="form-control my-2"
                                                            type="text" value="{{$platforms['ios']['current_version']}}"
                                                            placeholder="{{__('mobile.current_version')}}"/></div>
                        <div class="col-12 col-lg-3"><input name="ios['supported_version']" class="form-control my-2"
                                                            type="text"
                                                            value="{{$platforms['ios']['supported_version']}}"
                                                            placeholder="{{__('mobile.supported_version')}}"/></div>
                        <div class="col-12 col-lg-3"><input name="ios['store_url']" class="form-control my-2"
                                                            type="text" value="{{$platforms['ios']['store_url']}}"
                                                            placeholder="{{__('mobile.store_url')}}"/></div>
                        <div class="col-12 col-lg-3"><input name="ios['store_id']" class="form-control my-2" type="text"
                                                            value="{{$platforms['ios']['store_id']}}"
                                                            placeholder="{{__('mobile.store_id')}}"/></div>
                        <div class="col-12 text-end mt-3">
                            <input class="btn btn-sm btn-success" type="submit" value="{{__('general.save')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End : iOS Ayarları -->
    </div>
@endsection
