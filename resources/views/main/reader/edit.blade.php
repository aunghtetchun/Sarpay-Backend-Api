@extends('dashboard.app')

@section('title')
    Sarpay
@endsection

@section('content')

    @component('component.breadcrumb',
        [
            'data' => [
                'Reader' => route('book.index'),
            ],
        ])
        @slot('last')
            Show Reader
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12 col-xl-6">
            @component('component.card')
                @slot('icon')
                    <i class="feather-file text-primary"></i>
                @endslot
                @slot('title')
                    Reader
                @endslot
                @slot('button')
                    {{--                    <a href="{{ route('book.index') }}" class="btn btn-sm btn-outline-primary">--}}
                    {{--                        <i class="fas fa-list fa-fw"></i>--}}
                    {{--                    </a>--}}
                @endslot
                @slot('body')
                    <div>
                        <form action="{{ route('admin.rupdate', $reader->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user mr-1"></i>နာမည်</label>
                                <input disabled type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" id="name" value="{{ $reader->name }}" placeholder="နာမည်">
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <label for="email"><i class="fas fa-mail-bulk mr-1"></i>Email</label>
                                    <input disabled type="text" class="form-control @error('email') is-invalid @enderror"
                                           name="email" id="email" value="{{ $reader->email }}" >
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <label for="password"><i class="fas fa-user-lock mr-1"></i>Password</label>
                                    <input  type="text" class="form-control @error('password') is-invalid @enderror"
                                           name="password" id="password" value="" placeholder="******" >
                                </div>
                            </div>
                             <div class="form-group mt-2">
                                <label for="coin"><i class="fas fa-coins mr-1"></i>Remain Coin</label>
                                 <input disabled  type="number" value="{{ $reader->coin }}"
                                      >
                              
                                @error('coin')
                                <small class="invalid-feedback font-weight-bold" role="alert">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="coin"><i class="fas fa-coins mr-1"></i>Add Coin</label>
                            
                                <input  type="number" class="form-control @error('coin')  is-invalid @enderror"
                                        name="coin" id="coin" value="0"
                                        placeholder="$xxxx">
                                @error('coin')
                                <small class="invalid-feedback font-weight-bold" role="alert">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                           
                            <button type="submit" class="btn btn-primary "><i class="fas fa-coins mr-1"></i> Add Coin</button>
                        </form>
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

                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                    $("#previewImg").removeClass("d-none");
                    $("#cover").hide();
                    $("#edit").removeClass("d-none");

                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
