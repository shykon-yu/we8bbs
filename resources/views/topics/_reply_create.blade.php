<form action="{{route('replies.store')}}" method="POST" accept-charset="UTF-8" class="card-body">
    <input type="hidden" name="topic_id" value="{{$topic->id}}">
    @include('shared._errors')
    @csrf
    <div class="mb-3">
        <textarea name="content" class="form-control" id="content" placeholder="谈谈你的高见~" rows="3"></textarea>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-sm btn-primary">
            <i class="fa-regular fa-comment-dots"></i>
            发表评论
        </button>
    </div>
</form>
