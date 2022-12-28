<div class="modal fade text-left" id="ModalEdit{{ $wp->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <p>{{ $wp->id }}</p>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Edit Book') }}</h4>
                <button type="button" class="close bg-white btn-outline-primary btn" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.bupdate', $wp->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="title">စာအုပ်ခေါင်းစဥ်</label>
                        <input required type="text" class="form-control @error('title') is-invalid @enderror"
                            name="title" id="title" value="{{ $wp->title }}" placeholder="စာအုပ်ခေါင်းစဥ်">
                        @error('title')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="cover">
                            <i class="mr-1 feather-image"></i>
                            ကာဗာဓာတ်ပုံ
                        </label>
                        <input type="file" name="cover" class="form-control p-1 mr-2 overflow-hidden" required>
                        @error('cover')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="chapter">အခန်းအရေအတွက်</label>
                        <input required type="text" value="{{ $wp->chapter }}"
                            class="form-control @error('chapter') is-invalid @enderror" name="chapter" id="chapter"
                            value="{{ old('chapter') }}" placeholder="အခန်းအရေအတွက်">
                        @error('chapter')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <button class="btn btn-primary submit "><i class="fas fa-plus-square mr-1"></i>Update Book</button>
                </form>
            </div>
        </div>
    </div>
</div>
