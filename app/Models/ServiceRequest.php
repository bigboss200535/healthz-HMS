<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    protected $table = 'patient_attendance';
    // protected $primaryKey = 'age_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    protected $fillable = [
        'patient_id',
        'pat_age',
        'opd_number',
        'reg_status',
        'reg_type',
        'service_type',
        'membership_number',
        'clinic_code',
        'insured',
        'service_issued',
        'claims_check_code',
        'cash_amount',
        'credit_amount',
        'top_up',
        'gdrg_code',
        'gdrg_code',
        'gender_id',
        'age_id',
        'attendance_date',
        'episode_id',
        'attendance_time',
        'user_id',
        'added_id',
        'added_date',
        'udpated_by',
        'status',
        'archived',
        'archived_id',
        'archived_by',
        'archived_date'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
