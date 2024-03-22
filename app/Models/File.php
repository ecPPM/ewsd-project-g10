<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id',
        'fileable_type',
        'fileable_id',
        'name',
        'path'
    ];
}
