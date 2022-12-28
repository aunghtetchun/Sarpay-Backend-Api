@extends('dashboard.app')

@section("title") See Model @endsection

@section('content')

    @component("component.breadcrumb",["data"=>[
        "Model" => "#",
    ]])
        @slot("last") See Model @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-md-11 col-lg-9">
            @component("component.card")
                @slot('icon') <i class="fa-fw feather-file text-primary"></i> @endslot
                @slot('title') Model @endslot
                @slot('button')
                    <a href="{{ route('post.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa-fw fas fa-list fa-fw"></i>
                    </a>
                    <a href="{{ route('post.edit',$post->id) }}" class="btn  btn-outline-warning btn-sm">
                        <i class="fa-fw feather-edit"></i>
                    </a>
                    <form class="d-inline-block" action="{{ route('post.destroy',$post->id) }}"  method="post">
                        @csrf
                        @method("DELETE")
                        <button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-outline-danger text-left">
                            <i class="fa-fw feather-trash-2"></i>
                        </button>
                    </form>
                @endslot
                @slot('body')
                    <div class="card-body">
                        @isset($post)
                            <div class="d-flex flex-wrap justify-content-around ">
                                <div class="col-9 col-md-10 text-center my-3">
                                    <h4 class="font-weight-bold">{{ $post->name }}</h4>
                                </div>
                                <div class="col-12 my-3">
                                    <div class="d-flex flex-wrap justify-content-center align-items-center">
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Number</b>
                                            <p>{{ $post->number }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Title</b>
                                            <p>{{ $post->title }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Name</b>
                                            <p>{{ $post->name }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Price</b>
                                            <p>{{ $post->price }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Bust</b>
                                            <p>{{ $post->bust }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Age</b>
                                            <p>{{ $post->age }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Body</b>
                                            <p>{{ $post->body }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Height</b>
                                            <p>{{ $post->height }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Weight</b>
                                            <p>{{ $post->weight }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">City</b>
                                            <p>{{ $post->getCategory->title }}</p>
                                        </div>
                                        <div class="col-6 px-0 col-md-4 col-lg-4">
                                            <b class="font-weight-bolder">Type</b>
                                            <p>
                                                @foreach(\App\PostLanguage::where('post_id',$post->id)->get('language_id') as $c)
                                                    <span class="badge px-2 badge-pill badge-primary">{{ $c->getLanguage->title }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex flex-wrap g_img">
                                <h4 class="col-12 font-weight-bolder text-center my-4">Modelplay Photo</h4>
                            @foreach($post->getPhoto as $photo)
                                    <div class="p-2 col-12 col-md-4">
                                        <a class="venobox" data-gall="myGallery" href="{{ asset("/storage/model/".$photo->url) }}">
                                            <img class="w-100 rounded" src="{{ asset("/storage/model/".$photo->url) }}" alt="" >
                                        </a>
                                    </div>
                                @endforeach

                                    <div class="col-12">
                                        <h4 class="col-12 font-weight-bolder my-4 text-center">Description</h4>
                                        {!! $post->description !!}
                                    </div>
                            </div>
                        @endisset
                    </div>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@section('foot')

@endsection
