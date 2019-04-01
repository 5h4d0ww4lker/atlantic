<?php

namespace App\Exports;
use App\User;
use App\EmployeeAward;
use App\AwardCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeAwardExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmployeeAward::all();
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
