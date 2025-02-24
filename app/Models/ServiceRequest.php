<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    // protected $table = 'xxxxxx';
    // protected $primaryKey = 'attendance_id';
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
        'pat_age',
        'age_id',
        'full_age',
        'service_id',
        'service_fee_id',
        'clinic_code',
        'service_type',
        'request_type',
        'sponsor_type_id',
        'sponsor_id',
        'credit_amount',
        'cash_amount',
        'gdrg_code',
        'status_code',
        'insured',
        'service_issued',
        'attendance_date',
        'attendance_time',
        'attendance_type',
        'records_no',
        'attendance_no',
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
