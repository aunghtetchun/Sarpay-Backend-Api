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
                    Payment List
                @endslot
                @slot('button')
                    {{--                        <a href="{{ route('admin.bshow', $payment[0]->category_id) }}" class="btn btn-sm btn-outline-primary">--}}
                    {{--                            <i class="fa-fw fas fa-list fa-fw"></i>--}}
                    {{--                        </a>--}}
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table export table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($payment as $wp)
                                <tr>
                                    <td>{{ $wp->getReader->name }}</td>
                                    <td>{{ $wp->amount }}</td>
                                    <td>
                                        <a class="venobox" data-gall="myGallery" href="{{ asset("/storage/payment/".$wp->payment) }}">
                                            <img class="rounded" src="{{ asset("/storage/payment/".$wp->payment) }}" alt="" style="width: 25px;">
                                        </a>
                                    </td>
                                    <td class="control-group d-flex justify-content-start"
                                        style="vertical-align: middle; text-align: center">
                                        @if($wp->status == 'wait')
                                            <a onClick="return confirm('Are you sure you want to approve this payment?')" href="{{ route('admin.pmshow', $wp->id) }}"
                                               class="btn mr-2  btn-outline-success btn-sm">
                                                <i class="feather-dollar-sign"></i> Approve
                                            </a>
                                        @endif
                                        <form action="{{ route('admin.pmdestroy', $wp->id) }}" method="post" id='cancel'>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                            <button onClick="return confirm('Are you sure you want to cancel?')" class="btn btn-sm btn-outline-danger mr-1" form="cancel">
                                                Cancel
                                                <i class="feather-trash-2"></i></button>
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
                   Finish Payment List
                @endslot
                @slot('button')
                    {{--                        <a href="{{ route('admin.bshow', $payment[0]->category_id) }}" class="btn btn-sm btn-outline-primary">--}}
                    {{--                            <i class="fa-fw fas fa-list fa-fw"></i>--}}
                    {{--                        </a>--}}
                @endslot
                @slot('body')
                    <div class="table-responsive">
                        <table class="table export table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($dpayment as $wp)
                                <tr>
                                    <td>{{ $wp->getReader->name }}</td>
                                    <td>{{ $wp->amount }}</td>
                                    <td>
                                        <a class="venobox" data-gall="myGallery" href="{{ asset("/storage/payment/".$wp->payment) }}">
                                            <img class="w-100 rounded" src="{{ asset("/storage/payment/".$wp->payment) }}" alt="" style="width: 25px">
                                        </a>
                                    </td>
                                    <td class="control-group d-flex justify-content-start"
                                        style="vertical-align: middle; text-align: center">
                                        <form action="{{ route('admin.pmdestroy', $wp->id) }}" method="post" id='del'>
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
