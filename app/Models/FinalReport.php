<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalReport extends Model
{

    protected $fillable = [
        'report_name',
        'final_upload',
        'description',
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
