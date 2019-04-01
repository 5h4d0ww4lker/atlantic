<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PropertyRequest;
use App\User;

class PropertyRequestController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index() {

        $user = auth()->user();

        if ($user->role == 1) {
            $property_requests = PropertyRequest::all()
                ->sortByDesc('property')
                ->where('deletion_status', 0)
                ->toArray();
        }

        else
        {
             $property_requests = PropertyRequest::all()
                ->sortByDesc('property')
                ->where('deletion_status', 0)
                ->where('employee_id', $user)
                ->toArray();
        }
       
        return view('administrator.setting.property_request.manage_property_requests', compact('property_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $employees = User::all();
        return view('administrator.setting.property_request.add_property_request', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
      
        $property_request = new PropertyRequest;
        $property_request->property_name = $request->property_name;
        $property_request->property_description = $request->property_description;
        $property_request->status = $request->status;
        $property_request->employee_id = auth()->user()->id;
        $property_request->created_by = auth()->user()->id;


        $property_request->save();

       
        $inserted_id = $property_request->id;

        if (!empty($inserted_id)) {
            return redirect('/setting/property_requests')->with('message', 'Add successfully.');
        }
        return redirect('/setting/property_requests/create')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function published($id) {
        $affected_row = PropertyRequest::where('id', $id)
                ->update(['publication_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/property_requests')->with('message', 'Published successfully.');
        }
        return redirect('/setting/property_requests')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpublished($id) {
        $affected_row = PropertyRequest::where('id', $id)
                ->update(['publication_status' => 0]);

        if (!empty($affected_row)) {
            return redirect('/setting/property_requests')->with('message', 'Unpublished successfully.');
        }
        return redirect('/setting/property_requests')->with('exception', 'Operation failed !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $property_request = DB::table('property_requests')
                ->join('users', 'property_requests.created_by', '=', 'users.id')
                ->select('property_requests.*', 'users.name')
                ->where('property_requests.id', $id)
                ->first();
        return view('administrator.setting.property_request.show_property_request', compact('property_request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $property = PropertyRequest::find($id)->toArray();
        return view('administrator.setting.property_request.edit_property_request', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $property_request = PropertyRequest::find($id);
        $property_request->property_name = $request->property_name;
        $property_request->status = $request->status;
        $property_request->property_description = $request->property_description;
        $property_request->updated_by = auth()->user()->id;
        $property_request->save();
        return redirect('/setting/property_requests')->with('message', 'Update successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $affected_row = PropertyRequest::where('id', $id)
                ->update(['deletion_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/property_requests')->with('message', 'Delete successfully.');
        }
        return redirect('/setting/property_requests')->with('exception', 'Operation failed !');
    }

}
