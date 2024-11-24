<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceHistory extends Model
{
    protected $fillable = [
        'ac_unit_id',
        'maintenance_date',
        'technician_name',
        'actions_taken',
        'notes',
        'result',
        'cost'
    ];

    public static $result_enum_array = [
        'success' => "Sukses",
        'partial' => "Pending",
        'failed' => "Gagal"
    ];
    protected $casts = [
        'maintenance_date' => 'date'
    ];

    public function acUnit(): BelongsTo
    {
        return $this->belongsTo(AcUnit::class);
    }
}
