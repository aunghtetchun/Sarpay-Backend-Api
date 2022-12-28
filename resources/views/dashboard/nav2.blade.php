<div class="row navc  pb-1 mb-5" >
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-light phone-model" data-toggle="modal" data-target="#exampleModal">
            <i class="feather-phone-outgoing "></i>
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Phone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <ul class="list-group ">
                            <li class="list-group-item font-weight-bolder  d-flex justify-content-between align-items-center">
                                @foreach($phones as $p)
                                    <a href="tel:{{ $p->phone }}" class="btn col-8 bg-transparent" style="color: #000000;">
                                        {{ $p->phone }}
                                    </a>
                                    <a href="tel:{{ $p->phone }}" class="btn col-4 bg-transparent" style="color: #0051ff;">
                                        <i class="feather-phone-outgoing "></i>
                                    </a>
                                @endforeach
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-light  telegram-model" data-toggle="modal" data-target="#exampleModal1">
            <i class="fab fa-telegram " style="font-size: 22px"></i>
        </button>
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Telegram</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <ul class="list-group ">
                            <li class="list-group-item font-weight-bolder  d-flex justify-content-between align-items-center">
                                @foreach($phones as $p)
                                    <a href="tg://resolve?domain={{ $p->phone }}" class="btn col-8 bg-transparent" style="color: #000000;">
                                        {{ $p->phone }}
                                    </a>
                                    <a href="tg://resolve?domain={{ $p->phone }}" class="btn col-4 bg-transparent" style="color: #0051ff;">
                                        <i class="fab fa-telegram " style="font-size: 22px"></i>
                                    </a>
                                @endforeach
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        {{--        @foreach($phones as $p)--}}
        {{--            <a href="viber://chat?number={{ $p->phone }} " class="btn bg-transparent" style="color: #00ff00;">--}}
        {{--                <i class="fab fa-viber"></i>--}}
        {{--            </a>--}}
        {{--        @endforeach--}}
    </div>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-light viber-model" data-toggle="modal" data-target="#exampleModal2">
            <i class="fab fa-viber" style="font-size: 21px !important;"></i>
        </button>
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Viber</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <ul class="list-group ">
                            <li class="list-group-item font-weight-bolder  d-flex justify-content-between align-items-center">
                                @foreach($phones as $p)
                                    <a href="viber://chat?number={{ $p->phone }} " class="btn col-8 bg-transparent" style="color: #000000;">
                                        {{ $p->phone }}
                                    </a>
                                    <a href="viber://chat?number={{ $p->phone }} " class="btn col-4 bg-transparent" style="color: #0051ff;">
                                        <i class="fab fa-viber"></i>
                                    </a>
                                @endforeach
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        {{--        @foreach($phones as $p)--}}
        {{--            <a href="viber://chat?number={{ $p->phone }} " class="btn bg-transparent" style="color: #00ff00;">--}}
        {{--                <i class="fab fa-viber"></i>--}}
        {{--            </a>--}}
        {{--        @endforeach--}}
    </div>

    <div class="container px-0">
        <nav class="navbar col-12 pt-3 navbar-expand-lg navbar-dark bg-transparent font-weight-bold">
            <a class="navbar-brand mr-0" href="{{ route('welcome') }}">
                <img class="" src="{{ asset(\App\Custom::$info['c-logo']) }}" alt="" style="height: 50px;">

            </a>

            <div class="ml-auto d-flex align-items-center">
                <a class="" href="{{ route('model.change','en') }}">
                    <img class="" src="{{  asset('dashboard/images/en.webp') }}" alt="" style="height: 30px;">
                </a>
                <a class="mx-2" href="{{ route('model.change','mm') }}">
                    <img class="" src="{{  asset('dashboard/images/mm.webp') }}" alt="" style="height: 30px;">
                </a>
                <a class="mr-2" href="{{ route('model.change','ch') }}">
                    <img class="" src="{{  asset('dashboard/images/ch.webp') }}" alt="" style="height: 30px;">
                </a>
                <div class="dropdown">
                    <a class="btn btn-outline-light text-white bg-transparent nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('msg.city') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-1 pb-0 " aria-labelledby="navbarDropdown">
                        @foreach(\App\Category::all() as $c)
                            <a class="dropdown-item py-2" href="{{ route('model.search',$c->title) }}">{{ $c->title }}</a>
                        @endforeach
                    </div>
                </div>

            </div>

            {{--        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
            {{--            <ul class="navbar-nav mr-auto">--}}

            {{--            </ul>--}}
            {{--        </div>--}}
        </nav>
    </div>
</div>
