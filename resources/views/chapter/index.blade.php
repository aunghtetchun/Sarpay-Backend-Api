@extends('dashboard.author')

@section('title')
    Sarpay
@endsection

@section('content')
    @component('component.breadcrumb', ['data' => []])
        @slot('last')
            အပိုင်းများ
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    {{ $title }}
                @endslot
                @slot('button')
                        <a href="{{ route('book-insert', \App\Category::where([['title',$title]])->first('main_title')->main_title) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-list"></i>
                        </a>
                    <a href="{{ route('chapter.create', $title) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus fa-fw"></i>
                    </a>
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">အခန်း</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chapters as $wp)
                                    <tr>
                                        <td>{{ $wp->title }}</td>
                                        <td class="control-group d-flex justify-content-start"
                                            style="vertical-align: middle; text-align: center">
                                            <a href="#" class="btn mr-2 btn-outline-warning btn-sm" data-toggle="modal"
                                                data-target="#EditModal{{ $wp->id }}">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a href="{{ route('chapter.show', $wp->id) }}"
                                                class="btn mr-2  btn-outline-success btn-sm">
                                                <i class="feather-eye"></i>
                                            </a>
                                            <form action="{{ route('chapter.destroy', $wp->id) }}" method="post" id='del'>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-outline-danger" form="del"><i
                                                    class="feather-trash-2"></i></button>
                                        </td>
                                        @include('chapter.modal.edit')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@section('foot')
    <script>
        $(".table").dataTable({
            "order": [
                [0, "desc"]
            ]
        });
        $(".dataTables_length,.dataTables_filter,.dataTable,.dataTables_paginate,.dataTables_info").parent().addClass(
            "px-0");
    </script>
    {{-- <script>
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
    </script> --}}
@endsection
