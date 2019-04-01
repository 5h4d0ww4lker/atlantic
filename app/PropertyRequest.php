<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyRequest extends Model
{
    protected $fillable = [
        'created_by', 'employee_id', 'property_name', 'property_description','deletion_status','status', 'updated_at', 'created_at', 'updated_at', 'updated_by'
    ];
}
