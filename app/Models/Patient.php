<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient_info';
    protected $primaryKey = 'patient_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'patient_id',
        'title',
        'firstname',
        'middlename',
        'lastname',
        'birth_date',
        'gender_id',
        'age',
        'occupation',
        'education',
        'religion',
        'nationality',
        'old_folder',
        'telephone',
        'work_telephone',
        'email',
        'address',
        'town',
        'region',
        'contact_persion',
        'contact_telephone',
        'contact_relationship',
        'dependant',
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
