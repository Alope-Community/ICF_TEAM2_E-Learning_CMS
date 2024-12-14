<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyDiscussion extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public static function createReplyDiscussion($request)
    {
        $data = self::create($request);
        return $data;
    }
}
