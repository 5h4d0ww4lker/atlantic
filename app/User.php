<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {

	use Notifiable;
	// use SoftDeletes;
	// use EntrustUserTrait;
	
use SoftDeletes,EntrustUserTrait{
        SoftDeletes::restore as soft_delete_restore;
        EntrustUserTrait::restore as entrust_restore;
    }
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'created_by', 'employee_id','finger_print_id', 'name', 'father_name','grand_father_name', 'mother_name', 'spouse_name', 'email', 'password', 'present_address', 'permanent_address', 'home_district', 'id_name', 'id_number', 'contact_no_one', 'contact_no_two', 'emergency_contact', 'web', 'gender', 'date_of_birth', 'marital_status', 'profile_picture', 'client_type_id', 'designation_id', 'access_label', 'joining_position', 'activation_status', 'academic_qualification', 'professional_qualification', 'experience', 'reference', 'joining_date', 'deletion_status', 'role','profile_picture','cv','tin','department_id','branch_id',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	// protected $hidden = [
	// 	'password', 'remember_token',
	// ];

public function restore()
{
    $this->restoreA();
    $this->restoreB();
}
public function name(){
	$name = $this->name;
	$last_name = $this->father_name;
	$full_name = $name.' '.$last_name;
	return $full_name;
}

public function full_name(){
	$name = $this->name;
	$last_name = $this->father_name;
	$gf_name = $this->grand_father_name;
	$fam_name = $name.' '.$last_name.' '.$gf_name;
	return $fam_name;
}
}
