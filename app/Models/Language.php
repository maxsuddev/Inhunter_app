<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
protected $table = 'languages';
    protected $fillable = [
        'name',
    ];

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidates::class, 'language_id');

    }
}
