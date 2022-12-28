@extends('dashboard.app')

@section('title')
    Sarpay
@endsection

@section('content')

    @component('component.breadcrumb',
        [
            'data' => [
                'Author' => route('author.index'),
            ],
        ])
        @slot('last')
            Add Author
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 col-xl-6">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Add Author
                @endslot
                @slot('button')
                    <a href="{{ route('author.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list fa-fw"></i>
                    </a>
                @endslot
                @slot('body')
                    <div>
                        <form action="{{ route('author.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="email" value="{{ old('email') }}" placeholder="Email">
                                @error('email')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" name="password"
                                    id="password" value="{{ old('password') }}" placeholder="Password">
                                @error('password')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" value="{{ old('name') }}" placeholder="Name">
                                @error('name')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" name="author"
                                    id="author" value="{{ old('author') }}" placeholder="Author Name">
                                @error('author')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="photo">
                                    <i class="mr-1 feather-image"></i>
                                    Select Photo
                                </label>
                                <input type="file" id="photo" onchange="previewFile(this);" name="photo"
                                    class="form-control p-1 mr-2 overflow-hidden @error('photo') is-invalid @enderror">
                                @error('photo')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                                <a id="edit" onclick="$('#photo').trigger('click');"
                                    class="btn d-none text-white btn-primary btn-sm" style="position:absolute; right: 22px;">
                                    <i class="fas fa-edit "></i>
                                </a>
                                <img id="previewImg" onclick="$('#photo').trigger('click');" class="w-100 d-none rounded"
                                    src="" alt="your image" />
                            </div>
                            <div class="form-group">
                                <label for="card">Id Card</label>
                                <input type="text" class="form-control @error('card') is-invalid @enderror" name="card"
                                    id="card" value="{{ old('card') }}" placeholder="Id Card">
                                @error('card')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    id="phone" value="{{ old('phone') }}" placeholder="Phone">
                                @error('phone')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary "><i class="fas fa-plus-square mr-1"></i> Add
                                Author</button>
                        </form>
                    </div>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@section('foot')
    <script>
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                    $("#previewImg").removeClass("d-none");
                    $("#photo").hide();
                    $("#edit").removeClass("d-none");

                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
