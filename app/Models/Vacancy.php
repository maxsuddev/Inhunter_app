<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use SoftDeletes;

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
    return $this->belongsTo(User::class);
}


public function category(): BelongsTo
{
    return $this->belongsTo(Category::class);
}


public function company(): BelongsTo
{
    return $this->belongsTo(Company::class);
}

public function candidate(): BelongsTo
{
    return $this->belongsTo(Candidates::class);
}

}
