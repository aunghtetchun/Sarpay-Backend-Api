<div class="modal fade text-left" id="ModalCreate{{ $wp->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <p>{{ $wp->id }}</p>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Edit Author Detail') }}</h4>
                <button type="button" class="close bg-white btn-outline-primary btn" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('author.update', $wp->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" id="email" value="{{ $wp->email }}" placeholder="Email">
                        @error('email')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input required type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{old('password')}}" placeholder="Password">
                        @error('password')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input required type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" id="name" value="{{ $wp->name }}" placeholder="Name">
                        @error('name')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="photo">
                            <i class="mr-1 feather-image"></i>
                            Select New Photo
                        </label>
                        <input type="file" id="photo" onchange="previewFile(this);" name="photo"  class="form-control p-1 mr-2 overflow-hidden @error('photo') is-invalid @enderror" >
                        @error('photo')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
{{--                        <a id="edit" onclick="$('#photo').trigger('click');" class="btn text-white btn-primary btn-sm" style="position:absolute; right: 22px;">--}}
{{--                            <i class="fas fa-edit "></i>--}}
{{--                        </a>--}}
{{--                        <img id="previewImg" onclick="$('#photo').trigger('click');" class="w-100 rounded" src="{{asset($wp->photo)}}" alt="your image" />--}}
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input required type="text" class="form-control @error('author') is-invalid @enderror"
                            name="author" id="author" value="{{ $wp->author }}" placeholder="Author Name">
                        @error('author')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="card">Id Card</label>
                        <input required type="text" class="form-control @error('card') is-invalid @enderror"
                            name="card" id="card" value="{{ $wp->card }}" placeholder="Id Card">
                        @error('card')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input required type="text" class="form-control @error('phone') is-invalid @enderror"
                            name="phone" id="phone" value="{{ $wp->phone }}" placeholder="Phone">
                        @error('phone')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <button class="btn btn-primary submit "><i class="fas fa-plus-square mr-1"></i>Update
                        Author</button>
                </form>

            </div>
        </div>
    </div>
</div>
