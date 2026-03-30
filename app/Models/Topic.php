<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Topic
 *
 * @property int $id
 * @property string $title 帖子标题
 * @property string $content 帖子内容
 * @property int $user_id 作者ID
 * @property int $category_id 分类ID
 * @property int $reply_count 评论数
 * @property int $view_count 浏览数
 * @property int $last_reply_user_id 最后一个评论数的ID
 * @property int $order 最后一个评论数的ID
 * @property string|null $desc SEO页面内容描述
 * @property string|null $slug SEO优化
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TopicFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereLastReplyUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereReplyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereViewCount($value)
 * @mixin \Eloquent
 */
class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['title','content','desc','slug','category_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function scopeWithOrder($query,$order)
    {
        switch ($order) {
            case 'recent':
                $query->recent();
                break;
            default:
                return $query->recentReplied();
        }
    }
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at','desc');
    }
}
