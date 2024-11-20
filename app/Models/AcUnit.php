<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class AcUnit extends Model
{
    protected $fillable = [
        'building_id',
        'unit_code',
        'model',
        'serial_number',
        'status',
        'current_temperature',
        'efficiency_rating',
        'installation_date'
    ];

    protected $casts = [
        'installation_date' => 'date',
        'current_temperature' => 'float',
        'efficiency_rating' => 'float'
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function maintenanceSchedules(): HasMany
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }

    public function maintenanceHistories(): HasMany
    {
        return $this->hasMany(MaintenanceHistory::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(MaintenanceNotification::class);
    }

    public function conditionLogs(): HasMany
    {
        return $this->hasMany(AcConditionLog::class);
    }
}
