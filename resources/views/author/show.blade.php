@extends('dashboard.app')

@section("title") Sarpay @endsection

@section('content')

    @component("component.breadcrumb",["data"=>[
        "Books" => "#",
        "Books" => "#"
    ]])
        @slot("last") See Books @endslot
    @endcomponent
        <div class="row">
            <div class="col-12">
                @component('component.card')
                    @slot('icon')
                        <i class="feather-file text-primary"></i>
                    @endslot
                    @slot('title')
                        {{ $author->name }} တင်ထားသောစာအုပ်စာရင်း
                    @endslot
                    @slot('button')
                            <a href="{{  route('author.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-list"></i>
                            </a>
                    @endslot
                    @slot('body')
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">စာအုပ်နာမည်</th>
{{--                                    <th scope="col">စျေးနှုန်း</th>--}}
                                    <th scope="col">အမျိုးအစား </th>
                                    <th scope="col">ယခုလစာဖတ်သူ</th>
                                    <th scope="col">အုပ်ရေ</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($books as $wp)
                                    <tr>
                                        <td>{{ $wp->title }}</td>
{{--                                        <td>{{ $wp->price }}</td>--}}
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                            {{ $wp->type == 'all' ? 'အခန်းဆက်' : 'လုံးချင်း' }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.bedit', $wp->id) }}"
                                               class="btn ml-auto btn-success rounded-pill btn-sm">
                                                {{ \App\Viewer::where('category_id',$wp->id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->count() }} ယောက် </a>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                {{ $wp->chapter }} အုပ်
                                                <span class="badge mx-auto badge-pill badge-success p-2 shadow-sm">
                                                    {{ $wp->get_category_count }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="control-group d-flex justify-content-start"
                                            style="vertical-align: middle; text-align: center">
                                            <a href="{{ route('admin.bedit', $wp->id) }}"
                                               class="btn mr-2 btn-outline-warning btn-sm">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.bshow', $wp->id) }}" class="btn ml-1 btn-primary btn-sm">
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
@endsection
