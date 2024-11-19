<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcUnit extends Model
{
    use HasFactory;

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

    public static $ac_models = ['ducting', 'split', 'window', 'standing', 'portable', 'smart'];
    public static $ac_statuses = ['active', 'maintenance', 'inactive'];

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
