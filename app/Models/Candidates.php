<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    protected $fillable = [
        'telegram_id',
        'full_name',
        'phone_number',
        'address',
        'gender',
        'university_place',
        'marital_state',
        'last_work',
        'languages',
        'voice_path',
        'photo_path',
        'positive_skills',
        'apps',
      
      ];
}
