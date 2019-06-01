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

    $this->usersDateExportes = new \App\Exports\UsersDateExport;
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

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $employees = User::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])
        ->get();
    } else {
      $employees = User::where('deletion_status', 0)
        ->get();
    }

    $pdf = PDF::loadView('administrator.report.employee_pdf', ['employees' => $employees]);
    $file_name = 'employees.pdf';
    return $pdf->download($file_name);
  }


  public function employeePDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $employees = User::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])
        ->get();
    } else {
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

      $pdf = PDF::loadView('administrator.report.employee_pdf', ['employee' => $employee, 'designations' => $designations]);
      $file_name = 'EMP-' . $employee->id . '.pdf';
      return $pdf->download($file_name);
    }
  }

  public function employeesExcel(Request $request)

  {


    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      return (new UsersDateExport($start_date, $end_date))->download('employees.xlsx');
    } else {
      return Excel::download(new UsersExport, 'employees.xlsx');
    }
  }


  //Salary

  public function salaryPDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $salaries = Payroll::whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $salaries = Payroll::all();
    }

    $pdf = PDF::loadView('administrator.report.salary_pdf', ['salaries' => $salaries]);
    $file_name = 'salaries.pdf';
    return $pdf->download($file_name);
  }


  public function salaryPrint(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $salaries = Payroll::whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $salaries = Payroll::all();
    }


    return  view('administrator.report.salary_print', compact('salaries'));;
  }

  public function salaryExcel(Request $request)

  {


    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      return (new PayrollDateExport($start_date, $end_date))->download('salary.xlsx');
    } else {
      $start_date = date_create("2013-03-15");
      $start_date = date_format($start_date, "Y-m-d");
      $end_date = date_create("2023-03-15");
      $end_date = date_format($end_date, "Y-m-d");
      return (new PayrollDateExport($start_date, $end_date))->download('salary.xlsx');
    }
  }



  //Bonus

  public function bonusPDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $bonuses = Bonus::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $bonuses = Bonus::where('deletion_status', 0)
        ->get();
    }


    $pdf = PDF::loadView('administrator.report.bonus_pdf', ['bonuses' => $bonuses]);
    $file_name = 'bonus.pdf';
    return $pdf->download($file_name);
  }

  public function bonusPrint(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $bonuses = Bonus::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $bonuses = Bonus::where('deletion_status', 0)
        ->get();
    }


    return  view('administrator.report.bonus_print', compact('bonuses'));
  }

  public function bonusExcel(Request $request)

  {


    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      return (new BonusDateExport($start_date, $end_date))->download('bonus.xlsx');
    } else {
      return Excel::download(new BonusExport, 'bonus.xlsx');
    }
  }


  //Loan

  public function loanPDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $loans = Loan::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $loans = Loan::where('deletion_status', 0)
        ->get();
    }


    $pdf = PDF::loadView('administrator.report.loan_pdf', ['loans' => $loans]);
    $file_name = 'loan.pdf';
    return $pdf->download($file_name);
  }


  public function loanPrint(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $loans = Loan::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $loans = Loan::where('deletion_status', 0)
        ->get();
    }


    return  view('administrator.report.loan_print', compact('loans'));
  }

  public function loanExcel(Request $request)

  {


    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      return (new LoanDateExport($start_date, $end_date))->download('loan.xlsx');
    } else {
      return Excel::download(new LoanExport, 'loan.xlsx');
    }
  }

  //Attendance

  public function attendancePDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $salaries = SalaryPayement::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
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

      $pdf = PDF::loadView('administrator.report.employee_pdf', ['employee' => $employee, 'designations' => $designations]);
      $file_name = 'EMP-' . $employee->id . '.pdf';
      return $pdf->download($file_name);
    }
  }

  public function attendanceExcel(Request $request)

  {


    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      return (new AttendanceDateExport($start_date, $end_date))->download('attendance.xlsx');
    } else {
      return Excel::download(new AttendanceExport, 'attendance.xlsx');
    }
  }

  //Bonus

  public function awardPDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $employee_awords = EmployeeAward::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $employee_awords = EmployeeAward::where('deletion_status', 0)
        ->get();
    }


    $pdf = PDF::loadView('administrator.report.award_pdf', ['employee_awords' => $employee_awords]);
    $file_name = 'award.pdf';
    return $pdf->download($file_name);
  }

  public function awardPrint(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $employee_awords = EmployeeAward::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $employee_awords = EmployeeAward::where('deletion_status', 0)
        ->get();
    }


    return  view('administrator.report.award_print', compact('employee_awords'));
  }

  public function awardExcel(Request $request)

  {


    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      return (new EmployeeAwardDateExport($start_date, $end_date))->download('award.xlsx');
    } else {
      return Excel::download(new EmployeeAwardExport, 'award.xlsx');
    }
  }

  //Leave

  public function leavePDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $leave_applications = LeaveApplication::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $leave_applications = LeaveApplication::where('deletion_status', 0)
        ->get();
    }


    $pdf = PDF::loadView('administrator.report.leave_pdf', ['leave_applications' => $leave_applications]);
    $file_name = 'leave_applications.pdf';
    return $pdf->download($file_name);
  }


  public function leavePrint(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $leave_applications = LeaveApplication::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $leave_applications = LeaveApplication::where('deletion_status', 0)
        ->get();
    }


    return  view('administrator.report.leave_print', compact('leave_applications'));
  }

  //Leave

  public function attendance2PDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $attendances = Attendance::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $attendances = Attendance::where('deletion_status', 0)
        ->get();
    }


    $pdf = PDF::loadView('administrator.report.attendance_pdf', ['attendances' => $attendances]);
    $file_name = 'attendances.pdf';
    return $pdf->download($file_name);
  }

  public function attendancePrint(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $attendances = Attendance::whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $attendances = Attendance::all();
    }


    return  view('administrator.report.attendance_print', compact('attendances'));
  }

  public function leaveExcel(Request $request)

  {


    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      return (new LeaveApplicationDateExport($start_date, $end_date))->download('leave.xlsx');
    } else {
      return Excel::download(new LeaveApplicationExport, 'leave.xlsx');
    }
  }

  //Bonus

  public function noticePDF(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $notices = Notice::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $notices = Notice::where('deletion_status', 0)
        ->get();
    }

    $pdf = PDF::loadView('administrator.report.notice_pdf', ['notices' => $notices]);
    $file_name = 'notice.pdf';
    return $pdf->download($file_name);
  }


  public function noticePrint(Request $request)
  {

    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      $notices = Notice::where('deletion_status', 0)
        ->whereBetween('created_at', [$start_date, $end_date])->get();
    } else {
      $notices = Notice::where('deletion_status', 0)
        ->get();
    }

    return  view('administrator.report.notice_print', compact('notices'));;
  }

  public function noticeExcel(Request $request)

  {


    if (Session::has('start_date') && Session::has('end_date')) {
      $start_date = Session::get('start_date');
      $end_date = Session::get('end_date');
      return (new NoticeDateExport($start_date, $end_date))->download('notice.xlsx');
    } else {
      return Excel::download(new NoticeExport, 'notice.xlsx');
    }
  }

  public function importExportView()

  {

    return view('import');
  }

  public function attendanceImportView()

  {

    return view('importAttendance');
  }








  public function import()

  {

    Excel::import(new UsersImport, request()->file('file'));



    return back();
  }

  public function importAttendance(Request $request)

  {
    $file = $request->file('file');
    foreach (file($file) as $line) {
      $stripped = preg_replace('/\s+/', ' ', $line);
      $parts = preg_split('/\s+/', $stripped);
      $date = $parts[1];
      $time = $parts[2];

      $finger_print_id = $parts[5];
      $user = User::where('finger_print_id', $finger_print_id)->first();
      $user_id = $user->id;

     


     

      $time = date('h:i:s', strtotime($time));
      $date = date("Y-m-d", strtotime($date));
      


      $first_in_start = "02:00:00";
      $first_in_end = "05:00:00";
      $first_out_start = "05:30:00";
      $first_out_end = "07:00:00";
      $second_in_start = "07:00:00";
      $second_in_end = "09:00:00";
      $second_out_start = "10:00:00";
      $second_out_end = "11:59:00";

      $after_noon_start = "06:00:00";
      $after_noon_end = "11:50:00";
      $first_in_limit = "02:30:00";
      $first_out_limit = "06:30:00";
      $second_in_limit = "07:30:00";
      $second_out_limit = "11:30:00";


      $after_noon_start = date('h:i:s', strtotime($after_noon_start));
      $after_noon_end = date('h:i:s', strtotime($after_noon_end));
      $first_in_limit = date('h:i:s', strtotime($first_in_limit));
      $first_out_limit = date('h:i:s', strtotime($first_out_limit));
      $second_in_limit = date('h:i:s', strtotime($second_in_limit));
      $second_out_limit = date('h:i:s', strtotime($second_out_limit));


      $attendance = new Attendance();

      $attendance->user_id = $user_id;
      $attendance->attendance_date = $date;
      $attendance->created_by = auth()->user()->id;

      if ($time > $first_in_start && $time < $first_in_end) {

        $attendance->first_check_in = $time;

        if ($time < $first_in_limit) {
          $attendance->first_check_in_status = "On Time";
        } else {
          $attendance->first_check_in_status = "Late Arrival";
        }
      }

      if ($time > $first_out_start && $time < $first_out_end) {

        $attendance->first_check_out = $time;

        if ($time > $first_out_limit) {
          $attendance->first_check_in_status = "On Time";
        } else {
          $attendance->first_check_out_status = "Early Departure";
        }
      }


      if ($time > $second_in_start && $time < $second_in_end) {

        $attendance->second_check_in = $time;

        if ($time < $second_in_limit) {
          $attendance->second_check_in_status = "On Time";
        } else {
          $attendance->second_check_in_status = "Late Arrival";
        }
      }

      if ($time > $second_out_start && $time < $second_out_end) {

        $attendance->second_check_out = $time;

        if ($time > $second_out_limit) {
          $attendance->second_check_in_status = "On Time";
        } else {
          $attendance->second_check_out_status = "Early Departure";
        }
      }
      $attendance->save();
    }
  }
}
