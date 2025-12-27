<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{

    protected $fillable = [
        'supervisor_name',
        'email_supervisor',
        'supervisor_phone_number'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
