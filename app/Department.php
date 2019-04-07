<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Department extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'created_by', 'department', 'publication_status', 'department_description'
    ];

    public function department(){
	return $this->department;
}
}
