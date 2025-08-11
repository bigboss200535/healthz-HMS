<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroups extends Model
{
    use HasFactory;
    protected $table = 'age_groups';
    protected $primaryKey = 'age_group_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'age_group_id',
        'age_groups',
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

    
    public static function get_category_from_age($age_in_years)
    {
        return self::where('min_age', '<=', $age_in_years)
                ->where('max_age', '>=', $age_in_years)
                // ->where('status', 'Active')
                ->where('archived', 'No')
                ->first();
    }

}
