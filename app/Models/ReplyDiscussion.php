<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyDiscussion extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public static function createReplyDiscussion($request)
    {
        $data = self::create($request);
        return $data;
    }
}

