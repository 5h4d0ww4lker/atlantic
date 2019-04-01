<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Property;
use App\User;

class PropertyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $properties = Property::all()
                ->sortByDesc('property')
                ->where('deletion_status', 0)
                ->toArray();
        return view('administrator.setting.property.manage_properties', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $employees = User::all();
        return view('administrator.setting.property.add_property', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
      
        $property = new Property;
        $property->property_name = $request->property_name;
        $property->property_identification = $request->property_identification;
        $property->property_description = $request->property_description;
        $property->employee_id = $request->employee_id;
        $property->created_by = auth()->user()->id;
        $property->save();

       
        $inserted_id = $property->id;

        if (!empty($inserted_id)) {
            return redirect('/setting/properties')->with('message', 'Add successfully.');
        }
        return redirect('/setting/properties/create')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function published($id) {
        $affected_row = Property::where('id', $id)
                ->update(['publication_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/properties')->with('message', 'Published successfully.');
        }
        return redirect('/setting/properties')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpublished($id) {
        $affected_row = Property::where('id', $id)
                ->update(['publication_status' => 0]);

        if (!empty($affected_row)) {
            return redirect('/setting/properties')->with('message', 'Unpublished successfully.');
        }
        return redirect('/setting/properties')->with('exception', 'Operation failed !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $property = DB::table('properties')
                ->join('users', 'properties.created_by', '=', 'users.id')
                ->select('properties.*', 'users.name')
                ->where('properties.id', $id)
                ->first();
        return view('administrator.setting.property.show_property', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $property = Property::find($id)->toArray();
        return view('administrator.setting.property.edit_property', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $property = Property::find($id);
        $property->property_name = $request->property_name;
        $property->property_identification = $request->property_identification;
        $property->property_description = $request->property_description;
        $property->save();
        return redirect('/setting/properties')->with('message', 'Update successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $affected_row = Property::where('id', $id)
                ->update(['deletion_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/properties')->with('message', 'Delete successfully.');
        }
        return redirect('/setting/properties')->with('exception', 'Operation failed !');
    }

}
