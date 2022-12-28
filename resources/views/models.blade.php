
@extends('dashboard.app2')
@section("title") Home @endsection

@section('content')
        @foreach($posts as $post)
            <div  class="col-4 col-sm-4 col-md-3 col-lg-2 d-flex pl-0 pl-lg-1 pl-sm-0 pr-0 pr-lg-1 pr-sm-0" onclick="window.location='{{ url("model/$post->id") }}'">
                <div class="card mt-1 mt-lg-0 mt-sm-1 w-100" style="background-color:#ffdf00">

                    <div class="model" style="background-image: url('{{ asset("/storage/model/".$post->getPhoto[0]->url) }}')">
                        <span class="badge badge-pill mt-1 ml-1 badge-secondary">
                            <i class="fas fa-eye text-white"></i> &nbsp
                            {{ \App\Viewer::where('post_id',$post->id)->count() }}
                        </span>
                    </div>
                    <div class="d-flex rounded-top  postcb text-white text-center justify-content-center align-items-center">
                        <p class="m-0 header red py-1 font-weight-light">{{ $post->title }}</p>
                    </div>
                    <div class="info p-1 font-weight-bold" style="display:block;background-color:rgb(207, 133, 0);">
                            <p class="m-0 text-white">
                               {{ $post->age }} / {{$post->height}} / {{ $post->weight}} / {{ $post->bust}}
                        </p>


                        <p  class="m-0 text-white">GIFT : {{$post->price}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12 d-flex justify-content-center mt-5 pt-3 pagination-lg">
            {!! $posts->links() !!}
        </div>
@endsection
