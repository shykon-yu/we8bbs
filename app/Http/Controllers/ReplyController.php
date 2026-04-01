<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(StoreReplyRequest $request , Reply  $reply)
    {
        $reply->content = $request->content;
        $reply->topic_id = $request->topic_id;
        $reply->user_id = Auth::id();
        $reply->save();
        return redirect()->to($reply->topic->link())->with('success','评论发表成功');
    }

    public function update(UpdateReplyRequest $request, Reply $reply)
    {
        //
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete',$reply);
        $reply->delete();
        return redirect()->to($reply->topic->link())->with('success','评论删除成功');
    }
}
