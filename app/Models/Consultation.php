<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'patient_consultation';
    protected $primaryKey = 'patient_consultation_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

     public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class. 'gender_id');
    }

    protected $fillable = [
        'consultation_id',
        'patient_id',
        'opd_number',
        'gender_id',
        'age_id',
        'patient_age',
        'clinic',
        'patient_status_id',
        'sponsor_type',
        'sponsor',
        'episode_id',
        'episode_type',
        'consulting_room',
        'prescriber',
        'attendance_date',
        'consultation_date',
        'consultation_type',
        'consultation_time',
        'attendance_id',
         'age_group_id',

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
