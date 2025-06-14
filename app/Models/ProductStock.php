<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $table = 'product_stocked';
    protected $primaryKey = 'stocked_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    protected $fillable = [
        'stocked_id',
        'product_id',
        'unit_price',
        'stock_level',
        'expiry_date',
        'batch',
        'store_id',
        'user_id',
        'facility_id',
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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
