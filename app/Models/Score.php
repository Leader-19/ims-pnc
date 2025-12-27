<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{

    protected $fillable = [
        'weekly_worklog_score',
        'final_slide_score',
        'final_report_score'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function weeklyWorklogs()
    {
        return $this->belongsTo(WeeklyWorklog::class);
    }

    public function finalSlides()
    {
        return $this->belongsTo(FinalSlide::class);
    }

    public function finalReports()
    {
        return $this->belongsTo(FinalReport::class);
    }
}
