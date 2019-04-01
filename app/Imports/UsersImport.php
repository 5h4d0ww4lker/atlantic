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
            'email'    => $row[5], 
            'password'    => $row[6], 
            'present_address'    => $row[7], 
            'permanent_address'    => $row[8], 
            'academic_qualification'    => $row[9], 
            'professional_qualification'    => $row[10], 
            'joining_date'    => $row[11], 
            'experience'    => $row[12], 
            'reference'    => $row[13], 
            'contact_no_one'    => $row[14], 
            'contact_no_two'    => $row[15], 
            'emergency_contact'    => $row[16], 
            'gender'    => $row[17], 
            'date_of_birth'    => $row[18], 
            'marital_status' => $row[19],
            'designation_id' => $row[20],
            'joining_position' => $row[21],
            'access_label' => $row[23],
            'role' => $row[23],
            'cv' => $row[24],
            'profile_picture' => $row[25],
            'activation_status' => $row[26],
            'device_identifier' => $row[27],
            'deletion_status' => $row[28],
            'remember_token' => $row[29],
            'created_at' => $row[30],
            'updated_at' => $row[31],
            'employement_status' => $row[32],
            'tin' => $row[33],
            'branch_id' => $row[34],
            'department_id' => $row[35]        ]);
    }
}
