<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcConditionLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'ac_unit_id',
        'temperature',
        'humidity',
        'power_consumption',
        'efficiency_rating',
        'logged_at'
    ];

    protected $casts = [
        'logged_at' => 'datetime',
        'temperature' => 'float',
        'humidity' => 'float',
        'power_consumption' => 'float',
        'efficiency_rating' => 'float'
    ];

    public function acUnit(): BelongsTo
    {
        return $this->belongsTo(AcUnit::class);
    }
}
