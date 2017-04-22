<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

//status (1)"open", (2)"close", (3)pending

class Todo extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at'];


    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'done_recorder_id');
    }


    public function getStatusTextAttribute()
    {
        $result = '未指定';

        $value = $this->status;

        switch ($value) {
            case 'open':
                $result = '未完成';
                break;
            case 'close':
                $result = '完成';
                break;
            case 'pending':
                $result = '暫停';
                break;
            default:
        }
        return $result;
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->toDateString();
    }


    public function getExpectedFinishAtAttribute($value)
    {
        if ($value == null) {
            return '';
        }

        return $value;
    }

    public function getRecorderNameAttribute()
    {
        if ($this->recorder == null) {
            return '';
        }

        return $this->recorder->name;
    }
}
