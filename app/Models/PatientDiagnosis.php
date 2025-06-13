<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PatientDiagnosis extends Model
{
    use HasFactory;

    protected $table = 'patient_diagnosis';
    protected $primaryKey = 'attendance_diagnosis_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctors()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'diagnosis_id');
    }

    protected $fillable = [
        'attendance_diagnosis_id',
        'attendance_id',
        'attendance_date',
        'attendance_time',
        'entry_date',
        'episode_id',
        'diagnosis_id',
        'diagnosis_type',
        'diagnosis_category',
        'diagnosis_fee',
        'gdrg_code',
        'icd_10',
        'is_principal',
        'facility_id',
        'doctor_id',
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
}
