<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Role;
use App\User;
use App\Dependent;
use DB;
use Illuminate\Http\Request;
use PDF;
use Session;

class DependentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		
			//$dependents = Dependent::where('deletion_status', 0)->get();
			$dependents = Dependent::orderBy('user_id')
			->where('deletion_status', 0)
			// ->selectRaw('count(*) as total, user_id')
			->get();

		//$dependents = Dependent::all();
	
		
		return view('administrator.people.dependent.manage_dependents', compact('dependents'));
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
	
		return view('administrator.people.dependent.add_dependent');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		
		if (!empty($request->profile_picture)) {
			
			$profile_picture = time() . '.' . request()->profile_picture->getClientOriginalExtension();
			request()->profile_picture->move(public_path('public/profile_picture'), $profile_picture);
		} else
		{
			$profile_picture = null;
		}


		$dependent = new Dependent;
		$dependent->user_id = $request->user_id;
		$dependent->dependent_name = $request->dependent_name;
		$dependent->relationship = $request->relationship;
		$dependent->created_by = auth()->user()->id;
		$dependent->profile_picture = $profile_picture;
		$dependent->phone_number = $request->phone_number;
		$dependent->save();


		return redirect('/people/dependents')->with('message', 'Added successfully !');
	}

	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		
		$dependent = Dependent::find($id);
		return view('administrator.people.dependent.edit_dependent', compact('dependent'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
	if (!empty($request->profile_picture)) {
			
			$profile_picture = time() . '.' . request()->profile_picture->getClientOriginalExtension();
			request()->profile_picture->move(public_path('public/profile_picture'), $profile_picture);
		} else
		{
			$profile_picture = null;
		}


		$dependent = Dependent::find($id);
		$dependent->user_id = $request->user_id;
		$dependent->dependent_name = $request->dependent_name;
		$dependent->relationship = $request->relationship;
		$dependent->created_by = auth()->user()->id;
		$dependent->profile_picture = $profile_picture;
		$dependent->phone_number = $request->phone_number;
		$dependent->save();


		return redirect('/people/dependents')->with('message', 'Added successfully !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$affected_row = Dependent::where('id', $id)
			->update(['deletion_status' => 1]);

		
		return redirect('/people/dependents')->with('message', 'Compketed successfully !');
	}


	
}
