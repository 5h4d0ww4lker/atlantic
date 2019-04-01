<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Role;
use App\User;
use DB;
use Illuminate\Http\Request;
use PDF;
use Session;
use App\Branch;
use App\Department;

class EmployeeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
			$request->session()->forget('start_date'); 
			$request->session()->forget('end_date');  

		if (!empty($request->start_date) && !empty($request->end_date)) {
			$start_date = $request->start_date;
			$end_date = $request->end_date;

			Session::put('start_date', $start_date);
			Session::put('end_date', $end_date);


			//Session::get('start_date');
			//$request->session()->forget('start_date');  
			$employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->whereBetween('users.created_at', [$start_date, $end_date])
			->where('users.deletion_status', 0)
			->select('employee_id', 'users.id', 'users.name','users.father_name','users.profile_picture', 'users.contact_no_one', 'users.created_at', 'users.activation_status','users.department_id', 'designations.designation')
			->orderBy('users.employee_id', 'ASC')
			->get()
			->toArray();
		}

		else{
			 $employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('employee_id', 'users.id', 'users.name', 'users.father_name','users.profile_picture', 'users.contact_no_one', 'users.created_at', 'users.activation_status','users.department_id', 'designations.designation')
			->orderBy('users.employee_id', 'ASC')
			->get()
			->toArray();
		}
		
		return view('administrator.people.employee.manage_employees', compact('employees'));
	}

	public function print() {
		$employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('users.id', 'users.employee_id', 'users.name', 'users.email', 'users.present_address', 'users.contact_no_one', 'designations.designation')
			->orderBy('users.id', 'DESC')
			->get()
			->toArray();
		return view('administrator.people.employee.employees_print', compact('employees'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$designations = Designation::where('deletion_status', 0)
			->where('publication_status', 1)
			->orderBy('designation', 'ASC')
			->select('id', 'designation')
			->get()
			->toArray();
		$roles = Role::all();
		$branches = Branch::where('deletion_status', 0)->get();
		$departments = Department::where('deletion_status', 0)->get();
		return view('administrator.people.employee.add_employee', compact('designations', 'roles','branches' , 'departments'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

		$employee = request()->validate([
			'name' => 'required|max:100',
			'father_name' => 'nullable|max:100',
			'contact_no_one' => 'required|max:20',
			'emergency_contact' => 'nullable|max:20',
			'gender' => 'required',
			'date_of_birth' => 'nullable|date',
			'present_address' => 'required|max:250',
			'permanent_address' => 'nullable|max:250',
			'academic_qualification' => 'nullable',
			'professional_qualification' => 'nullable',
			'experience' => 'nullable',
			'tin' => 'nullable',
			'joining_date' => 'nullable',
			'designation_id' => 'required|numeric',
			'joining_position' => 'required|numeric',
			'marital_status' => 'nullable',
			'role' => 'required',
			'employement_status' => 'required',
			'branch_id' => 'required',
			'department_id' => 'required',
			'profile_picture' => 'nullable|mimes:jpeg,png,jpg,gif',
			'cv' => 'nullable|mimes:pdf,doc,docx',
		], [
			'designation_id.required' => 'The designation field is required.',
			'contact_no_one.required' => 'The contact no field is required.',
			'web.regex' => 'The URL format is invalid.',
			'name.regex' => 'No number is allowed.',
			'access_label' => 'The position field is required.',
		]);
		
		$format_string = "AIS/HR/";
		$id = User::all()->last()->id;

		
		$id = $id+1;
		$employee_id = $format_string.$id;
		
		if (!empty($request->email)) {

			$email = $request->email;
		}
		else
		{
			$first_name = $request->name;
			$father_name = $request->father_name;
			$father_name = str_replace(' ','',$father_name); 
			$mail = "@mail.com";
			$email = $first_name.'.'.$father_name.$mail;


		}



		if (!empty($employee['profile_picture'])) {
			
			$profile_picture = time() . '.' . request()->profile_picture->getClientOriginalExtension();
			$pic = array('profile_picture' => $profile_picture);
			$employee = array_merge($employee, $pic);
			request()->profile_picture->move(public_path('public/profile_picture'), $profile_picture);
		} else {
			$profile_picture = $request->get('profile_picture');
		}
		if (!empty($employee['cv'])) {
			$cv = time() . '.' . request()->cv->getClientOriginalExtension();
			$doc = array('cv' => $cv);
			$employee = array_merge($employee, $doc);
			request()->cv->move(public_path('public/cv'), $cv);
		} else {
			$cv = $request->get('cv');
		}

		//die(print_r($employee));
		
		$result = User::create($employee + ['created_by' => auth()->user()->id, 'access_label' => 2, 'password' => bcrypt(12345678), 'email'=>$email,'employee_id'=>$employee_id]);
		$inserted_id = $result->id;

		$result->attachRole(Role::where('name', $request->role)->first());

		if (!empty($inserted_id)) {
			return redirect('/people/employees/create')->with('message', 'Add successfully.');
		}
		return redirect('/people/employees/create')->with('exception', 'Operation failed !');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function active($id) {
		$affected_row = User::where('id', $id)
			->update(['activation_status' => 1]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Activate successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function deactive($id) {
		$affected_row = User::where('id', $id)
			->update(['activation_status' => 0]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Deactive successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//$employee_type = User::find($id)->toArray();
		$employee = DB::table('users')
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->select('users.*', 'designations.designation')
			->where('users.id', $id)
			->first();
		$created_by = User::where('id', $employee->created_by)
			->select('id', 'name')
			->first();
		$designations = Designation::where('deletion_status', 0)
			->select('id', 'designation')
			->get();
		return view('administrator.people.employee.show_employee', compact('employee', 'created_by', 'designations'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function pdf($id) {

		$employee = DB::table('users')
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->select('users.*', 'designations.designation')
			->where('users.id', $id)
			->first();
		$designations = DB::table('designations')->where('id', $employee->designation_id)->first();
		return view('administrator.people.employee.test', compact('employee','designations'));
		// $pdf = PDF::loadView('administrator.people.employee.pdf', compact('employee', 'designations'));
		// // $file_name = 'EMP-' . $employee->id . '.pdf';
		// return $pdf->download($file_name);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$employee = User::find($id)->toArray();
		$designations = Designation::where('deletion_status', 0)
			->where('publication_status', 1)
			->orderBy('designation', 'ASC')
			->select('id', 'designation')
			->get()
			->toArray();
		$roles = Role::all();
		$departments = Department::all();
		$branches = Branch::all();
		return view('administrator.people.employee.edit_employee', compact('employee', 'roles', 'designations','departments', 'branches'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$employee = User::find($id);

		$url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

		request()->validate([
			
			'name' => 'required|max:100',
			'father_name' => 'nullable|max:100',
			'contact_no_one' => 'required|max:20',
			'emergency_contact' => 'nullable|max:20',
			'gender' => 'required',
			'date_of_birth' => 'nullable|date',
			'present_address' => 'required|max:250',
			'permanent_address' => 'nullable|max:250',
			'academic_qualification' => 'nullable',
			'professional_qualification' => 'nullable',
			'experience' => 'nullable',
			'joining_date' => 'nullable',
			'designation_id' => 'required|numeric',
			'joining_position' => 'required|numeric',
			'marital_status' => 'nullable',
			'tin' => 'nullable',
			'role' => 'required',
			'employement_status' => 'required',
			'branch_id' => 'required',
			'department_id' => 'required',
			'profile_picture' => 'nullable|mimes:jpeg,png,jpg,gif',
			'cv' => 'nullable|mimes:pdf,doc,docx',


		], [
			'designation_id.required' => 'The designation field is required.',
			'contact_no_one.required' => 'The contact no field is required.',
			'web.regex' => 'The URL format is invalid.',
			'name.regex' => 'No number is allowed.',
			'access_label' => 'The position field is required.',
		]);

		if (!empty($request->email)) {

			$email = $request->email;
		}
		else
		{
			$first_name = $request->name;
			$father_name = $request->father_name;
			$father_name = str_replace(' ','',$father_name); 
			$mail = "@mail.com";
			$email = $first_name.'.'.$father_name.$mail; 
		}

	

		
		$employee->name = $request->get('name');
		$employee->father_name = $request->get('father_name');
		$employee->email = $email;
		$employee->contact_no_one = $request->get('contact_no_one');
		$employee->emergency_contact = $request->get('emergency_contact');
		$employee->gender = $request->get('gender');
		$employee->date_of_birth = $request->get('date_of_birth');
		$employee->present_address = $request->get('present_address');
		$employee->permanent_address = $request->get('permanent_address');
		$employee->academic_qualification = $request->get('academic_qualification');
		$employee->professional_qualification = $request->get('professional_qualification');
		$employee->experience = $request->get('experience');
		$employee->reference = $request->get('reference');
		$employee->joining_date = $request->get('joining_date');
		$employee->designation_id = $request->get('designation_id');
		$employee->joining_position = $request->get('joining_position');
		$employee->access_label = 2;
		$employee->marital_status = $request->get('marital_status');
		$employee->role = $request->get('role');
		$employee->tin = $request->tin;
		$employee->branch_id = $request->branch_id;

		if (!empty(request()->profile_picture)) {
			
			$profile_picture = time() . '.' . request()->profile_picture->getClientOriginalExtension();
			$employee->profile_picture = $profile_picture;
			request()->profile_picture->move(public_path('public/profile_picture'), $profile_picture);
		} else {
			$profile_picture = $request->get('profile_picture');
		}
		if (!empty(request()->cv)) {
			$cv = time() . '.' . request()->cv->getClientOriginalExtension();
			$employee->cv = $cv; 
			request()->cv->move(public_path('public/cv'), $cv);
		} else {
			$cv = $request->get('cv');
		}


	
		$affected_row = $employee->save();

		DB::table('role_user')
			->where('user_id', $id)
			->update(['role_id' => $request->input('role')]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Update successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$affected_row = User::where('id', $id)
			->update(['deletion_status' => 1]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Delete successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}


	public function reports(){

		return view('administrator.people.employee.reports');
	}
}
