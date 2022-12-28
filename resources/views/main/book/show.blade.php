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
            @component("component.card")
                @slot('icon') <i class="fa-fw feather-file text-primary"></i> @endslot
                @slot('title') Free စာအုပ် @endslot
                @slot('button')
                    @if(count($books)>0)
                        <a href="{{  route('author.show', $books[0]->user_id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-list"></i>
                        </a>
                    @endif

                @endslot
                @slot('body')
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">စာအုပ်နာမည်</th>
                                    <th scope="col">အခန်း</th>
                                    <th scope="col">စာဖတ်သူစုစုပေါင်း</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fbooks as $wp)
                                    <tr>
                                        <td>{{ $wp->title }}</td>
                                        <td>
                                        <span class="badge mx-auto badge-pill badge-primary p-2 shadow-sm">
                                            {{ $wp->get_chapter_count  }} ပိုင်း
                                        </span>
                                        </td>
                                        <td>
                                            <span class="badge mx-auto badge-pill badge-primary p-2 shadow-sm">
                                            {{ \App\Viewer::where('category_id', $wp->id)->select(\DB::raw('COUNT(category_id) as count'), 'reader_id')
    ->groupBy('reader_id')
    ->having('count', '>=', 1)
    ->get()->count() }}  ယောက်</span>
                                        </td>
                                        <td class="control-group d-flex justify-content-start" style="vertical-align: middle; text-align: center">
                                            <a href="{{ route('admin.cedit', $wp->id) }}"
                                               class="btn mr-1 btn-outline-warning btn-sm">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.chindex',$wp->id) }}" class="btn ml-1 btn-primary btn-sm">
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
            @component("component.card")
                @slot('icon') <i class="fa-fw feather-file text-primary"></i> @endslot
                @slot('title')Paid စာအုပ်စာရင်းများ @endslot
                @slot('button')
                        @if(count($books)>0)
                            <a href="{{  route('author.show', $books[0]->user_id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-list"></i>
                            </a>
                        @endif

                @endslot
                @slot('body')
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">စာအုပ်နာမည်</th>
                                    <th scope="col">အခန်း</th>
                                    <th scope="col">စျေးနှုန်း / အရေအတွက်</th>
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
                                                <span class="badge mx-auto badge-pill badge-success shadow-sm">
                                                    {{ $wp->get_chapter_count }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    {{ $wp->price }} ကျပ်
                                                    @if($wp->get_buy_count>0)
                                                    <span class="badge mx-auto badge-pill badge-primary p-2 shadow-sm">
                                                        {{ $wp->get_buy_count  }} အုပ်ရောင်းပီး
                                                    </span>
                                                    @endif
                                                </div>
                                        </td>
                                        <td class="control-group d-flex justify-content-start" style="vertical-align: middle; text-align: center">
                                            <a href="{{ route('admin.cedit', $wp->id) }}"
                                               class="btn mr-2 btn-outline-warning btn-sm">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <form class="d-inline-block " action="{{ route('admin.cdestroy',$wp->id) }}"  method="post" id="del">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                            <button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-outline-danger" form="del"><i
                                                    class="feather-trash-2 "></i></button>
                                            <a href="{{ route('admin.chindex',$wp->id) }}" class="btn ml-2 btn-primary btn-sm">
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
