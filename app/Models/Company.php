<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{

    use SoftDeletes;
    protected $table = 'companies';
    protected $fillable = [
        'name',
        'owner_name',
        'phone_number',
    ];


    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class, 'company_id','id');
    }
}
