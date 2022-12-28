@extends('dashboard.author')

@section('title')
    Sarpay
@endsection

@section('content')

    @component('component.breadcrumb',
        [
            'data' => [
                'Chapter' => '',
            ],
        ])
        @slot('last')
            Add Chapter
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 col-xl-6">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Add Chapter
                @endslot
                @slot('button')
                    {{-- <a href="{{ route('chapter.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list fa-fw"></i>
                    </a> --}}
                @endslot
                @slot('body')
                    <div>
                        <form action="{{ route('chapter.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="sub_title">ခေါင်းစဥ်</label>
                                <input type="hidden" name="sub_title" id="sub_title" value="{{ $title }}">
                                <input required disabled type="text" class="form-control" value="{{ $title }}"
                                    placeholder="ခေါင်းစဥ်">
                                @error('sub_title')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">အခန်း</label>
                                <input required type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" value="{{ old('title') }}" placeholder="အခန်း">
                                @error('title')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">စာသား</label>
                                <textarea class="form-control @error('street') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary "><i class="fas fa-plus-square mr-1"></i> Add
                                Chapter</button>
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
                focus: true,
                placeholder: 'ဇာတ်ကြောင်းရေးပါ',
                toolbar: [
                    ['style', ['bold', 'italic']], //Specific toolbar display
                    ['color', ['color']],
                    ['para', ['paragraph']],
                ],
            });
        });
    </script>
@endsection
