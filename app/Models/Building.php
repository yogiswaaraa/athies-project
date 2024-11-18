<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    protected $fillable = ['name', 'address', 'description'];

    public function acUnits(): HasMany
    {
        return $this->hasMany(AcUnit::class);
    }
}
