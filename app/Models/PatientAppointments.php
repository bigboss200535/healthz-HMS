<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAppointments extends Model
{
    use HasFactory;
    protected $table = 'patient_appointment';
    protected $primaryKey = 'appointment_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    protected $fillable = [
        'appointment_id',
        'patient_id',
        'opd_number',
        'facility_id',
        'clinic_id',
        'purpose',
        'appointment_date',
        'appointment_time',
        'request_date',
        'user_id',
        'added_id',
        'added_date',
        'added_by',
        'udpated_by',
        'status',
        'archived',
        'archived_id',
        'archived_by',
        'archived_date',
        '_token'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
