<?php

   

namespace App\Http\Controllers;

  

use Illuminate\Http\Request;

use App\Exports\UsersExport;
use App\Exports\UsersDateExport;

use App\Exports\AttendanceExport;
use App\Exports\AttendanceDateExport;

use App\Exports\BonusExport;
use App\Exports\BonusDateExport;

use App\Exports\EmployeeAwardExport;
use App\Exports\EmployeeAwardDateExport;

use App\Exports\LeaveApplicationExport;
use App\Exports\LeaveApplicationDateExport;

use App\Exports\LoanExport;
use App\Exports\LoanDateExport;

use App\Exports\NoticeExport;
use App\Exports\NoticeDateExport;

use App\Exports\PayrollExport;
use App\Exports\PayrollDateExport;

use App\Imports\UsersImport;

use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\EmployeeAward;
use App\Loan;
use App\LeaveApplication;
use App\Bonus;
use App\Attendance;
use App\Payroll;
use App\Notice;
use DB;
use PDF;
use Session;
  

class ReportsController extends Controller

{
    public function __construct(Request $request)
  {
    
     $this->usersDateExportes= new \App\Exports\UsersDateExport;
  }

    public function generateEmployeesReportPDF()

    {

        $employees = User::all();

        foreach ($employees as $employee) {
	$message = app('App\Http\Controllers\EmployeeController')->pdf($employee->id);;

      }

    }


    public function employeesPDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $employees = User::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])
        ->get();

        }
        else
        {
         $employees = User::where('deletion_status', 0)
        ->get();
        }  

          $pdf = PDF::loadView('administrator.report.employee_pdf',['employees' => $employees] );
          $file_name = 'employees.pdf';
          return $pdf->download($file_name);
        }
 

        public function employeePDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $employees = User::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])
        ->get();

        }
        else
        {
         $employees = User::where('deletion_status', 0)
        ->get();
        }  

        foreach ($employees as $employee) {
          $id = $employee->id;
          $employee = DB::table('users')
          ->join('designations', 'users.designation_id', '=', 'designations.id')
          ->select('users.*', 'designations.designation')
          ->where('users.id', $id)
          ->first();
          $designations = DB::table('designations')->where('id', $employee->designation_id)->first();
 
          $pdf = PDF::loadView('administrator.report.employee_pdf',['employee' => $employee,'designations'=>$designations] );
          $file_name = 'EMP-' . $employee->id . '.pdf';
          return $pdf->download($file_name);
        }
     
     
    }

        public function employeesExcel(Request $request) 

    {
        
       
       if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        return (new UsersDateExport($start_date, $end_date))->download('employees.xlsx');
       }
       
       else
        {
             return Excel::download(new UsersExport, 'employees.xlsx');

        }
    }


    //Salary

        public function salaryPDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $salaries = Payroll::whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $salaries = Payroll::all();
        }  

          $pdf = PDF::loadView('administrator.report.salary_pdf',['salaries' => $salaries] );
          $file_name = 'salaries.pdf';
          return $pdf->download($file_name);
       
     
     
    }


      public function salaryPrint(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $salaries = Payroll::whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $salaries = Payroll::all();
        }  

        
          return  view('administrator.report.salary_print', compact('salaries'));;
       
     
     
    }

        public function salaryExcel(Request $request) 

    {
        
       
       if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        return (new PayrollDateExport($start_date, $end_date))->download('salary.xlsx');
       }
       
       else
        {    
              $start_date = date_create("2013-03-15");
              $start_date = date_format($start_date,"Y-m-d");
              $end_date = date_create("2023-03-15");
              $end_date = date_format($end_date,"Y-m-d");
             return (new PayrollDateExport($start_date, $end_date))->download('salary.xlsx');

        }
    }



    //Bonus

        public function bonusPDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $bonuses = Bonus::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $bonuses = Bonus::where('deletion_status', 0)
        ->get();
        }  

       
          $pdf = PDF::loadView('administrator.report.bonus_pdf',['bonuses' => $bonuses] );
          $file_name = 'bonus.pdf';
          return $pdf->download($file_name);
     
     
     
    }

          public function bonusPrint(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $bonuses = Bonus::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $bonuses = Bonus::where('deletion_status', 0)
        ->get();
        }  

       
          return  view('administrator.report.bonus_print', compact('bonuses'));
     
     
     
    }

        public function bonusExcel(Request $request) 

    {
        
       
       if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        return (new BonusDateExport($start_date, $end_date))->download('bonus.xlsx');
       }
       
       else
        {
             return Excel::download(new BonusExport, 'bonus.xlsx');

        }
    }


   //Loan

        public function loanPDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $loans = Loan::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $loans = Loan::where('deletion_status', 0)
        ->get();
        }  

      
          $pdf = PDF::loadView('administrator.report.loan_pdf',['loans' => $loans] );
          $file_name = 'loan.pdf';
          return $pdf->download($file_name);
     
     
     
    }


         public function loanPrint(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $loans = Loan::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $loans = Loan::where('deletion_status', 0)
        ->get();
        }  

      
     return  view('administrator.report.loan_print', compact('loans'));
     
     
     
    }

        public function loanExcel(Request $request) 

    {
        
       
       if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        return (new LoanDateExport($start_date, $end_date))->download('loan.xlsx');
       }
       
       else
        {
             return Excel::download(new LoanExport, 'loan.xlsx');

        }
    }

   //Attendance

        public function attendancePDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $salaries = SalaryPayement::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $salaries = SalaryPayement::where('deletion_status', 0)
        ->get();
        }  

        foreach ($employees as $employee) {
          $id = $employee->id;
          $employee = DB::table('users')
          ->join('designations', 'users.designation_id', '=', 'designations.id')
          ->select('users.*', 'designations.designation')
          ->where('users.id', $id)
          ->first();
          $designations = DB::table('designations')->where('id', $employee->designation_id)->first();
 
          $pdf = PDF::loadView('administrator.report.employee_pdf',['employee' => $employee,'designations'=>$designations] );
          $file_name = 'EMP-' . $employee->id . '.pdf';
          return $pdf->download($file_name);
        }
     
     
    }

        public function attendanceExcel(Request $request) 

    {
        
       
       if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        return (new AttendanceDateExport($start_date, $end_date))->download('attendance.xlsx');
       }
       
       else
        {
             return Excel::download(new AttendanceExport, 'attendance.xlsx');

        }
    }

   //Bonus

        public function awardPDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $employee_awords = EmployeeAward::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $employee_awords = EmployeeAward::where('deletion_status', 0)
        ->get();
        }  

    
          $pdf = PDF::loadView('administrator.report.award_pdf',['employee_awords' => $employee_awords] );
          $file_name = 'award.pdf';
          return $pdf->download($file_name);
      
     
     
    }

         public function awardPrint(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $employee_awords = EmployeeAward::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $employee_awords = EmployeeAward::where('deletion_status', 0)
        ->get();
        }  

    
         return  view('administrator.report.award_print', compact('employee_awords'));
      
     
     
    }

        public function awardExcel(Request $request) 

    {
        
       
       if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        return (new EmployeeAwardDateExport($start_date, $end_date))->download('award.xlsx');
       }
       
       else
        {
             return Excel::download(new EmployeeAwardExport, 'award.xlsx');

        }
    }

       //Leave

        public function leavePDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $leave_applications = LeaveApplication::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $leave_applications = LeaveApplication::where('deletion_status', 0)
        ->get();
        }  


          $pdf = PDF::loadView('administrator.report.leave_pdf',['leave_applications' => $leave_applications] );
          $file_name = 'leave_applications.pdf';
          return $pdf->download($file_name);
    }


       public function leavePrint(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $leave_applications = LeaveApplication::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $leave_applications = LeaveApplication::where('deletion_status', 0)
        ->get();
        }  


         return  view('administrator.report.leave_print', compact('leave_applications'));
    }

       //Leave

        public function attendance2PDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $attendances = Attendance::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $attendances = Attendance::where('deletion_status', 0)
        ->get();
        }  

       
          $pdf = PDF::loadView('administrator.report.attendance_pdf',['attendances' => $attendances] );
          $file_name = 'attendances.pdf';
          return $pdf->download($file_name);
    }

          public function attendancePrint(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $attendances = Attendance::whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $attendances = Attendance::all();
        }  

       
           return  view('administrator.report.attendance_print', compact('attendances'));
    }

        public function leaveExcel(Request $request) 

    {
        
       
       if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        return (new LeaveApplicationDateExport($start_date, $end_date))->download('leave.xlsx');
       }
       
       else
        {
             return Excel::download(new LeaveApplicationExport, 'leave.xlsx');

        }
    }

   //Bonus

        public function noticePDF(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $notices = Notice::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $notices = Notice::where('deletion_status', 0)
        ->get();
        }  

          $pdf = PDF::loadView('administrator.report.notice_pdf',['notices' => $notices] );
          $file_name = 'notice.pdf';
          return $pdf->download($file_name);
      
     
     
    }


        public function noticePrint(Request $request)
    {
  
      if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        $notices = Notice::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();

        }
        else
        {
         $notices = Notice::where('deletion_status', 0)
        ->get();
        }  

          return  view('administrator.report.notice_print', compact('notices'));;
       
      
     
     
    }

        public function noticeExcel(Request $request) 

    {
        
       
       if (Session::has('start_date') && Session::has('end_date'))
        {
        $start_date = Session::get('start_date'); 
        $end_date = Session::get('end_date'); 
        return (new NoticeDateExport($start_date, $end_date))->download('notice.xlsx');
       }
       
       else
        {
             return Excel::download(new NoticeExport, 'notice.xlsx');

        }
    }

    public function importExportView()

    {

       return view('import');

    }



   


    public function import() 

    {

        Excel::import(new UsersImport,request()->file('file'));

           

        return back();

    }

}

