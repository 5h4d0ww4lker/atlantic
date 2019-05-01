<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        return new User([
            'id' => $row[0],
            'created_by' => $row[1],
            'employee_id' => $row[2],
            'name'     => $row[3],
            'father_name'    => $row[4], 
            'grand_father_name'    => $row[5], 
            'email'    => $row[6], 
            'password'    => $row[7], 
            'present_address'    => $row[8], 
            'permanent_address'    => $row[9], 
            'academic_qualification'    => $row[10], 
            'professional_qualification'    => $row[11], 
            'joining_date'    => $row[12], 
            'experience'    => $row[13], 
            'reference'    => $row[14], 
            'contact_no_one'    => $row[15], 
            'contact_no_two'    => $row[16], 
            'emergency_contact'    => $row[17], 
            'gender'    => $row[18], 
            'date_of_birth'    => $row[19], 
            'marital_status' => $row[20],
            'designation_id' => $row[21],
            'joining_position' => $row[22],
            'access_label' => $row[23],
            'role' => $row[24],
            'cv' => $row[25],
            'profile_picture' => $row[26],
            'activation_status' => $row[27],
            'device_identifier' => $row[28],
            'deletion_status' => $row[29],
            'remember_token' => $row[30],
            'created_at' => $row[31],
            'updated_at' => $row[32],
            'employement_status' => $row[33],
            'tin' => $row[34],
            'branch_id' => $row[35],
            'department_id' => $row[36],
            'deleted_at' => $row[37]        ]);
    }
}
