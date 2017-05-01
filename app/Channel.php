<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];

    protected $casts = ['activated' => 'boolean'];

    public static function findByUserId($userId)
    {
        return Channel::where('user_id', $userId)->first();
    }
}
