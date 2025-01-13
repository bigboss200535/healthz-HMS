<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthFacilityLevels extends Model
{
    use HasFactory;

    protected $table = 'health_facility_levels';
    protected $primaryKey = 'h_f_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;
}
