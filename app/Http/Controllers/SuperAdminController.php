<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Role;
use App\RoleUser;
use App\User;
use DB;
use Illuminate\Http\Request;
use PDF;
use Session;
use App\Branch;
use App\Department;

class SuperAdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index(Request $request)
     {
	
			$super_admins = User::query()
			->where('access_label', 1)
			->orderBy('id', 'ASC')
			->get()
			->toArray();
	
		return view('administrator.setting.super_admin.manage_super_admins', compact('super_admins'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		
		return view('administrator.setting.super_admin.add_super_admins');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
        $super_admin = new User;



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

	

		
		$super_admin->name = $request->get('name');
		$super_admin->father_name = $request->get('father_name');
		$super_admin->grand_father_name = $request->get('grand_father_name');
		$super_admin->email = $email;
		$super_admin->contact_no_one = $request->get('contact_no_one');
		
		$super_admin->gender = $request->get('gender');
		
		$super_admin->present_address = 'Addis Ababa';
		
		if (!empty(request()->profile_picture)) {
			
			$profile_picture = time() . '.' . request()->profile_picture->getClientOriginalExtension();
			$super_admin->profile_picture = $profile_picture;
			request()->profile_picture->move(public_path('public/profile_picture'), $profile_picture);
		} else {
			$profile_picture = $request->get('profile_picture');
		}
        
        $format_string = "AIS/HR/";
		$id = User::all()->last()->id;

		
		$id = $id+1;
        $employee_id = $format_string.$id;
        $super_admin->employee_id = $employee_id;
        $super_admin->created_by = auth()->user()->id;
        $super_admin->access_label = 1;
        $super_admin->password =  bcrypt(12345678);
        

	
        $result = $super_admin->save(); 
     
        $user = User::where('employee_id', $super_admin->employee_id )->first();
       
        $attach_role = new RoleUser;
        $attach_role->user_id = $user->id;
        $attach_role->role_id = 1;
        $attach_role->save();

		return redirect('/setting/super_admins')->with('message', 'Add successfully.');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */




	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//$super_admin_type = User::find($id)->toArray();
		$super_admin = User::where('id', $id)
			->first();
		$created_by = User::where('id', $super_admin->created_by)
			->select('id', 'name')
			->first();
		
		return view('administrator.setting.super_admin.show_super_admin', compact('super_admin', 'created_by'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$super_admin = User::find($id)->toArray();
	
		return view('administrator.setting.super_admin.edit_super_admin', compact('super_admin'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$super_admin = User::find($id);



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

	

		
		$super_admin->name = $request->get('name');
		$super_admin->father_name = $request->get('father_name');
		$super_admin->grand_father_name = $request->get('grand_father_name');
		$super_admin->email = $email;
		$super_admin->contact_no_one = $request->get('contact_no_one');
		
		$super_admin->gender = $request->get('gender');
		
		$super_admin->present_address = 'Addis Ababa';
		
	
		$super_admin->access_label = 1;
		$super_admin->role = 1;
	



		if (!empty(request()->profile_picture)) {
			
			$profile_picture = time() . '.' . request()->profile_picture->getClientOriginalExtension();
			$super_admin->profile_picture = $profile_picture;
			request()->profile_picture->move(public_path('public/profile_picture'), $profile_picture);
		} else {
			$profile_picture = $request->get('profile_picture');
		}



	
		$affected_row = $super_admin->save();

		DB::table('role_user')
			->where('user_id', $id)
			->update(['role_id' => $request->input('role')]);

		if (!empty($affected_row)) {
			return redirect('/setting/super_admins')->with('message', 'Update successfully.');
		}
		return redirect('/setting/super_admins')->with('exception', 'Operation failed !');
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

		$deleted_row = User::find($id);	
		$deleted_row->delete();	

		if (!empty($affected_row)) {
			return redirect('/setting/super_admins')->with('message', 'Delete successfully.');
		}
		return redirect('/setting/super_admins')->with('exception', 'Operation failed !');
	}



}
