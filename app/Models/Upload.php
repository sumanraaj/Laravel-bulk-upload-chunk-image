<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = ['upload_id', 'original_name', 'checksum', 'completed'];
}
