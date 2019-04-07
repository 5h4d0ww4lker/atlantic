<?php

namespace App\Exports;

use App\Bonus;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class BonusDateExport implements FromQuery, WithHeadings,WithMapping,ShouldAutoSize
{
    use Exportable;

    public function __construct(string $start_date = null, string $end_date=null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function query()
    {
        return Bonus::query()->whereBetween('created_at', [$this->start_date, $this->end_date]);
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
            $bonus->user_id = User::find($bonus->user_id)->full_name(),
            $bonus->bonus_name = $bonus->bonus_name,
            $bonus->bonus_month = $bonus->bonus_month,
            $bonus->bonus_amount = $bonus->bonus_amount,
            $bonus->bonus_description = $bonus->bonus_description,
           
           
           

              

        ];
    }
}

