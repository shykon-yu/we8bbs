<?php
namespace  App\Models\Traits;
use App\Models\Reply;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait ActiveUserCounter
{
    protected $users = [];
    protected $topic_weight = 4;
    protected $reply_weight = 4;
    protected $pass_days = 4;
    protected $user_number = 6;

    //设置缓存相关
    protected $cache_key = 'bbschat_active_users';
    protected $cache_expire_in_seconds = 65*60;

    public function countTopicScore()
    {
        $user_topics = Topic::query()->selectRaw('user_id,count(*) as topic_count')
            ->where('created_at','>=',Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();
        foreach($user_topics as $value){
            $this->users[$value->user_id]['score'] = $value->topic_count * $this->topic_weight;
        }
        return $this->users;
    }

    public function countReplyScore()
    {
        $user_replies = Reply::query()->selectRaw('user_id,count(*) as reply_count')
            ->where('created_at','>=',Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();

        foreach($user_replies as $value){
            $reply_score = $value->reply_count * $this->reply_weight;
            if( isset($this->users[$value->user_id]) ){
                $this->users[$value->user_id]['score'] += $reply_score;
            }else{
                $this->users[$value->user_id]['score'] = $reply_score;
            }
        }
        return $this->users;
    }
    public function getCountedUsersCollection()
    {
        $this->countTopicScore();
        $this->countReplyScore();
        $users = Arr::sort($this->users,function($user){
            return $user['score'];
        });
        $users = array_reverse($users,true);
        $users = array_slice($users,0,$this->user_number,true);
        $active_users = collect();
        foreach ($users as $user_id=>$user){
            $user = User::find($user_id);
            if($user){
                $active_users->push($user);
            }
        }
        return $active_users;
    }

    //放入缓存
    public function cacheActiveUsers($active_users){
        Cache::put($this->cache_key,$active_users,$this->cache_expire_in_seconds);
    }
    public function countAndCacheActiveUsers(){
        $active_users = $this->getCountedUsersCollection();
        $this->cacheActiveUsers($active_users);
    }
    public function getActiveUsers(){
        return Cache::remember($this->cache_key,$this->cache_expire_in_seconds,function(){
            return $this->getCountedUsersCollection();
        });
    }
}
