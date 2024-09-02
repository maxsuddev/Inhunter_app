<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancy extends Model
{
    protected $table = 'vacancies';

    protected $fillable = [
        'user_id',
        'company_id',
        'category_id',
        'name',
        'state',
        'opened_at',
        'closed_at',
        'candidate_id'
    ];



public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id','id');
}


public function category(): BelongsTo
{
    return $this->belongsTo(Category::class,'category_id','id');
}


public function company(): BelongsTo
{
    return $this->belongsTo(Company::class,'company_id','id');
}

public function candidate(): BelongsTo
{
    return $this->belongsTo(Candidates::class,'candidate_id','id');
}
}
