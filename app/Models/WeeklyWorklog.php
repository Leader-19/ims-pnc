<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyWorklog extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function score()
    {
        return $this->hasOne(Score::class);
    }
}
