<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class App extends Model
{
    protected $table = 'apps';

    protected $fillable = [

        'name',
    ];

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidates::class, 'app_id');
    }
}
