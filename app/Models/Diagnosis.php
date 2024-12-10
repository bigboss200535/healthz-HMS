<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $table = 'diagnosis';
    protected $primaryKey = 'diagnosis_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;
}
