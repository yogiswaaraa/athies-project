<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    protected $fillable = ['name_user', 'damage_type', 'description', 'ac_unit_id', 'result', 'rejection_notes'];
}
