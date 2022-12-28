@extends('dashboard.app')

@section('title')
    Sarpay
@endsection
@section('head')
    <style>
        .slow  .switch-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
    </style>
@endsection
@section('content')

    @component('component.breadcrumb',
        [
            'data' => [
                'Readers' => route('admin.rindex'),
            ],
        ])
        @slot('last')
            Bought Books
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Bought Books
                @endslot
                @slot('button')
                    {{--                    <a href="{{ route('author.create') }}" class="btn btn-sm btn-outline-primary">--}}
                    {{--                        <i class="fas fa-plus fa-fw"></i>--}}
                    {{--                    </a>--}}
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 ">
                            <thead>
                            <tr>
                                <th scope="col">Main Title</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($books as $wp)
                                <tr>
                                    <td>{{ $wp->getBook->main_title }}  </td>
                                    <td >
                                        {{ $wp->getBook->title }}
                                    </td>
                                    <td>
                                        {{ $wp->getBook->author }}
                                    </td>
                                    <td>
                                        {{ $wp->getBook->price }}
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

        $(function() {
            $('.toggle-class').change(function() {
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
