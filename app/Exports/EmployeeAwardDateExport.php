<?php

namespace App\Exports;

use App\EmployeeAward;
use App\AwardCategory;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeAwardDateExport implements FromQuery,WithHeadings,WithMapping,ShouldAutoSize
{
    use Exportable;

    public function __construct(string $start_date = null, string $end_date=null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function query()
    {
        return EmployeeAward::query()->whereBetween('created_at', [$this->start_date, $this->end_date]);
    }

     public function headings(): array
    {
        return [
            
            'Employee Name',
            'Award Category',
            'Gift Item',
            'Month',
            'Description',
            
        ];
    }


       public function map($award): array
    {
        return [
            $award->employee_id = User::find($award->employee_id)->name(),
            $award->award_category_id = AwardCategory::find($award->award_category_id)->name(),
            $award->gift_item = $award->gift_item,
            $award->select_month = $award->select_month,
            $award->description = $award->description,
   
        ];
    }
}

