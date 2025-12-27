<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInternship extends Model
{

    protected $fillable = [
        'company_name',
        'start_date',
        'end_date',
        'allowance',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
