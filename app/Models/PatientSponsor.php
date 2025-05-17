<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientSponsor extends Model
{
    protected $table = 'patient_sponsorship';
    protected $primaryKey = 'patient_sponsor_id';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        // 'patient_sponsor_id', 
        'patient_id', 
        'opd_number',
        'member_no', 
        'sponsor_id', 
        'sponsor_type_id',
        'card_serial',
        'start_date',
        'end_date',
        'dependant',
        'records_id',
        'priority',
        'facility_id',
        'is_active',
        'user_id',
        'added_date', 
        'added_id',
        'updated_by',
        'status',
        'archived',
        'archived_by',
        'archived_id',
        'archived_date',
       '_token'
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }
    
    public function sponsor()
    {
        return $this->belongsTo(Sponsors::class, 'sponsor_id', 'sponsor_id');
    }
    
    public function sponsorType()
    {
        return $this->belongsTo(SponsorType::class, 'sponsor_type_id', 'sponsor_type_id');
    }
}
