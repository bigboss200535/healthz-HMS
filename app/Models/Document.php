<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    
    protected $table = 'documents_upload';
    protected $primaryKey = 'documents_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;

    protected $fillable = [
        'documents_id',
        'patient_id',
        'opd_number',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'document_type',
        'mime_type',
        'facility_id',
        'user_id',
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

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
