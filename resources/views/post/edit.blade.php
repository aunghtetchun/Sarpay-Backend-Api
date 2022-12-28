@extends('dashboard.app')

@section("title") Edit Model @endsection

@section('content')

    @component("component.breadcrumb",["data"=>[
        "Model" => route("post.index"),
    ]])
        @slot("last") Edit Model @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 col-xl-10">
            @component("component.card")
                @slot('icon') <i class="feather-file text-primary"></i> @endslot
                @slot('title') Edit Model @endslot
                @slot('button')
                    <a href="{{ route('post.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list fa-fw"></i>
                    </a>
                @endslot
                @slot('body')
                    <div>
                        <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row justify-content-between ">
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input required type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{$post->title}}" placeholder="Title">
                                        @error('title')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Model Name</label>
                                        <input required type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$post->name}}" placeholder="Model Name">
                                        @error('name')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="number">Number</label>
                                        <input required type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="number" value="{{$post->number}}" placeholder="Number">
                                        @error('number')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input required type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{$post->price}}" placeholder="Price">
                                        @error('price')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input required type="text" class="form-control @error('age') is-invalid @enderror" name="age" id="age" value="{{$post->age}}" placeholder="Age">
                                        @error('age')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Body Type</label>
                                        <input required type="text" class="form-control @error('body') is-invalid @enderror" name="body" id="body" value="{{$post->body}}" placeholder="Body Type">
                                        @error('body')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="height">Height</label>
                                        <input type="text" required class="form-control @error('height') is-invalid @enderror" name="height" id="height" value="{{$post->height}}" placeholder="Height">
                                        @error('height')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="text" required class="form-control @error('weight') is-invalid @enderror" name="weight" id="weight" value="{{$post->weight}}" placeholder="Weight">
                                        @error('weight')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="bust">Bust</label>
                                        <input type="text" required class="form-control @error('bust') is-invalid @enderror" name="bust" id="bust" value="{{$post->bust}}" placeholder="Bust">
                                        @error('bust')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>


                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="video">Video</label>
                                        <input type="file" accept="video/*" class="form-control @error('video') is-invalid @enderror" name="video" id="video" value="{{$post->video}}" placeholder="Video">
                                        @error('video')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <video class="w-100" style="height: 300px" controls>
                                            <source src="{{ asset("/storage/".$post->video) }}" type="video/mp4">
                                        </video>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select name="city" id="city" class="form-control select2">
                                            <option selected disabled>Select City</option>
                                            @foreach(\App\Category::latest()->get() as $c)
                                                <option value="{{$c->id}}" {{ $post->category_id == $c->id ? "selected":"" }} >{{$c->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="languages">Select Language
                                            @foreach(\App\PostLanguage::where('post_id',$post->id)->get('language_id') as $c)
                                                <span class="badge px-2 badge-pill badge-primary" >{{ $c->getLanguage->title }}</span>
                                            @endforeach
                                        </label>
                                        <select name="languages[]" id="languages" class="form-control select2" multiple="multiple">
                                            @foreach(\App\Language::latest()->get() as $c)
                                                <option value="{{ $c->id }}"  >{{ $c->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('languages')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea rows="12" required class="form-control @error('description') is-invalid @enderror" name="description"  id="description">{{$post->description}}</textarea>
                                        @error('description')
                                        <small class="invalid-feedback font-weight-bold" role="alert">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary " ><i class="fas fa-plus-square mr-1"></i> Update Model</button>
                        </form>
                    </div>
                @endslot
            @endcomponent
        </div>
        <div class="col-12 col-md-6">
            @component("component.card")
                @slot('icon') <i class="feather-file text-primary"></i> @endslot
                @slot('title') Models Photo @endslot
                @slot('button')

                @endslot
                @slot('body')
                    <form action="{{ route('photo.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                        <div class="form-group input-field">
                            <div class="input-images-1" style="padding-top: .5rem;"></div>
                            @error('images')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary " ><i class="fas fa-plus-square mr-1"></i>Upload Photos</button>

                    </form>
                    <div class="d-flex mt-3" style="overflow-x: scroll;" >
                        @foreach($post->getPhoto as $photo)
                            <div class="mr-2" >
                                <img src="{{ asset("/storage/model/".$photo->url) }}" alt="" style="width: 150px;">
                                <form action="{{ route('photo.destroy',$photo->id) }}"  method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button onClick="return confirm('Are you sure you want to delete?')" class="btn  btn-sm btn-danger text-left" style="margin-top: -80px; margin-left: 8px; z-index: 3000;">
                                        <i class="feather-trash-2"></i>
                                    </button>
                                </form>
                            </div>

                        @endforeach
                    </div>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@section('foot')
    <script>
        $('#description').summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true
        });
    </script>
@endsection
