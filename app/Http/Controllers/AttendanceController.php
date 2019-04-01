<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Holiday;
use App\LeaveCategory;
use App\User;
use App\WorkingDay;
use Illuminate\Http\Request;
use Session;

class AttendanceController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('administrator.hrm.attendance.manage_attendance');
	}


	public function daily(Request $request) {

		   $request->session()->forget('start_date'); 
            $request->session()->forget('end_date');  

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            Session::put('start_date', $start_date);
            Session::put('end_date', $end_date);
		$attendances = Attendance::whereBetween('created_at', [$start_date, $end_date])->get();

	}

	else
	{
	$attendances = Attendance::all();
	}
		return view('administrator.hrm.attendance.daily', compact('attendances'));

	}

	public function check_in_check_out() {
		return view('administrator.hrm.attendance.check_in_check_out');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function set_attendance(Request $request) {
		$attendance_day = date("D", strtotime($request->date));

		$weekly_holidays = WorkingDay::where('working_status', 0)
			->get(['day'])
			->toArray();

		$monthly_holidays = Holiday::where('date', '=', $request->date)
			->first(['date']);

		if ($monthly_holidays['date'] == $request->date) {
			return redirect('/hrm/attendance/manage')->with('exception', 'You select a holiday !');
		}

		foreach ($weekly_holidays as $weekly_holiday) {
			if ($attendance_day == $weekly_holiday['day']) {
				return redirect('/hrm/attendance/manage')->with('exception', 'You select a holiday !');
			}
		}

		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();

		$leave_categories = LeaveCategory::get()
			->where('deletion_status', 0)
			->toArray();
		$date = $request->date;

		$attendances = Attendance::where('attendance_date', $date)
			->get()
			->toArray();

		if (empty($attendances)) {
			return view('administrator.hrm.attendance.set_attendance', compact('employees', 'leave_categories', 'date'));
		}
		return view('administrator.hrm.attendance.edit_attendance', compact('employees', 'leave_categories', 'date', 'attendances'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		for ($i = 0; $i < count($request->user_id); $i++) {
			Attendance::create([
				'created_by' => auth()->user()->id,
				'user_id' => $request->user_id[$i],
				'attendance_date' => $request->attendance_date[$i],
				'attendance_status' => $request->attendance_status[$i],
				'leave_category_id' => $request->leave_category_id[$i],
				'check_in' => $request->check_in[$i],
				'check_out' => $request->check_out[$i],
			]);
		}
		return redirect('/hrm/attendance/manage')->with('message', 'Add successfully.');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request) {
		for ($i = 0; $i < count($request->user_id); $i++) {
			$attendance = Attendance::find($request->attendance_id[$i]);
			$attendance->user_id = $request->user_id[$i];
			$attendance->attendance_date = $request->attendance_date[$i];
			$attendance->attendance_status = $request->attendance_status[$i];
			$attendance->leave_category_id = $request->leave_category_id[$i];
			$attendance->check_in = $request->check_in[$i];
			$attendance->check_out = $request->check_out[$i];
			$affected_row = $attendance->save();
		}
		return redirect('/hrm/attendance/manage')->with('message', 'Update successfully.');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function report() {
		return view('administrator.hrm.attendance.report');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function get_report(Request $request) {
		$date = $request->date;
		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));

		$number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		$attendances = Attendance::query()
			->leftjoin('leave_categories as leave', 'attendances.leave_category_id', '=', 'leave.id')
			->whereYear('attendances.attendance_date', '=', $year)
			->whereMonth('attendances.attendance_date', '=', $month)
			->get(['attendances.*', 'leave.leave_category'])
			->toArray();

		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();

		$weekly_holidays = WorkingDay::where('working_status', 0)
			->get()
			->toArray();

		$monthly_holidays = Holiday::whereYear('date', '=', $year)
			->whereMonth('date', '=', $month)
			->get(['date', 'holiday_name'])
			->toArray();

		return view('administrator.hrm.attendance.get_report', compact('date', 'attendances', 'employees', 'number_of_days', 'weekly_holidays', 'monthly_holidays'));
	}

	public function first_check_in(Request $request)
	{
//check IP 
//check if same ip / new
//compare date
//check  hollidays, weekends and leaves	
//store cokies		

			$user_id = auth()->user()->id;
			$user = User::where('id', $user_id)->firstOrFail();
			$device_identifier = $user->device_identifier;
			$incoming_device = $request->cookie('computer_id');

			if ($device_identifier != $incoming_device) {
			return redirect('/hrm/attendance/check_in_check_out')->with('error', 'Unable to checkin or out');
			}

			$date = date("Y-m-d");
			$check_in_time = date("H:i:s");
			

			if ($check_in_time <= "2:30:00") {
				$first_check_in_status = "On Time";
			}

			if ($check_in_time > "6:30:00") {
				$first_check_in_status = "Late Arrival";
			}
			$user_id = auth()->user()->id;
			$attendance = Attendance::where('user_id', $user_id)->where('attendance_date', $date)->first();

			$exists = count($attendance);


			if ($exists > 0) {

				if ($attendance->first_check_in != null) {
					return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You already checked in.');
				}
				else{
				$attendance_id = $attendance->id;
				$update_attendance = Attendance::where('id', $attendance_id)->firstOrFail();
				$update_attendance->first_check_in = $check_in_time;
				$update_attendance->first_check_in_status = $first_check_in_status;
				$update_attendance->created_by = $user_id;
				$update_attendance->ip_address = $ip;
				$update_attendance->save();
				return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You checked in successfully.');
			
				}
		}

			else
			{
			$attendance = new Attendance();
			$attendance->user_id = $user_id;
			$attendance->created_by = $user_id;	
			$attendance->attendance_date = $date;
			$attendance->first_check_in = $check_in_time;
			$attendance->first_check_in_status = $first_check_in_status;
			$attendance->ip_address = $ip;
			$attendance = $attendance->save();

			return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You checked in successfully.');
			}
			
	}

	public function first_check_out(Request $request)
	{		
			$user_id = auth()->user()->id;
			$user = User::where('id', $user_id)->firstOrFail();
			$device_identifier = $user->device_identifier;
			$incoming_device = $request->cookie('computer_id');

			if ($device_identifier != $incoming_device) {
			return redirect('/hrm/attendance/check_in_check_out')->with('error', 'Unable to checkin or out');
			}

			$date = date("Y-m-d");
			$check_out_time = date("H:i:s");
			$ip = $request->ip();


			if ($check_out_time < "6:30:00") {
				$first_check_out_status = "Early Departure";
			}

			if ($check_out_time >= "6:30:00") {
				$first_check_out_status = "On Time";
			}
			$user_id = auth()->user()->id;
			$attendance = Attendance::where('user_id', $user_id)->where('attendance_date', $date)->first();

			$exists = count($attendance);


			if ($exists > 0) {

				if ($attendance->first_check_out != null) {
					return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You already checked out.');
				}
				else{
				$attendance_id = $attendance->id;
				$update_attendance = Attendance::where('id', $attendance_id)->firstOrFail();
				$update_attendance->first_check_out = $check_out_time;
				$update_attendance->first_check_out_status = $first_check_out_status;
				$update_attendance->created_by = $user_id;
				$update_attendance->ip_address = $ip;
				$update_attendance->save();
				return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You checked out successfully.');
			
				}
		}

			else
			{
			$attendance = new Attendance();
			$attendance->user_id = $user_id;
			$attendance->created_by = $user_id;	
			$attendance->attendance_date = $date;
			$attendance->first_check_out = $check_out_time;
			$attendance->first_check_out_status = $first_check_out_status;
			$attendance->ip_address = $ip;
			$attendance = $attendance->save();

			return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You checked out successfully.');
			}
			
	}



		public function second_check_in(Request $request)
	{
//check IP
//check if same ip / new
//compare date
//check  hollidays, weekends and leaves	

			$user_id = auth()->user()->id;
			$user = User::where('id', $user_id)->firstOrFail();
			$device_identifier = $user->device_identifier;
			$incoming_device = $request->cookie('computer_id');

			if ($device_identifier != $incoming_device) {
			return redirect('/hrm/attendance/check_in_check_out')->with('error', 'Unable to checkin or out');
			}


			$date = date("Y-m-d");
			$check_in_time = date("H:i:s");
			$ip = $request->ip();


			if ($check_in_time <= "7:30:00") {
				$second_check_in_status = "On Time";
			}

			if ($check_in_time > "7:30:00") {
				$second_check_in_status = "Late Arrival";
			}
			$user_id = auth()->user()->id;
			$attendance = Attendance::where('user_id', $user_id)->where('attendance_date', $date)->first();

			$exists = count($attendance);


			if ($exists > 0) {

				if ($attendance->second_check_in != null) {
					return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You already checked in.');
				}
				else{
				$attendance_id = $attendance->id;
				$update_attendance = Attendance::where('id', $attendance_id)->firstOrFail();
				$update_attendance->second_check_in = $check_in_time;
				$update_attendance->second_check_in_status = $second_check_in_status;
				$update_attendance->created_by = $user_id;
				$update_attendance->ip_address = $ip;
				$update_attendance->save();
				return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You checked in successfully.');
			
				}
		}

			else
			{
			$attendance = new Attendance();
			$attendance->user_id = $user_id;
			$attendance->created_by = $user_id;	
			$attendance->attendance_date = $date;
			$attendance->second_check_in = $check_in_time;
			$attendance->second_check_in_status = $second_check_in_status;
			$attendance->ip_address = $ip;
			$attendance = $attendance->save();

			return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You checked in successfully.');
			}
			
	}

	public function second_check_out(Request $request)
	{		

			$user_id = auth()->user()->id;
			$user = User::where('id', $user_id)->firstOrFail();
			$device_identifier = $user->device_identifier;
			$incoming_device = $request->cookie('computer_id');

			if ($device_identifier != $incoming_device) {
			return redirect('/hrm/attendance/check_in_check_out')->with('error', 'Unable to checkin or out');
			}

			
			$date = date("Y-m-d");
			$check_out_time = date("H:i:s");
			$ip = $request->ip();


			if ($check_out_time < "11:30:00") {
				$second_check_out_status = "Early Departure";
			}

			if ($check_out_time >= "11:30:00") {
				$second_check_out_status = "On Time";
			}
			$user_id = auth()->user()->id;
			$attendance = Attendance::where('user_id', $user_id)->where('attendance_date', $date)->first();

			$exists = count($attendance);


			if ($exists > 0) {

				if ($attendance->second_check_out != null) {
					return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You already checked out.');
				}
				else{
				$attendance_id = $attendance->id;
				$update_attendance = Attendance::where('id', $attendance_id)->firstOrFail();
				$update_attendance->second_check_out = $check_out_time;
				$update_attendance->second_check_out_status = $second_check_out_status;
				$update_attendance->created_by = $user_id;
				$update_attendance->ip_address = $ip;
				$update_attendance->save();
				return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You checked out successfully.');
			
				}
		}

			else
			{
			$attendance = new Attendance();
			$attendance->user_id = $user_id;
			$attendance->created_by = $user_id;	
			$attendance->attendance_date = $date;
			$attendance->second_check_out = $check_out_time;
			$attendance->second_check_out_status = $second_check_out_status;
			$attendance->ip_address = $ip;
			$attendance = $attendance->save();

			return redirect('/hrm/attendance/check_in_check_out')->with('message', 'You checked out successfully.');
			}
			
	}
}
