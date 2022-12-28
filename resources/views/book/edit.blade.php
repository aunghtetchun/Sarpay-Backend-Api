@extends('dashboard.app')

@section('title')
    Sarpay
@endsection

@section('content')

    @component('component.breadcrumb',
        [
            'data' => [
                'Book' => route('book.index'),
            ],
        ])
        @slot('last')
            Edit Book
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 col-xl-6">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Edit Book
                @endslot
                @slot('button')
                    {{--                    <a href="{{ route('book.index') }}" class="btn btn-sm btn-outline-primary">--}}
                    {{--                        <i class="fas fa-list fa-fw"></i>--}}
                    {{--                    </a>--}}
                @endslot
                @slot('body')
                    <div>
                        <form action="{{ route('admin.bupdate', $book->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="group_id">Group</label>
                                <select name="group_id" id="group_id" class="form-control select2">
                                    <option selected disabled>Select Group</option>
                                    @foreach(\App\Group::latest()->get() as $c)
                                        <option value="{{ $c->id }}" {{ $book->group_id == $c->id ? "selected":"" }} >{{ $c->title }}</option>
                                    @endforeach
                                </select>
                                @error('group_id')
                                <small class="invalid-feedback font-weight-bold" role="alert">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">နာမည်</label>
                                <input disabled type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" id="name" value="{{ $book->name }}" placeholder="နာမည်">
                            </div>
                            <div class="form-group">
                                <label for="author">ကလောင်နာမည်</label>
                                <input disabled type="text" class="form-control @error('author') is-invalid @enderror"
                                       name="author" id="author" value="{{ $book->author }}" placeholder="ကလောင်နာမည်">
                            </div>

                            <div class="form-group">
                                <label for="title">စာအုပ်ခေါင်းစဥ်</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                       id="title" value="{{ $book->title }}"
                                       placeholder="စာအုပ်ခေါင်းစဥ်">
                                @error('title')
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
                                       class="form-control d-none p-1 mr-2 overflow-hidden @error('cover') is-invalid @enderror">
                                @error('cover')
                                <small class="invalid-feedback font-weight-bold" role="alert">
                                    {{ $message }}
                                </small>
                                @enderror
                                <a id="edit" onclick="$('#cover').trigger('click');" class="btn text-white btn-primary btn-sm"
                                   style="position:absolute; right: 22px;">
                                    <i class="fas fa-edit "></i>
                                </a>
                                <img id="previewImg" onclick="$('#cover').trigger('click');" class="w-100 rounded"
                                     src="{{ asset('storage/book/cover/' . $book->cover) }}"
                                     alt="your image" />
                            </div>
                            {{-- last --}}
                            <div class="form-group">
                                <label for="type">အမျိုးအစား</label>
                                <select  class="custom-select" name="type" id="type">
                                    <option disabled>စာအုပ်အမျိုးအစားရွေးပါ</option>
                                    <option value="one" @if ($book->type == 'one') selected @endif>လုံးချင်း</option>
                                    <option value="all" @if ($book->type == 'all') selected @endif>အခန်းဆက်</option>
                                </select>
                                @error('type')
                                <small class="invalid-feedback font-weight-bold" role="alert">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="chapter">အခန်းအရေအတွက်</label>
                                <input type="text" class="form-control @error('chapter') is-invalid @enderror" name="chapter"
                                       id="chapter" value="{{ $book->chapter }}"
                                       placeholder="အခန်းအရေအတွက်">
                                @error('chapter')
                                <small class="invalid-feedback font-weight-bold" role="alert">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label for="price">စျေးနှုန်း</label>-->
                            <!--    <input  type="number" class="form-control @error('price')  is-invalid @enderror"-->
                            <!--        name="price" id="price" value="{{ $book->price }}"-->
                            <!--        placeholder="စျေးနှုန်း">-->
                            <!--    @error('price')-->
                            <!--        <small class="invalid-feedback font-weight-bold" role="alert">-->
                            <!--            {{ $message }}-->
                            <!--        </small>-->
                            <!--    @enderror-->
                            <!--</div>-->


                            <button type="submit" class="btn btn-primary "><i class="fas fa-plus-square mr-1"></i> Update
                                Book</button>
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
                    $("#cover").hide();
                    $("#edit").removeClass("d-none");

                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
