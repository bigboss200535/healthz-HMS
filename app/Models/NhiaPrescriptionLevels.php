<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhiaPrescriptionLevels extends Model
{
    use HasFactory;
    protected $table = 'nhia_prescription_levels';
    protected $primaryKey = 'level_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    protected $fillable = [
        'level_id',
        'levels',
        'level_order',
        'code',
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
    
}
