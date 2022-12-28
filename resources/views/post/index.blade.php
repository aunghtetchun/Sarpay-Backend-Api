@extends('dashboard.app')

@section("title") Post List @endsection

@section('content')

    @component("component.breadcrumb",["data"=>[

    ]])
        @slot("last") Post List @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @component("component.card")
                @slot('icon') <i class="feather-file text-primary"></i> @endslot
                @slot('title') Post List @endslot
                @slot('button')
                    <a href="{{ route('post.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list fa-fw"></i> All
                    </a>
                        <a href="{{ route('post.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus fa-fw"></i> Add Post
                        </a>
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-border mb-0 table-hover">
                            <thead>
                            <tr>
                                <th scope="col">View</th>
                                <th  scope="col">City</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Controls</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(\App\Post::count() > 0)
                            @foreach($posts as $p)
                                <tr >
                                    <td scope="row" >
                                        <span class="badge badge-primary badge-pill p-2">{{ \App\Viewer::where('post_id',$p->id)->count() }} views</span>
                                    </td>
                                    <td>{{ $p->getCategory->title }}
                                    <td>{{ $p->name }}
                                    <td>{{ $p->price }}</td>
                                    <td>
                                        <div class="d-inline-flex">
                                            <a target="_blank" href="{{ route('post.edit',$p->id) }}" class="btn mr-2 btn-outline-warning btn-sm">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <form action="{{ route('post.destroy',$p->id) }}"  method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-outline-danger text-left">
                                                    <i class="feather-trash-2"></i>
                                                </button>
                                            </form>
                                            <a target="_blank" href="{{ route('post.show',$p->id) }}" class="btn ml-2 btn-outline-success btn-sm">
                                                <i class="feather-eye"></i>
                                            </a>
                                        </div>




                                    </td>

                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@section("foot")
    <script>
        $(".table").dataTable({
            "order": [[0, "desc" ]]
        });
        $(".dataTables_length,.dataTables_filter,.dataTable,.dataTables_paginate,.dataTables_info").parent().addClass("px-0");
    </script>
@endsection
