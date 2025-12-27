<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyWorklog extends Model
{

    protected $filable = [
        'worklog_name',
        'worklog_upload',
        'discription'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function score()
    {
        return $this->hasOne(Score::class);
    }
}
