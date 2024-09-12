<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statistics';
    protected $fillable = [
        'total_vacancies',
        'open_count',
        'working_count',
        'closed_count',
        'cancelled_count',
        'open_percentage',
        'working_percentage',
        'closed_percentage',
        'cancelled_percentage',
    ];

}
