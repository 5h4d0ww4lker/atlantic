<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    protected $fillable = [
        'created_by', 'user_id', 'dependent_name', 'relationship', 'deletion_status', 'profile_picture'
    ];
}
