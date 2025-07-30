<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAdmissions extends Model
{
    use HasFactory;

    protected $table = 'patient_admissions';
    protected $primaryKey = 'admissions_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;
}
