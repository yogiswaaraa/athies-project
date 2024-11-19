<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceNotification extends Model
{
    protected $fillable = [
        'ac_unit_id',
        'type',
        'title',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];

    public function acUnit(): BelongsTo
    {
        return $this->belongsTo(AcUnit::class);
    }
}
