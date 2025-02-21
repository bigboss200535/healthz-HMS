<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentationRepo extends Model
{
    use HasFactory;

    protected $table = 'documentation_repo';
    protected $primaryKey = 'repo_id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing= false;
}
