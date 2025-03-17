<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PatientSponsor extends Model
{
    use HasFactory;

    protected $table = 'patient_sponsorship';
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

    public function sponsor()
    {
        return $this->belongsTo(Sponsors::class, 'sponsor_id'); 
    }

    public function sponsortype()
    {
        return $this->belongsTo(SponsorType::class, 'sponsor_type_id'); 
    }
    
    protected $fillable = [
        'patient_id',
        'opd_number',
        'member_no',
        'sponsor_id',
        'sponsor_type_id',
        'priority',
        'start_date',
        'end_date',
        'dependant',
        'records_id',
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
