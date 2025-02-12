<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAttendance extends Model
{
    use HasFactory;
    protected $table = 'patient_attendance';
    protected $primaryKey = 'attendance_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class. 'gender_id');
    }

    public function age()
    {
        return $this->belongsTo(Age::class, 'age_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    
    protected $fillable = [
        'attendance_id',
        'patient_id',
        'opd_number',
        'attendance_date',
        'attendance_time',
        'pat_age',
        'full_age',

        'status_code',
        'reg_type',
        'service_type',
        'reg_status',
        'membership_number',
        'insured',
        'service_issued',
        'claims_check_code',
        'episode_id',
        'sponsor_id',
        'clinic_code',
        'records_no',
        'attendance_no',
        'gender_id',
        'age_id',
        'cash_amount',
        'top_up',
        'credit_amount',
        'gdrg_code',
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
