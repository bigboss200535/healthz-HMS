<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient_info';
    protected $primaryKey = 'patient_id';
     public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
     
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id', 'title_id', 'firstname', 'middlename', 'lastname',
        'birth_date', 'gender_id', 'occupation', 'education', 'religion_id',
        'nationality_id', 'ghana_card', 'old_folder', 'death_status',
        'death_status_date', 'telephone', 'work_telephone', 'email',
        'address', 'town', 'region', 'facility_id', 'dependant',
        'email_verified', 'telephone_verified', 'allow_sms', 'blood_group',
        'allow_email', 'records_id', 'opd_type', 'register_date',
        'user_id', 'added_id', 'added_date', 'updated_by', 'status',
        'archived', 'archived_id', 'archived_by', 'archived_date'
    ];
    
    /**
     * Get the gender that owns the patient.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'gender_id');
    }
    
    /**
     * Get the religion that owns the patient.
     */
    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id', 'religion_id');
    }
    
    /**
     * Get the sponsor that owns the patient.
     */
    public function sponsor()
    {
        return $this->belongsTo(Sponsors::class, 'patient_id', 'patient_id', 'sponsor_id');
    }
    
    /**
     * Get the title that owns the patient.
     */
    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id', 'title_id');
    }
    
    /**
     * Get the nationality that owns the patient.
     */
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id', 'nationality_id');
    }
}
