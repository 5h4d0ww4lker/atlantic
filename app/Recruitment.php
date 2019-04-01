<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $fillable = [
        'created_by', 'first_name', 'last_name', 'qualification', 'experience','cv','status', 'updated_at','point', 'created_at', 'updated_by'
    ];
}
