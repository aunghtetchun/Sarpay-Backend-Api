@extends('dashboard.author')

@section('title')
    Sarpay
@endsection

@section('content')

    @component('component.breadcrumb',
        [
            'data' => [
                'Chapter' => '#',
                'Chapter' => '#',
            ],
        ])
        @slot('last')
            See Chapter
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            @component('component.card')
                @slot('icon')
                    <i class="fa-fw feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Chapter
                @endslot
                @slot('button')
                    <a href="{{ route('chapter-insert', $chapter->sub_title) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa-fw fas fa-list fa-fw"></i>
                    </a>
                        <form class="d-inline-block" action="{{ route('admin.chdestroy', $chapter->id) }}" method="post" id='del'>
                            @csrf
                            @method('DELETE')
                        </form>
                        <button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-outline-danger mr-1" form="del"><i
                                class="feather-trash-2"></i></button>
                @endslot
                @slot('body')
                    <div class="card-body">
                        @isset($chapter)
                            <div class="d-flex flex-wrap justify-content-around">
                                <h5>{{ $chapter->title }}</h5>
                                <div class="col-12">
                                    {!! $chapter->description !!}
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
