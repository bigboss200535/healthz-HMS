<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    use HasFactory;

    protected $table = 'patient_prescription';
    protected $primaryKey = 'prescriptions_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    protected $fillable = [
        'prescriptions_id',
        'attendance_id',
        'attendance_date',
        'attendance_time',
        'entry_date',
        'episode_id',
        'unit_price',
        'product_id',
        'prescription_type',
        'start_date',
        'end_date',
        'sponsor_id',
        'store_id',
        'dosage',
        'unit_measure',
        'frequencies',
        'duration',
        'quantity_given',
        'quantity_serve',
        'gdrg_code',
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
        'archived_date',
        '_token'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stores()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

}
