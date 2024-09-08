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
        'is_student',
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


    public static function getStatusOptions()
    {
        $status = ['new', 'interview', 'archive', 'hired'];

        return array_map(function ($status) {
            return ucfirst($status);
        }, array_combine($status, $status));

    }



    public static function getGenderOptions()
    {
        $gender = ['man', 'woman'];

        return array_map(function ($gender) {
            return ucfirst($gender);
        }, array_combine($gender,$gender));
    }

    public static function getMaritalStates(): array
    {
        $maritalStates = ['married', 'no_married', 'divorce', 'widow'];

        return array_map(function ($state) {
            return ucfirst(str_replace('_', ' ', $state));
        }, array_combine($maritalStates, $maritalStates));
    }
}
