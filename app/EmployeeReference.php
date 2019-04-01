<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeReference extends Model
{
    protected $fillable = [
        'created_by', 'updated_by', 'created_at', 'updated_at', 'reference_name', 'email', 'contact_no', 'gender', 'deletion_status','address'
    ];
}
