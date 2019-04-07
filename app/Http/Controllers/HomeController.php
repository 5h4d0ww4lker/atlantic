<?php

namespace App\Http\Controllers;

use App\File;
use App\PersonalEvent;
use App\User;
use App\Department;
use App\Designation;
use App\Branch;
use App\LeaveApplication;
use App\Loan;
use App\Holiday;
use App\Property;
use App\EmployeeAward;
use App\Notice;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cookie;
use Charts;
use Calendar;
use DB;

class HomeController extends Controller {

/**
 * Create a new controller instance.
 *
 * @return void
 */
	public function __construct() {
		$this->middleware('auth');
	}

/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */

public  function index(Request $request)
{
		if(Cookie::has('computer_id')){
 		
 		$computer_id = $request->cookie('computer_id');
 		return $this->con();
 		}
     	if(Cookie::get('computer_id') === null)
     	{
     	$minutes = 1051200;
     	$random = substr(md5(mt_rand()), 0,7);
     	$user_id = auth()->user()->id;

     	$user = User::where('id',$user_id)->first();

     	$device_id = $user->device_identifier;

     	if($device_id == null){
     		$user->device_identifier = $random;
     		$user->save();
     	}

		return response($this->con())->cookie('computer_id', $random, $minutes);
    	}
}
	public function con() {

 		


		$today = Carbon\Carbon::now();
		$date_today = $today->toDateString();

		$personal_events = PersonalEvent::query()
			->leftjoin('users as users', 'users.id', '=', 'personal_events.created_by')
			->orderBy('personal_events.start_date', 'ASC')
			->where('personal_events.deletion_status', 0)
			->where('personal_events.start_date', '>=', $date_today)
			->get([
				'personal_events.*',
				'users.name',
			]);

		$clients = User::where('access_label', 5)
			->where('deletion_status', 0)
			->get();

		$references = User::where('access_label', 4)
			->where('deletion_status', 0)
			->get();

		$employees = User::where('access_label', '>=', 2)
			->where('access_label', '<=', 3)
			->where('deletion_status', 0)
			->get();

		$files = File::where('deletion_status', 0)
			->get();
		$departments = Department::where('deletion_status', 0)
			->get();
		$branches = Branch::where('deletion_status', 0)
			->get();	
		$awards = EmployeeAward::where('deletion_status', 0)
			->get();	
		$loans = Loan::where('deletion_status', 0)
			->get();	
		$holidays = Holiday::where('deletion_status', 0)
			->get();	

		$leave_requests = LeaveApplication::where('deletion_status', 0)
			->get();	
		$properties = Property::where('deletion_status', 0)
			->get();
		$designations = Designation::where('deletion_status', 0)
			->get();	
		$notices = Notice::where('deletion_status', 0)
			->get();	

		$male = User::where('deletion_status',0)->where('gender', 'm')->count();
		$female = User::where('deletion_status',0)->where('gender', 'f')->count();
			
			$charts  =	 Charts::create('pie', 'highcharts')
				    ->title('Male / Female Ratio')
				    ->labels(['Male', 'Female'])
				    ->values([$male, $female])
				    ->dimensions(1000,500)
				    ->responsive(true);	
		     $users = User::where(DB::raw('deletion_status', 0))->get();
		     $users = DB::table('users')->where('deletion_status', '0')->get();

		     //die(print_r(count($users)));

			 $charts2 = Charts::database($users, 'bar', 'highcharts')
			      ->title("New Employees by Month")
			      ->elementLabel("Month")
			      ->dimensions(1000, 500)
			      ->responsive(true)
			      ->groupByMonth(date('Y'), true);


			      $departments = Department::where('deletion_status', 0)->get();

			   	  foreach ($departments as $department)
			       {
			       	$names [] = $department->department ;
			      	$counts[] = User::where('department_id', $department->id)->count();
			      	
			      	
			      }

			      
				  $charts3  =	Charts::database($users,'pie', 'highcharts')
				    ->title('Employees per Department')
				    ->labels($names)
				    ->values($counts)
				    ->dimensions(1000,500)
				    ->responsive(true);	

				    
$events = Holiday::get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
                $event->holiday_name,
                true,
                new \DateTime($event->date),
                new \DateTime($event->date.' +1 day')
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
		return view('administrator.dashboard.dashboard', compact('clients','charts','charts2','charts3','calendar_details', 'references', 'employees', 'personal_events', 'files','departments', 'branches', 'leave_requests', 'loans', 'awards', 'holidays', 'designations', 'properties', 'notices'));
	}

}
