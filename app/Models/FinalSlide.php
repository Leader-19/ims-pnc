<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalSlide extends Model
{

    protected $fillable = [
        'user_id',
        'slide_name',
        'slide_upload',
        'description'
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
