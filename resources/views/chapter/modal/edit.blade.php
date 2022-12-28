<div class="modal fade text-left" id="EditModal{{ $wp->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                <form action="{{ route('chapter.update', $wp->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="title">စာအုပ်ခေါင်းစဥ်</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            id="title" value="{{ $wp->title }}" placeholder="စာအုပ်ခေါင်းစဥ်">
                        @error('title')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">စာသား</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                            rows="10">{!! strip_tags($wp->description) !!}</textarea>
                        @error('description')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <button class="btn btn-primary submit "><i class="fas fa-upload mr-1"></i>Update Chapter</button>
                </form>
            </div>
        </div>
    </div>
</div>
