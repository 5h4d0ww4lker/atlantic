<?php

namespace App\Http\Controllers;

use App\Designation;
use App\User;
use App\EmployeeReference;
use DB;
use Illuminate\Http\Request;
use PDF;

class ReferenceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$references = EmployeeReference::where('deletion_status', 0)->get();
			
		return view('administrator.people.reference.manage_references', compact('references'));
	}

	public function print() {
		$references = EmployeeReference::where('deletion_status', 4)
			->where('deletion_status', 0)
			->select('id', 'reference_na,ename', 'address', 'contact_no', 'created_at')
			->orderBy('id', 'DESC')
			->get()
			->toArray();
		return view('administrator.people.reference.references_print', compact('references'));
	}

	public function references_pdf() {
		$references = User::where('access_label', 4)
			->where('deletion_status', 0)
			->select('id', 'name', 'present_address', 'contact_no_one', 'created_at', 'activation_status')
			->orderBy('id', 'DESC')
			->get()
			->toArray();

		$pdf = PDF::loadView('administrator.people.reference.references_pdf', compact('references'));
		$file_name = 'References.pdf';
		return $pdf->download($file_name);
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
		return view('administrator.people.reference.add_reference', compact('reference_types', 'designations'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$reference = new EmployeeReference();
		$reference->employee_id = $request->employee_id;
		$reference->reference_name = $request->get('name');
		$reference->email = $request->get('email');
		$reference->contact_no = $request->get('contact_no');
		$reference->gender = $request->get('gender');
		$reference->address = $request->get('address');
		$reference->created_by = auth()->user()->id;
		$reference->save();
		return redirect('/people/references/create')->with('message', 'Add successfully.');
		
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
			return redirect('/people/references')->with('message', 'Activate successfully.');
		}
		return redirect('/people/references')->with('exception', 'Operation failed !');
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
			return redirect('/people/references')->with('message', 'Deactive successfully.');
		}
		return redirect('/people/references')->with('exception', 'Operation failed !');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$reference = DB::table('users')
			->select('users.*')
			->where('users.id', $id)
			->first();
		$created_by = User::where('id', $reference->created_by)
			->select('id', 'name')
			->first();
		return view('administrator.people.reference.show_reference', compact('reference', 'created_by'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function pdf($id) {
		$reference = DB::table('users')
			->select('users.*')
			->where('users.id', $id)
			->first();

		$created_by = User::where('id', $reference->created_by)
			->select('id', 'name')
			->first();

		$pdf = PDF::loadView('administrator.people.reference.pdf', compact('reference', 'created_by'));
		$file_name = str_replace(' ', '', $reference->name) . '.pdf';
		return $pdf->download($file_name);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$reference = EmployeeReference::find($id);
		
		return view('administrator.people.reference.edit_reference', compact('reference'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$reference = EmployeeReference::find($id);
		$reference->employee_id = $request->employee_id;
		$reference->reference_name = $request->get('reference_name');
		$reference->email = $request->get('email');
		$reference->contact_no = $request->get('contact_no');
		$reference->gender = $request->get('gender');
		$reference->address = $request->get('address');
		$reference->updated_by = auth()->user()->id;
		$reference->save();
		

		
			return redirect('/people/references')->with('message', 'Update successfully.');
	
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
			return redirect('/people/references')->with('message', 'Delete successfully.');
		}
		return redirect('/people/references')->with('exception', 'Operation failed !');
	}

}
