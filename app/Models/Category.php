<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
  use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
      'name',
      'is_active',
    ];

    public static function is_active(){
      $is_active = ['active', 'inactive'];

        return array_map(function ($status) {
            return ucfirst($status);
        }, array_combine($is_active, $is_active));
    }

    public function vacancies():HasMany
    {
        return $this->hasMany(Vacancy::class,'category_id','id');
    }
}
