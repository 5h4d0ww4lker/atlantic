<?php

namespace App\Exports;

use App\User;
use App\Designation;
use App\Department;
use App\Branch;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersDateExport implements FromQuery,WithHeadings,ShouldAutoSize,WithMapping
{
    use Exportable;

    public function __construct(string $start_date = null, string $end_date=null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function query()
    {
        return User::query()->whereBetween('created_at', [$this->start_date, $this->end_date]);
    }

     public function headings(): array
    {
        return [
            
            
            'Employee Id',
            'Name',
            'Father Name',
            'Grand Father Name',
            'Gender',
            'Email',
            'Designation',
            'Joining Position',
            'Branch',
            'Department',
            'Permanent Address',
            'Present Address',
            'Academic Qualification',
            'Professional Qualification',
            'Experience',
            'Joining Date',
            'Contact No One',
            'DOB',
            'TIN',
            'Employement Status',
            
        ];
    }

       public function map($user): array
    {
        return [
            $user->employee_id = $user->employee_id,
            $user->name = $user->name,
            $user->father_name = $user->father_name,
             $user->grand_father_name = $user->grand_father_name,
            $user->gender = $user->gender,
            $user->email = $user->email,
            $user->designation_id = Designation::find($user->designation_id)->designation(),
            $user->joining_position = Designation::find($user->joining_position)->designation(),
            $user->department_id = Department::find($user->department_id)->department(),
            $user->branch_id = Branch::find($user->branch_id)->branch(),
            $user->permanent_address = $user->permanent_address,
            $user->present_address = $user->present_address,
            $user->academic_qualification = $user->academic_qualification,
            $user->proffessional_qualification = $user->proffessional_qualification,
            $user->experience = $user->experience,
            $user->joining_date = $user->joining_date,
            $user->contact_no_one = $user->contact_no_one,
            $user->date_of_birth = $user->date_of_birth,
            $user->tin = $user->tin,
            $user->employement_status = $user->employement_status,
           

              

        ];
    }
}

