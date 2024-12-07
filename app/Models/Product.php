<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    protected $fillable = [
        'product_id',
        'product',
        'default_method',
        'prescription_qty',
        'store_id',
        'facility_id',
        'product_class',
        'manufacturer',
        'nhis_code',
        'nhis_cover',
        'expirable',
        'product_type',
        'is_stockable',
        'short_presentation',
        'presentation',
        'gender_id',
        'age_id',
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

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function age()
    {
        return $this->belongsTo(Age::class, 'age_id');
    }
}
