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

}
