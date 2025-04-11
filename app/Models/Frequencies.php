<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequencies extends Model
{
    use HasFactory;
    protected $table = 'prescription_frequency';
    protected $primaryKey = 'frequency_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'frequency_id',
        'frequencies',
        'numerical_values',
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
