<?php

namespace App\Observers;

use App\Handlers\TranslateTopicTitleHandler;
use App\Jobs\TranslateSlug;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->content = clean($topic->content,'my_editor');
        $topic->desc = mack_desc($topic->content);
    }

    public function saved(Topic $topic)
    {
        if( !$topic->slug ){
            //$topic->slug = app(TranslateTopicTitleHandler::class)->translate($topic->title);
            dispatch(new TranslateSlug($topic));
        }
    }

    public function deleting(Topic $topic){
        DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}
