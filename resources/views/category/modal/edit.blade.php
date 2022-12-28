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
                <form action="{{ route('category.update', $wp->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="title">စာအုပ်ခွဲခေါင်းစဥ်</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            id="title" value="{{ $wp->title }}" placeholder="စာအုပ်ခွဲခေါင်းစဥ်">
                        @error('title')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Condition</label>
                        <select  class="custom-select" name="type" id="type">
                            <option value="done" @if ($wp->type == 'done') selected @endif>Done</option>
                            <option value="release" @if ($wp->type == 'release') selected @endif>Release</option>
                        </select>
                        @error('type')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="chapter">အခန်းအရေအတွက်</label>
                        <input type="text" class="form-control @error('chapter') is-invalid @enderror" name="chapter"
                            id="chapter" value="{{ $wp->chapter }}" placeholder="အခန်းအရေအတွက်">
                        @error('chapter')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary "><i class="fas fa-upload mr-1"></i> Update
                        Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
