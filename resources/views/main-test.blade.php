@extends('applications.payment.management::layouts.core')

@section('content')
    <section class="content-inner bg-white position-relative" style="height: 100vh!important;">
        <div class="col-12">
            <a href="" class="btn btn-sm btn-outline-primary"><i
                        class="fa fa-plus"></i> Demo talep et
            </a>
            <a href="{{ route('admin.view.auth.login') }}" class="btn btn-sm btn-outline-primary"><i
                        class="fa fa-plus"></i> Yonetim Giris Yap
            </a>
        </div>
    </section>

@endsection