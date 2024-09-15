<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateStatistic extends Model
{
    protected  $fillable = [
        'total_count',
        'new_count',
        'working_count',
        'archive_count',
        'interview_count',
        'hired_count',
        'new_percentage',
        'working_percentage',
        'archive_percentage',
        'interview_percentage',
        'hired_percentage'
    ];
}


