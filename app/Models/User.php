<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Notification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasUuids;
    
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'username',
        'password',
        'firstname',
        'othername', 
        'gender_id',
        'oldpassword',
        'last_login',
        'salt',
        'facility_id',
        'telephone',
        'telephone_verified',
        'telephone_verified_at',
        'user_roles_id',
        'mode',
        'email',
        'email_verified',
        'email_verified_at',
        'added_id',
        'added_date',
        'udpated_by',
        'status',
        'archived',
        'archived_id',
        'archived_by',
        'archived_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'salt'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}
