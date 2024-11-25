<!DOCTYPE html>
<html lang="tr" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Müşteri Login Ekranı</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
</head>
<body class="vh-100">
<div class="page-wrapper">
    <div class="browse-job login-style3">
        <div class="bg-img-fix overflow-hidden"
             style="background-image:url({{ asset('assets/images/background.jpg') }});background-attachment: fixed;background-size: 100%;background-position: center; height: 100vh;">
            <div class="row gx-0">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 vh-100" style="background-color:rgba(255,255,255,0.8)">
                    <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside"
                         style="max-height: 653px;" tabindex="0">
                        <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;"
                             dir="ltr">
                            <div class="login-form style-2">
                                <div class="card-body">
                                    <div class="logo-header text-center">
                                        <img src="{{ asset('assets/images/rezyon.svg')}}" alt="Rezyon" title="Rezyon"
                                             style="height:100px;">
                                    </div>
                                    <nav>
                                        @if ($errors->has('email'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                        <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
                                            <div class="tab-content w-100" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-personal" role="tabpanel"
                                                     aria-labelledby="nav-personal-tab">
                                                    <form action="{{ route('admin.auth.login') }}" method="POST">
                                                        @csrf
                                                        <h3 class="form-title m-t0">Title</h3>
                                                        <div class="dez-separator-outer m-b5">
                                                            <div class="dez-separator bg-primary style-liner"></div>
                                                        </div>
                                                        <p>Sub Title</p>
                                                        <div class="form-group mb-3">
                                                            <input name="email" required class="form-control"
                                                                   placeholder="{{__('general.email')}}"
                                                                   value='{{ old('email') }}'
                                                                   type="text">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <input name="password" required class="form-control "
                                                                   placeholder="{{__('general.password')}}"
                                                                   type="password">
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-sm btn-primary w-100 me-3">Giris Yap</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>