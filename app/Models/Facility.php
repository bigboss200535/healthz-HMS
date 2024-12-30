<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facility';
    protected $primaryKey = 'facility_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'facility_id',
        'facility_name',
        'nhis_description',
        'nhis_api',
        'nhia_url',
        'nhia_key',
        'nhia_secret',
        'ccc_type',
        'nhia_desc',
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

    protected $casts = [
        'nhia_url' => 'encrypted',
        'nhia_key' => 'encrypted',
        'nhia_secret' => 'encrypted',
    ];


    public function setApiApiUrlAttribute($value)
    {
        $this->attributes['nhia_key'] = base64_encode($value);
    }

    public function getApiUrlAttribute($value)
    {
        return base64_decode($value);
    }
}
