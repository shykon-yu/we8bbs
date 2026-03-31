<?php

namespace App\Observers;

use App\Models\Reply;
use App\Models\Topic;

class ReplyObserver
{
    public function saving(Reply $reply)
    {
        $reply->content = clean($reply->content,'my_editor');
    }

    public function saved(Reply $reply)
    {
        $reply->topic->updateReplyCount();
    }

    public function deleted(Reply $reply)
    {
        $reply->topic->updateReplyCount();
    }
}
