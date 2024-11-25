@extends('layouts.admin')
@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">{{__('company.official_edit')}}</h6>
                </div>
                <form action="{{route('applications.companies.official.update',['id'=>$detail->id])}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <!-- Start : Yetkili Adı -->
                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('company.official_first_name')}}</label>
                                <input required type="text" class="form-control" name="first_name"
                                       value="{{$detail->first_name}}" tabindex="1">
                            </div>

                            <!-- Sart : Yetkili Soyadı -->
                            <div class="col-sm-4 my-3">
                                <label class="form-label">{{__('company.official_last_name')}}</label>
                                <input required type="text" class="form-control" value="{{$detail->last_name}}"
                                       name="last_name" tabindex="2">
                            </div>

                            <!-- Start : Yetkili E-posta -->
                            <div class="col-4 my-3">
                                <label class="form-label">{{__('company.official_email')}}</label>
                                <input required type="email" class="form-control" name="email" value="{{$detail->email}}" tabindex="3">
                            </div>

                            <!-- Start : Yetkili Ünvan -->
                            <div class="col-4 my-3">
                                <label class="form-label">{{__('company.official_title')}}</label>
                                <input required type="text" class="form-control" name="title"
                                       value="{{$detail->title}}" tabindex="4">
                            </div>

                            <!-- Start : Yetkili Telefon -->
                            @include('components/country_code_list')

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