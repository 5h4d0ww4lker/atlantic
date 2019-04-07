<?php

namespace App\Exports;

use App\LeaveApplication;
use App\LeaveCategory;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeaveApplicationDateExport implements FromQuery,WithHeadings,ShouldAutoSize,WithMapping
{
    use Exportable;

    public function __construct(string $start_date = null, string $end_date=null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function query()
    {
        return LeaveApplication::query()->whereBetween('created_at', [$this->start_date, $this->end_date]);
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

