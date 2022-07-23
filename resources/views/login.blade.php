<?php

use Illuminate\Support\Facades\DB; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Koperasi Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('assets/img/icon.ico" type="image/x-icon') }}" />
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <style>
        .button-custom {
            background: #84C225;
            color: #FFFFFF;
            font-weight: bold;
        }

        .custom-input {
            padding: 10px;
            width: 100%;
            height: 40px;
            padding: 10px;
            border: solid 1px rgb(185, 185, 185);
            border-radius: 10px
        }
    </style>
</head>

<body style="background: #6CC4A1">
    @if (Session::get('message'))
        <p class="text-danger">{{ Session::get('message') }}</p>
    @endif

    <div class="row mt-5">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row" style="background: #ffffff;border-radius:10px">
                <div class="col-lg-6">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                </div>
                <div class="col-lg-6" style="background: #F6E3C5">
                    <div class="row " style="margin-top:100px">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <h2 class="text-center fw-bold">Selamat Datang</h2>
                            <h2 class="text-center fw-bold">Koperasi Indonesia</h2>
                            <form action="{{ asset('postLogin') }}" method="post">
                                @csrf
                                <input type="text" name="username" id="" autocomplete="off"
                                    class="custom-input mt-3" placeholder="Username">
                                <input type="password" name="password" id="" class="custom-input mt-3"
                                    placeholder="Password">
                                <button type="submit" class="btn btn-block mt-3 button-custom">Submit</button>
                                <a href="{{ asset('privacy-policy') }}" class="btn btn-primary btn-sm mt-4">Privacy
                                    Policy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

</body>

</html>
