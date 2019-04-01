<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'created_by', 'employee_id', 'property_name', 'property_description', 'property_identification','deletion_status','status', 'updated_at'
    ];
}
