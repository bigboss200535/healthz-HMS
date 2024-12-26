<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $table = 'nationality';
    protected $primaryKey = 'nationality_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;
}
