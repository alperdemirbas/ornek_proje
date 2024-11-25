<!DOCTYPE html>
<html lang="tr" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} - @yield('title', '')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/png" href="#">
    @stack('library.css')
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body class="vh-100">
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    @yield('content')
</body>
<script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/js/dlabnav-init.js') }}"></script>

<script src="{{ asset('assets/js/dashboard/cms.js') }}" ></script>

<!-- Start : Extent Javascript -->
<script src="{{ asset('assets/js/smooth.scroll.js') }}"></script>


<script>
    const csrf =  $('meta[name="csrf-token"]').attr('content');
</script>
@stack('library.js')
@stack('scripts')
</html>