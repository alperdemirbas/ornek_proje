@extends('layouts.core')

@section('content')
    <div id="main-wrapper">
        @include('sections.header')
        @include('sections.sidebar')
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="@yield('MainPageUrl', '#')">@yield('MainPage','Home')</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">@yield('SubPage','Dashboard')</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    <script>
                                        const error = "{{ $errors->all()[0] }}";
                                        const element = error.split(' ')[0];
                                        console.log(element);
                                            setTimeout(()=>{
                                                $("[smooth-name='"+element+"']").smooth();
                                            },3000);
                                    </script>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                @yield("main-content")
            </div>
        </div>
    </div>
    @if(isset($modals))
        @foreach($modals as $modal)
            <div class="modal fade bd-example-modal-lg" id="{{ $modal['targetId'] }}" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    @if(isset($modal['form']))
                        <form
                                @if(isset($modal['form']['id'])) id="{{ $modal['form']['id'] }}" @endif
                                @if(isset($modal['form']['method'])) method="{{ $modal['form']['method'] }}" @endif
                                @if(isset($modal['form']['action'])) action="{{ $modal['form']['action'] }}" @endif
                                @if(isset($modal['form']['media'])) enctype="multipart/form-data" @endif
                        >
                            @csrf
                    @endif
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $modal['title'] }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        <div class="modal-body">
                            @include($modal['contentView'])
                        </div>
                        @if(isset($modal['footerView']))
                            <div class="modal-footer">
                                @include($modal['footerView'])
                            </div>
                        @endif
                    @if(isset($modal['isForm']))
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    @endif
@endsection
@push('library.js')
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        const lang = '{{ app()->getLocale() }}';
        const toast = function( { type,message,title}){
            toastr[type](
                message,
                title, {
                    timeOut: 5000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
        }
    </script>
@endpush
@push('library.css')
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/css/select2.min.css')}}">
@endpush

@push('scripts')

    <script>
        $("[name='birthdate']").bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            time: false,
        });
    </script>

    <script>
        $(".select2").select2();
        function dateTimeInit() {
            $('.default-select').selectpicker();

            $('.date-picker').bootstrapMaterialDatePicker({
                format: 'DD-MM-YYYY HH:mm'
            });

            $('.time-picker').bootstrapMaterialDatePicker({
                format: 'HH:mm',
                time: true,
                date: false
            });

            $('.input-daterange-timepicker').daterangepicker({
                timePicker: true,
                format: 'MM-DD-YYYY h:mm',
                timePicker24Hour: true,
                timePickerSeconds: false,
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
            });
        }

        dateTimeInit();

        @if(session('status') === 'success')
            _Swal({
                icon: 'success',
                text: '{{ session('message') }}',
                confirmButtonText:' @lang('general.ok')'
            });
        @elseif(session('status') === 'error')
            _Swal({
                icon: 'error',
                text: '{{ session('message') }}',
                confirmButtonText: '@lang('general.ok')'
            });
        @endif
    </script>
@endpush