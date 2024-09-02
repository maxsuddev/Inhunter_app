<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidates extends Model
{
    protected $table = 'candidates';
    protected $fillable = [
        'telegram_id',
        'full_name',
        'phone_number',
        'address',
        'gender',
        'university_place',
        'marital_state',
        'last_work',
        'birthday',
        'language_id',
        'voice_path',
        'photo_path',
        'positive_skills',
        'app_id',
      ];

    public function language():BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function app():BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class, 'company_id','id');
    }
}
