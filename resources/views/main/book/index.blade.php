@extends('dashboard.app')

@section('title')
    Sarpay
@endsection
@section('head')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <style>
        .slow  .switch-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
    </style>
@endsection
@section('content')

    @component('component.breadcrumb', ['data' => []])
        @slot('last')
            Book List
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Book List
                @endslot
                @slot('button')
                    {{--                    <a href="{{ route('author.create') }}" class="btn btn-sm btn-outline-primary">--}}
                    {{--                        <i class="fas fa-plus fa-fw"></i>--}}
                    {{--                    </a>--}}
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 text-center">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Popular</th>
                                <th scope="col">Control</th>
                                <th scope="col">Created_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($books as $wp)
                                <tr>
                                    <td class="text-left">{{ $wp->title }}  </td>
                                    <td >
                                        <span class="badge p-2 d-block badge-pill btn-outline-primary"> {{ $wp->author }}</span>

                                        {{\App\Group::find($wp->group_id)->title}}
                                    </td>
                                    <td>
                                        <input data-id="{{$wp->id}}" data-size="sm" class="toggle-popular" data-width="100"  data-onlabel="Popular" data-style="slow" data-offlabel="Normal" type="checkbox" data-toggle="switchbutton" data-onstyle="outline-success" data-offstyle="outline-secondary"  {{$wp->popular?'checked':''}}>
                                        <input data-id="{{$wp->id}}" data-size="sm" class="toggle-status" data-width="100"  data-onlabel="Finish" data-style="slow" data-offlabel="Ongoing" type="checkbox" data-toggle="switchbutton" data-onstyle="outline-success" data-offstyle="outline-secondary"  {{$wp->status=='finish'?'checked':''}}>

                                    </td>
                                    <td class="control-group d-flex justify-content-center"
                                        style="vertical-align: middle; text-align: center">
                                        <a href="{{ route('admin.bedit', $wp->id) }}"
                                           class="btn mr-2 btn-outline-warning btn-sm">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.bshow', $wp->id) }}" class="btn ml-1 btn-primary btn-sm">
                                            <i class="fas fa-folder-open"></i>
                                        </a>
                                    </td>

                                    <td>{{ $wp->created_at->diffForHumans() }}</td>
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
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

    <script>

        $(function() {
            $('.toggle-popular').change(function() {
                var popular = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/popular-book',
                    data: {'popular': popular, 'id': id},
                    success: function(data){
                        console.log(data.success)
                    }
                });
            });
        })

        $(function (){
            $('.toggle-status').change(function() {
                var status = $(this).prop('checked') == true ? 'finish' : 'ongoing';
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/book-status',
                    data: {'status': status, 'id': id},
                    success: function(data){
                        console.log(data.success)
                    }
                });
            })
        })

        $(".table").dataTable({
            "order": [
                [0, "desc"]
            ]
        });
        $(".dataTables_length,.dataTables_filter,.dataTable,.dataTables_paginate,.dataTables_info").author().addClass(
            "px-0");
    </script>
@endsection
