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
            Edit Chapter
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 col-xl-6">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Edit Chapter
                @endslot
                @slot('button')
                    {{-- <a href="{{ route('chapter.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list fa-fw"></i>
                    </a> --}}
                @endslot
                @slot('body')
                    <div>
                        @inject('chapters', 'App\Chapter')
                        <form action="{{ route('chapter.update', $chapter) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="sub_title">ခေါင်းစဥ်</label>
                                {{-- <input type="hidden" name="sub_title" id="sub_title" value="{{ $chapter->sub_title }}"> --}}
                                <input required type="text" class="form-control" name="sub_title"
                                    value="{{ $chapters->find($chapter)->sub_title }}">
                                @error('sub_title')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">အခန်း</label>
                                <input required type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" value="{{ $chapters->find($chapter)->title }}"
                                    placeholder="အခန်း">
                                @error('title')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">စာသား</label>
                                <textarea class="form-control @error('street') is-invalid @enderror" name="description" id="description">{{ $chapters->find($chapter)->description }}</textarea>
                                @error('description')
                                    <small class="invalid-feedback font-weight-bold" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary "><i class="fas fa-upload mr-1"></i> Update
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
