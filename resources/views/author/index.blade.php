@extends('dashboard.app')

@section('title')
    Sarpay
@endsection

@section('content')

    @component('component.breadcrumb', ['data' => []])
        @slot('last')
            Author List
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Author List
                @endslot
                @slot('button')
                    <a href="{{ route('author.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus fa-fw"></i>
                    </a>
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Id Card</th>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Created_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $wp)
                                    <tr>
                                        <td>{{ $wp->name }}  </td>
                                        <td >
                                            <div class="d-flex justify-content-between align-items-center">
                                                {{ $wp->author }}
                                                <span class="badge ml-auto badge-pill badge-primary shadow-sm">
            {{ \App\Book::where('user_id', $wp->id)->count()  }}
        </span>
                                            </div>
                                        </td>
                                        <td>{{ $wp->phone }}</td>
                                        <td>{{ $wp->card }}</td>
                                        <td class="control-group d-flex justify-content-start"
                                            style="vertical-align: middle; text-align: center">

                                            <a href="{{ route('author.edit', $wp->id) }}"
                                                class="btn mr-1 btn-outline-warning btn-sm">
                                                <i class="feather-edit"></i>
                                            </a>

                                            <a href="{{ route('author.show', $wp->id) }}"
                                                class="btn ml-1 btn-outline-success btn-sm">
                                                <i class="feather-eye"></i>
                                            </a>
                                            <a onClick="return confirm('Are you sure you want to ban?')" href="{{ route('author.ban', $wp->id) }}"
                                               class="btn ml-1 btn-outline-danger btn-sm">
                                                Ban <i class="fas fa-user-lock"></i>
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
        <div class="col-12">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                   Ban Author List
                @endslot
                @slot('button')
                    <a href="{{ route('author.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus fa-fw"></i>
                    </a>
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Id Card</th>
                                <th scope="col">Actions</th>
                                <th scope="col">Created_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bauthors as $wp)
                                <tr>
                                    <td>{{ $wp->name }}  </td>
                                    <td >
                                        <div class="d-flex justify-content-between align-items-center">
                                            {{ $wp->author }}
                                            <span class="badge ml-auto badge-pill badge-primary shadow-sm">
            {{ \App\Book::where('user_id', $wp->id)->count()  }}
        </span>
                                        </div>
                                    </td>
                                    <td>{{ $wp->phone }}</td>
                                    <td>{{ $wp->card }}</td>
                                    <td class="control-group d-flex justify-content-start"
                                        style="vertical-align: middle; text-align: center">
                                        <a onClick="return confirm('Are you sure you want to unban?')" href="{{ route('author.ban', $wp->id) }}"
                                           class="btn ml-1 btn-outline-success btn-sm">
                                            Unban
                                            <i class="fas fa-user-lock"></i>
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
