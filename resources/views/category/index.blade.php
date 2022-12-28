@extends('dashboard.author')

  @section("title") Sarpay @endsection

@section('content')

    @component("component.breadcrumb",["data"=>[

    ]])
        @slot("last") အခန်းဆက်အပိုင်းများ @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @component("component.card")
                @slot('icon') <i class="feather-file text-primary"></i> @endslot
                @slot('title') ( {{ $title }} ) အတွက် Free စာအုပ်  @endslot
                @slot('button')
                        <a href="{{ route('book.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-list"></i>
                        </a>
                    {{--                    <a href="{{ route('category.create',$title) }}" class="btn btn-sm btn-outline-primary">--}}
                    {{--                        <i class="fas fa-plus fa-fw"></i> Free--}}
                    {{--                    </a>--}}
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col">စာအုပ်နာမည်</th>
                                <th scope="col">အခန်း</th>
                                <th scope="col">စာဖတ်သူ</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fbooks as $wp)
                                <tr>
                                    <td>{{ $wp->title }}</td>
                                    <td>
                                        <span class="badge ml-auto badge-pill badge-success shadow-sm">
                                            {{ $wp->get_chapter_count  }}
                                        </span>  ပိုင်း
                                    </td>
                                    <td>
                                          <span class="badge ml-auto badge-pill badge-success shadow-sm">
                                            {{ \App\Viewer::where('category_id', $wp->id)->count() }} </span> ယောက်
                                    </td>
                                    <td class="control-group d-flex justify-content-start" style="vertical-align: middle; text-align: center">
                                        @if($wp->type == 'done')
                                        <a href="#" class="btn mr-1 btn-outline-warning btn-sm" data-toggle="modal"
                                           data-target="#EditModal{{ $wp->id }}">
                                            <i class="feather-edit"></i>
                                        </a>
                                        @endif
                                        <a href="{{ route('chapter-insert',$wp->title) }}" class="btn ml-1 btn-primary btn-sm">
                                            <i class="fas fa-folder-open"></i>
                                        </a>
                                    </td>
                                    @include('category.modal.edit')
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endslot
            @endcomponent
        </div>

        <div class="col-12">
            @component("component.card")
                @slot('icon') <i class="feather-file text-primary"></i> @endslot
                @slot('title')( {{ $title }} ) အတွက် paid စာအုပ်စာရင်း @endslot
                @slot('button')

                    <a href="{{ route('category.create',$title) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus fa-fw"></i> Add
                    </a>
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col">စာအုပ်နာမည်</th>
                                <th scope="col">အခန်း</th>
                                <th scope="col">စျေးနှုန်း</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $wp)
                                <tr>
                                    <td>{{ $wp->title }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            {{ $wp->chapter }} ပိုင်း
                                            <span class="badge ml-auto badge-pill badge-success shadow-sm">
                                            {{ $wp->get_chapter_count  }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ $wp->price }} ကျပ်</td>
                                    <td class="control-group d-flex justify-content-start" style="vertical-align: middle; text-align: center">
                                        @if($wp->type == 'done')
                                            <a href="#" class="btn mr-1 btn-outline-warning btn-sm" data-toggle="modal"
                                               data-target="#EditModal{{ $wp->id }}">
                                                <i class="feather-edit"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('chapter-insert',$wp->title) }}" class="btn ml-1 btn-primary btn-sm">
                                            <i class="fas fa-folder-open"></i>
                                        </a>
                                        @if($wp->type == 'release')
                                            <form action="{{ route('category.done', $wp->id) }}" method="post" id='del'>
                                                @csrf
                                                @method('put')
                                            </form>
                                            <button onClick="return confirm('Are you sure you want to finish {{ $wp->title }} ?')" class="btn btn-sm btn-success ml-2" form="del">
                                                <i class="fas fa-book"></i> Finish</button>

                                            @endif

                                        </td>
                                        @include('category.modal.edit')
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
            "order": [[0, "desc" ]]
        });
        $(".dataTables_length,.dataTables_filter,.dataTable,.dataTables_paginate,.dataTables_info").parent().addClass("px-0");
    </script>
@endsection
