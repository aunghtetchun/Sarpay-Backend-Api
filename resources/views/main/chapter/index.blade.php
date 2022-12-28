@extends('dashboard.app')

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
                    @if(count($chapters)>0)
                            {{ $chapters[0]->name }} ( {{ $chapters[0]->author }} ) ရေးထားသောစာအုပ်များ
                        @else
                        တင်ထားသောစာအုပ်မရှိပါ
                        @endif
                @endslot
                @slot('button')
{{--                        <a href="{{ route('admin.bshow', $chapters[0]->category_id) }}" class="btn btn-sm btn-outline-primary">--}}
{{--                            <i class="fa-fw fas fa-list fa-fw"></i>--}}
{{--                        </a>--}}
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
                                        <a href="{{ route('admin.chshow', $wp->id) }}"
                                           class="btn mr-2  btn-outline-success btn-sm">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.chdestroy', $wp->id) }}" method="post" id='del'>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-outline-danger mr-1" form="del"><i
                                                class="feather-trash-2"></i></button>
                                    </td>
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
