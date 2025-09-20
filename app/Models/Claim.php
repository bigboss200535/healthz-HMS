<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $table = 'claims';
    protected $primaryKey = 'claim_id';
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

    protected $fillable = [
        'claim_id',
        'Opd_number',
        'age',
        'attendance_id',
        'birth_date',
        'pat_status',
        'attendance_date',
        'claim_start_date',
        'claim_month',
        'claim_year',
        'claims_end_date',
        'user_id',



        'updated_by',
        'status',
        'archived',
        'archived_id',
        'archived_by',
        'archived_date'
    ];

}
