<?php

namespace App\Exports;

use App\Bonus;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;


class BonusExport implements FromCollection, WithHeadings,WithMapping,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Bonus::all();
    }
   
       public function headings(): array
    {
        return [
            
            'Employee Name',
            'Bonus Name',
            'Bonus Month',
            'Amount',
            'Description',
        ];
    }


       public function map($bonus): array
    {
        return [
            $bonus->user_id = User::find($bonus->user_id)->name(),
            $bonus->bonus_name = $bonus->bonus_name,
            $bonus->bonus_month = $bonus->bonus_month,
            $bonus->bonus_amount = $bonus->bonus_amount,
            $bonus->bonus_description = $bonus->bonus_description,
           
           
           

              

        ];
    }
}
