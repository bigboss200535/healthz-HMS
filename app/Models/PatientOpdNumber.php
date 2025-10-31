<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PatientOpdNumber extends Model
{
    use HasUuids;
    use HasFactory;
       
    protected $table = 'patient_nos';
    // protected $primaryKey = 'patient_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    
    protected $fillable = [
        'patient_id',
        'opd_number',
        'clinic_id',
        'registration_date',
        'registration_time',
        'year',
        'month',
        'user_id',
        'added_id',
        'added_date',
        'udpated_by',
        'status',
        'archived',
        'archived_id',
        'archived_by',
        'archived_date',
        '_token'
    ];
}
