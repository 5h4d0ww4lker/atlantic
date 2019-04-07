<?php

namespace App\Exports;

use App\Payroll;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;


class PayrollExport implements FromCollection, WithHeadings,WithMapping,ShouldAutoSize
{
    
    public function collection()
    {
        return Payroll::all();
    }
    public function headings(): array
    {
        return [
            'Employee Name',
            'Basic Salary',
            'House Rent Allowance',
            'Medical Allowance',
            'Special Allowance',
            'Provident Fund Cont.',
            'Other Allowance',
            'Tax Deduction',
            'Provident Fund Deduction',
            'Other Deduction',
           
        ];
    }

         public function map($payroll): array
    {
        return [
            $payroll->user_id = User::find($payroll->user_id)->full_name(),
            $payroll->basic_salary = $payroll->basic_salary,
            $payroll->house_rent_allowance = $payroll->house_rent_allowance,
            $payroll->medical_allowance = $payroll->medical_allowance,
            $payroll->special_allowance = $payroll->special_allowance,
            $payroll->provident_fund_contribution = $payroll->provident_fund_contribution,
            $payroll->tax_deduction = $payroll->tax_deduction,
            $payroll->provident_fund_deduction  = $payroll->provident_fund_deduction,
            $payroll->other_deduction  = $payroll->other_deduction ,
            
        ];
    }

}

