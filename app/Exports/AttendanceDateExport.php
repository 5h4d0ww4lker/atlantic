<?php

namespace App\Exports;

use App\Attendance;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceDateExport implements FromQuery, WithHeadings,ShouldAutoSize,WithMapping
{
    use Exportable;

    public function __construct(string $start_date = null, string $end_date=null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function query()
    {
        return Attendance::query()->whereBetween('created_at', [$this->start_date, $this->end_date]);
    }

          public function headings(): array
    {
        return [
            'Employee Name',
            'Date',
            'First Check In',
            'First Check In Status',
            'First Check Out',
            'First Check Out Status',
            'Second Check In',
            'Second Check In Status',
            'Second Check Out',
            'Second Check Out Status',
            
        ];
    }

        public function map($attendance): array
    {
        return [
            $attendance->user_id = User::find($attendance->user_id)->full_name(),
            $attendance->attendance_date  = $attendance->attendance_date,
            $attendance->first_check_in  = $attendance->first_check_in ,
            $attendance->first_check_in_status = $attendance->first_check_in_status,
            $attendance->first_check_out = $attendance->first_check_out,
            $attendance->first_check_out_status = $attendance->first_check_out_status,
            $attendance->second_check_in = $attendance->second_check_in,
            $attendance->second_check_in_status = $attendance->second_check_in_status,
            $attendance->second_check_out  = $attendance->second_check_out,
            $attendance->second_check_out_status = $attendance->second_check_out_status,
       
        ];
    }
}

