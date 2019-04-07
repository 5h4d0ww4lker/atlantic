<?php

namespace App\Exports;

use App\Loan;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoanDateExport implements FromQuery,WithHeadings,WithMapping,ShouldAutoSize
{
    use Exportable;

    public function __construct(string $start_date = null, string $end_date=null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function query()
    {
        return Loan::query()->whereBetween('created_at', [$this->start_date, $this->end_date]);
    }
 public function headings(): array
    {
        return [
            'Employee Name',
            'Loan Name',
            'Amount',
            'Number of Installment',
            'Remaining  Inst',
            'Loan Description',
            
        ];
    }
          public function map($loan): array
    {
        return [
            $loan->user_id  = User::find($loan->user_id )->full_name(),
            $loan->loan_name = $loan->loan_name,
            $loan->loan_amount  = $loan->loan_amount,
            $loan->number_of_installments = $loan->number_of_installments,
            $loan->remaining_installments = $loan->remaining_installments,
            $loan->loan_description = $loan->loan_description,
            
        ];
    }

}

