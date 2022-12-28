
@extends('dashboard.app2')
@section("title") Details @endsection
@section('head')
    <style>
        #app{
            background: white !important;
        }
        .dropdown{
            background: black !important;
        }
    </style>
@endsection
@section('content')
    <div class="col-12 px-0 d-flex flex-wrap justify-content-between mb-5">
        <div class="col-12 col-lg-5 col-md-6 my-3">
            <div class="slider-for">
                <div>
                    <img class="rounded-0 w-100 " src="{{ asset("/storage/model/".$post->getPhoto[0]->url) }}" alt="Card image cap">
                </div>
                <div>
                    <video class="w-100" controls>
                        <source src="{{ asset("/storage/".$post->video) }}" type="video/mp4">
                    </video>
                </div>
                @foreach($post->getPhoto as $p)
                <div>
                    <img class="rounded-0 w-100 " src="{{ asset("/storage/model/".$p->url) }}" alt="Card image cap">
                </div>
                @endforeach
            </div>
            <div class="slider-nav ">
                <div style="height: 125px; background-image: url('{{ asset("/storage/model/".$post->getPhoto[0]->url) }}'); background-size: cover; background-position: center">
{{--                    <img class="rounded-0 w-100 pl-1 controlimg "  src="" alt="Card image cap">--}}
                </div>
                <div>
                    <video class="w-100" style="height: 127px;">
                        <source src="{{ asset("/storage/".$post->video) }}" type="video/mp4">
                    </video>
                </div>

                @foreach($post->getPhoto as $key=>$p)
                    @if($key>0)
                <div style="height: 125px;  background-image: url('{{ asset("/storage/thumbnail/".$p->url) }}'); background-size: cover;background-position: center " >
{{--                    <img class="rounded-0 w-100 pl-1 controlimg " src="" alt="Card image cap">--}}
                </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 my-3">
            <div class="card dcard ">
                <div class="card-body p-0">
                    <div class="d-flex p-3  navc flex-wrap justify-content-around align-items-center mb-3">
                        <div>
                            {{ $post ->title }}
                        </div>
                        <div class="p-0">
                            <div class="btn-group btn-group-toggle mr-2" data-toggle="buttons">
                                <label class="btn btn-sm btn-danger active">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> ID
                                </label>
                                <label class="btn btn-light btn-sm font-weight-bolder ">
                                    <input type="radio" name="options" id="option3" autocomplete="off"> {{ $post->number }}
                                </label>
                            </div>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-sm btn-danger active">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> <i class="fas fa-eye text-white"></i>
                                </label>
                                <label class="btn btn-light btn-sm font-weight-bold">
                                    <input type="radio" name="options" id="option3" autocomplete="off"> {{ \App\Viewer::where('post_id',$post->id)->count() }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <p class="px-5 py-3">
                       {{ $post->description }}
                    </p>
                </div>
            </div>
            <div class="card dcard">
                <div class="card-body d-flex flex-wrap p-0  pb-3">
                    <p class="col-12 p-3 pl-5 navc">
                        {{ __('msg.details') }}
                    </p>
                    <div class="col-6 pl-5 ">
                        <p>
                            {{ __('msg.age') }} :
                        </p>
                        <p>
                            {{ __('msg.body_type') }} :
                        </p>
                        <p>
                            {{ __('msg.height') }} :
                        </p>
                        <p>
                            {{ __('msg.weight') }} :
                        </p>
                        <p>
                            {{ __('msg.bust') }} :
                        </p>
                        <p>
                            {{ __('msg.city_d') }} :

                        </p>
                        <p>
                            {{ __('msg.languages') }} :
                        </p>
                    </div>
                    <div class="col-6 pl-5">
                        <p>
                             {{ $post->age }}
                        </p>
                        <p>
                          {{ $post->body }}
                        </p>
                        <p>
                             {{$post->height }}
                        </p>
                        <p>
                            {{ $post->weight }}
                        </p>
                        <p>
                            {{ $post->bust }}
                        </p>
                        <p>
                            {{ $post->getCategory->title }}
                        </p>

                        <p>
                            @foreach($post->languages as $language)
                            {{ $language->title }} </br>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
{{--            @isset($phones)--}}

{{--            <div class="card dcard ">--}}
{{--                <div class="card-body row ">--}}
{{--                        @foreach($phones as $p)--}}
{{--                            <a href="tel:{{ $p->phone }}" class="btn bg-transparent" style="color: #00ff00;">--}}
{{--                                <i class="feather-phone-outgoing "></i>--}}
{{--                            </a>--}}
{{--                        @endforeach--}}
{{--                        @foreach($phones as $p)--}}
{{--                        <a href="tg://resolve?domain={{ $p->phone }}" class="btn bg-transparent" style="color: #00ff00;">--}}
{{--                            <i class="fab fa-telegram " style="font-size: 22px"></i>--}}
{{--                        </a>--}}
{{--                        @endforeach--}}
{{--                        @foreach($phones as $p)--}}
{{--                        <a href="viber://chat?number={{ $p->phone }} " class="btn bg-transparent" style="color: #00ff00;">--}}
{{--                            <i class="fab fa-viber"></i>--}}
{{--                        </a>--}}
{{--                        @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endisset--}}


        </div>
    </div>
@endsection
@section('foot')
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 2,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: true,
            focusOnSelect: true
        });
    </script>
@endsection
