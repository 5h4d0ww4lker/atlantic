<?php

namespace App\Exports;
use App\User;
use App\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoanExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Loan::all();
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
