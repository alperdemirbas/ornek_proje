@extends('layouts.core')
@push('library.css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper@9/swiper-bundle.min.css') }}">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/user/user.css') }}">
@endpush
@section('content')
    <div id="main-wrapper">
        @include('sections.user.header')
        @include('sections.user.menu')
        <div class="content-body">
            <div class="container-fluid">
                @yield('main-content')
            </div>
        </div>
    </div>

    @foreach($modals as $modal)
        @if($modal['type'] == 'slideup')
            <div class="slideup-modal" id="{{ $modal['targetId'] }}">
                <div class="slideup-content">
                    <div class="slideup-header">
                        <div class="d-flex justify-content-between">
                            <span></span>
                            <h3 class="slideup-title">{{ $modal['title'] }}</h3>
                            <a href="javascript:void(0)" class="close-slideup"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                    </div>
                    <div class="slideup-body">
                        @include($modal['contentView'])
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade" id="{{ $modal['targetId'] }}" tabindex="-1" aria-labelledby="{{ $modal['targetId'] }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="close-modal">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            @include($modal['contentView'])
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
@push('library.js')
    <script src="{{ asset('assets/vendor/swiper@9/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/js/user/user.js') }}"></script>
@endpush