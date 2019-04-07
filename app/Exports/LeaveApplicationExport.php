<?php

namespace App\Exports;
use App\LeaveApplication;
use App\LeaveCategory;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeaveApplicationExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LeaveApplication::all();
    }

     public function headings(): array
    {
        return [
            'Employee Name',
            'Leave Category',
            'Start Date',
            'End Date',
            'Reason',
            'During Leave',
        ];
    }


       public function map($leaveApplication): array
    {
        return [

        
            $leaveApplication->created_by = User::find($leaveApplication->created_by)->full_name(),
            $leaveApplication->leave_category_id = LeaveCategory::find($leaveApplication->leave_category_id)->name(),
            $leaveApplication->start_date = $leaveApplication->start_date,
            $leaveApplication->end_date = $leaveApplication->end_date,
            $leaveApplication->reason  = $leaveApplication->reason,
            $leaveApplication->during_leave  = $leaveApplication->during_leave,
   
        ];
    }
}
