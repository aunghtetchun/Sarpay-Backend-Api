@extends('dashboard.author')
@section("title") Dashboard @endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header h5 py-3">Welcome {{ auth()->user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="font-weight-bold py-5 text-center">
                        Your Account has been <span class="text-danger">BAN</span> by Admin...
                    </h3>
                    <h4 class="font-weight-bold py-5 text-center">
                        Please Contact the Administrator to unban your account
                    </h4>
                </div>
            </div>
        </div>
    </div>

@endsection
