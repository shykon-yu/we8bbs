<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reply
 *
 * @method static \Database\Factories\ReplyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reply query()
 * @mixin \Eloquent
 */
class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
