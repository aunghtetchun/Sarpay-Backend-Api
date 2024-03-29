@extends('dashboard.author')

@section('title')
    Sarpay
@endsection

@section('content')

    @component('component.breadcrumb',
        [
            'data' => [
                'Book' => route('book-insert', $title),
            ],
        ])
        @slot('last')
            Add Category
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 col-xl-6">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Add Category
                @endslot
                @slot('button')
                    <a href="{{ route('book-insert', $title) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list fa-fw"></i>
                    </a>
                @endslot
                @slot('body')
                    <div>
                        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">နာမည်</label>
                                <input disabled type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ auth()->user()->name }}" placeholder="နာမည်">
                            </div>
                            <div class="form-group">
                                <label for="author">ကလောင်နာမည်</label>
                                <input disabled type="text" class="form-control @error('author') is-invalid @enderror"
                                    name="author" id="author" value="{{ auth()->user()->author }}" placeholder="ကလောင်နာမည်">
                            </div>

                            <div class="form-group">
                                <label for="main_title">စာအုပ်ခေါင်းစဥ်</label>
                                <input type="hidden" name="main_title" value="{{ $title }}">
                                <input type="text" disabled class="form-control @error('main_title') is-invalid @enderror"
                                    value="{{ $title }}" placeholder="စာအုပ်ခေါင်းစဥ်">
                                @error('main_title')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">စာအုပ်ခွဲခေါင်းစဥ်</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                    id="title" value="{{ old('title') }}" placeholder="စာအုပ်ခွဲခေါင်းစဥ်">
                                @error('title')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="type">အခြေအနေ</label>
                                <select  class="custom-select" name="type" id="type">
                                    <option value="done" >Done</option>
                                    <option value="release" >Release</option>
                                </select>
                                @error('type')
                                <small class="invalid-feedback font-weight-bold" role="alert">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="cover">
                                    <i class="mr-1 feather-image"></i>
                                    ကာဗာဓာတ်ပုံ
                                </label>
                                <input type="file" id="cover" onchange="previewFile(this);" name="cover"
                                    class="form-control p-1 mr-2 overflow-hidden @error('cover') is-invalid @enderror">
                                @error('cover')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                                <a id="edit" onclick="$('#cover').trigger('click');"
                                    class="btn d-none text-white btn-primary btn-sm" style="position:absolute; right: 22px;">
                                    <i class="fas fa-edit "></i>
                                </a>
                                <img id="previewImg" onclick="$('#cover').trigger('click');" class="w-100 d-none rounded"
                                    src="" alt="your image" />
                            </div>
                            <div class="form-group">
                                <label for="chapter">အခန်းအရေအတွက်</label>
                                <input type="text" class="form-control @error('chapter') is-invalid @enderror" name="chapter"
                                    id="chapter" value="{{ old('chapter') }}" placeholder="အခန်းအရေအတွက်">
                                @error('chapter')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">စျေးနှုန်း</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                    id="price" value="{{ old('price') }}" placeholder="စျေးနှုန်း">
                                @error('price')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary "><i class="fas fa-plus-square mr-1"></i> Add
                                Category</button>
                        </form>
                    </div>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@section('foot')
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: 140, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true
            });
        });
    </script>
    <script>
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                    $("#previewImg").removeClass("d-none");
                    $("#cover").hide();
                    $("#edit").removeClass("d-none");
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
