<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInterview extends Model
{

    protected $fillable = [
        'company_name',
        'date_interview',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
