<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{ asset(\App\Custom::$info['c-logo']) }}">
    <link rel="stylesheet" href="{{ asset(\App\Custom::$info['main_css']) }}">
    <link rel="stylesheet" href="{{asset('dashboard/vendor/feather-icons-web/feather.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/model.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendor/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendor/animate_it/animate.css')}}">


    @yield('head')
</head>
<body >

<div id="app" class="container-fluid pb-4 " style="background: rgb(0,0,0); height: 1000px" >
    @include('dashboard.nav2')
    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
{{--        <div class="row py-5 mt-4 justify-content-between align-items-baseline">--}}
{{--            <div class="col-12 col-md-5 px-0">--}}
{{--                <div class="card fcard">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="col-12 col-md-6">--}}
{{--                            <p>--}}
{{--                                <b-icon icon="arrow-right" aria-hidden="true"></b-icon> {{ __('msg.office_hours') }} </br>--}}
{{--                                &nbsp &nbsp &nbsp  {{ __('msg.office_hours_data') }}--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <b-icon icon="arrow-right" aria-hidden="true"></b-icon> {{ __('msg.phone') }} </br>--}}
{{--                                &nbsp &nbsp &nbsp  {{ __('msg.phone_data') }}--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <b-icon icon="arrow-right" aria-hidden="true"></b-icon> {{ __('msg.special_offer') }} </br>--}}
{{--                                &nbsp &nbsp &nbsp  {{ __('msg.special_offer_data') }}--}}
{{--                            </p>--}}

{{--                        </div>--}}
{{--                        <div class="col-12 col-md-6">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-md-5 px-0 my-3 ">--}}
{{--                <div class="card fcard">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="col-12 col-md-8">--}}
{{--                            <p>--}}
{{--                                <b-icon icon="arrow-right" aria-hidden="true"></b-icon> {{ __('msg.office') }}  </br>--}}
{{--                                &nbsp &nbsp &nbsp {{ __('msg.office_data') }}--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <b-icon icon="arrow-right" aria-hidden="true"></b-icon> {{ __('msg.email') }} </br>--}}
{{--                                &nbsp &nbsp &nbsp {{ __('msg.email_data') }}--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <b-icon icon="arrow-right" aria-hidden="true"></b-icon> {{ __('msg.vip') }} </br>--}}
{{--                                &nbsp &nbsp &nbsp {{ __('msg.vip_data') }}--}}
{{--                            </p>--}}

{{--                        </div>--}}
{{--                        <div class="col-12 col-md-4">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>

</div>


<!-- Scripts -->
<script src="{{ asset('dashboard/js/jquery.js') }}"></script>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{ asset('dashboard/js/bootstrap.js') }}"></script>
<script src="{{ asset('dashboard/js/slick.js') }}"></script>
<script src="{{ asset('dashboard/js/app.js') }}"></script>

@yield('foot')

</body>
</html>
