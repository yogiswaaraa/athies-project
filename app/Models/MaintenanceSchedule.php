<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceSchedule extends Model
{

    use HasFactory;

    protected $fillable = [
        'ac_unit_id',
        'scheduled_date',
        'type',
        'description',
        'status',
        'completed_date'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'completed_date' => 'date'
    ];

    public static $types = ['routine', 'repair', 'inspection'];

    public static $statuses = ['pending', 'completed', 'cancelled'];

    public function acUnit(): BelongsTo
    {
        return $this->belongsTo(AcUnit::class);
    }
}
