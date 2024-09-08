<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
      'name',
      'is_active',
    ];


    public function vacancies():HasMany
    {
        return $this->hasMany(Vacancy::class,'category_id','id');
    }
}