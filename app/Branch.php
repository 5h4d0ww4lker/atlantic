<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	protected $table = 'branchs';
    protected $fillable = [
        'created_by', 'branch', 'publication_status', 'branch_description'
    ];

    public function branch(){
	return $this->branch;
}
}
