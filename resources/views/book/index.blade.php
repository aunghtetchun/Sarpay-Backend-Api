@extends('dashboard.author')

@section('title')
    Sarpay
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
                    လုံးချင်းစာအုပ်စာရင်း
                @endslot
                @slot('button')
                    <a href="{{ route('book.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus fa-fw"></i>
                    </a>
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">စာအုပ်နာမည်</th>
                                    <th scope="col">အုပ်ရေ</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($one as $wp)
                                    <tr>
                                        <td>{{ $wp->title }}</td>
                                        <td>
{{--                                            <div class="d-flex justify-content-between align-items-center">--}}
{{--                                                {{ $wp->chapter }} အုပ်--}}
{{--                                               --}}
{{--                                            </div>--}}
                                            <span class="badge ml-auto badge-pill badge-success shadow-sm">
                                                    {{ \App\Category::where('book_id', $wp->id)->count() }}
                                                </span> အုပ်
                                        </td>
                                        <td class="control-group d-flex justify-content-start"
                                            style="vertical-align: middle; text-align: center">

                                            <a href="{{ route('book-insert', $wp->title) }}" class="btn ml-1 btn-primary btn-sm">
                                                <i class="fas fa-folder-open"></i>
                                            </a>
                                        </td>
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
                    အခန်းဆက်စာအုပ်စာရင်း
                @endslot
                @slot('button')
                    <a href="{{ route('book.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus fa-fw"></i>
                    </a>
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">စာအုပ်နာမည်</th>
                                    <th scope="col">အုပ်ရေ</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all as $wp)
                                    <tr>
                                        <td>{{ $wp->title }}</td>
                                        {{-- <td>{{ $wp->chapter }} အုပ်</td> --}}
                                        {{-- <td> --}}
                                        {{-- <img src="{{ asset('storage/cover/'.$wp->cover) }}" alt="" style="width: 50px;"> --}}
                                        {{-- </td> --}}
                                        <td>
{{--                                            <div class="d-flex justify-content-between align-items-center">--}}
{{--                                                {{ $wp->chapter }} အုပ်--}}
{{--                                                --}}
{{--                                            </div>--}}
                                            <span class="badge ml-auto badge-pill badge-success shadow-sm">
                                                    {{ \App\Category::where('book_id', $wp->id)->count() }}
                                                </span> အုပ်
                                        </td>
                                        <td class="control-group d-flex justify-content-start"
                                            style="vertical-align: middle; text-align: center">
                                            <a href="{{ route('book-insert', $wp->title) }}" class="btn ml-1 btn-primary btn-sm">
                                                <i class="fas fa-folder-open"></i>
                                            </a>
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
@endsection
