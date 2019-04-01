<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'created_by',  'title', 'description','from_date','date_to', 'updated_at', 'created_at', 'updated_at', 'updated_by'
    ];
}
