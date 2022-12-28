@extends('dashboard.app')

@section('title')
    Sarpay
@endsection

@section('content')

    @component('component.breadcrumb', ['data' => []])
        @slot('last')
            Reader List
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Reader List
                @endslot
                @slot('button')
{{--                    <a href="{{ route('author.create') }}" class="btn btn-sm btn-outline-primary">--}}
{{--                        <i class="fas fa-plus fa-fw"></i>--}}
{{--                    </a>--}}
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Buy Books</th>
                                <th scope="col">Coin</th>
                                <th scope="col">Actions</th>
                                <th scope="col">Created_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (\App\Reader::all() as $wp)
                                <tr>
                                    <td>{{ $wp->name }}  </td>
                                    <td >
                                       {{ $wp->email }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            {{ $wp->get_buy_count }}
                                            <p class="mb-0 pb-0">{{\App\Buy::where('reader_id',$wp->id)->count()}} books </p>
                                            <a href="{{ route('admin.rbook', $wp->id) }}"
                                               class="btn mr-1 btn-outline-success btn-sm ml-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $wp->coin }}</td>
                                    <td class="control-group d-flex justify-content-start"
                                        style="vertical-align: middle; text-align: center">

                                        <a href="{{ route('admin.redit', $wp->id) }}"
                                           class="btn mr-1 btn-outline-warning btn-sm">
                                            <i class="fas fa-coins"></i>
                                            Add Coin
                                        </a>

{{--                                        <a href="{{ route('admin.rshow', $wp->id) }}"--}}
{{--                                           class="btn ml-1 btn-outline-danger btn-sm">--}}
{{--                                            <i class="fas fa-user-lock"></i>--}}
{{--                                        </a>--}}
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
    <script>
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#previewImg").attr("src", e.target.result);

                }

                reader.readAsDataURL(file);
            }
        }

        $(".table").dataTable({
            "order": [
                [0, "desc"]
            ]
        });
        $(".dataTables_length,.dataTables_filter,.dataTable,.dataTables_paginate,.dataTables_info").author().addClass(
            "px-0");
    </script>
@endsection
