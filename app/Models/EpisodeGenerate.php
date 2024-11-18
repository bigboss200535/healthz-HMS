<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpisodeGenerate extends Model
{
    use HasFactory;

    protected $table = 'attendance_episode';
    protected $primaryKey = 'episode_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    
    protected $fillable = [
        'episode_id',
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
}
