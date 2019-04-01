<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Training;
use App\User;

class TrainingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $trainings = Training::all()
                ->sortByDesc('training')
                ->where('deletion_status', 0)
                ->toArray();
        return view('administrator.setting.training.manage_trainings', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $employees = User::all();
        return view('administrator.setting.training.add_training', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
      
        $training = new Training;
        $training->title = $request->title;
        $training->venue = $request->venue;
        $training->description = $request->description;
        $training->from_date = $request->from_date;
        $training->to_date = $request->to_date;
        $training->created_by = auth()->user()->id;
        $training->save();

       
        $inserted_id = $training->id;

        if (!empty($inserted_id)) {
            return redirect('/setting/trainings')->with('message', 'Add successfully.');
        }
        return redirect('/setting/trainings/create')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function published($id) {
        $affected_row = Training::where('id', $id)
                ->update(['publication_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/trainings')->with('message', 'Published successfully.');
        }
        return redirect('/setting/trainings')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpublished($id) {
        $affected_row = Training::where('id', $id)
                ->update(['publication_status' => 0]);

        if (!empty($affected_row)) {
            return redirect('/setting/trainings')->with('message', 'Unpublished successfully.');
        }
        return redirect('/setting/trainings')->with('exception', 'Operation failed !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $training = DB::table('trainings')
                ->join('users', 'trainings.created_by', '=', 'users.id')
                ->select('trainings.*', 'users.name')
                ->where('trainings.id', $id)
                ->first();
        return view('administrator.setting.training.show_training', compact('training'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $training = Training::find($id)->toArray();
        return view('administrator.setting.training.edit_training', compact('training'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $training = Training::find($id);
         $training->title = $request->title;
        $training->venue = $request->venue;
        $training->description = $request->description;
        $training->from_date = $request->from_date;
        $training->to_date = $request->to_date;
        $training->updated_by = auth()->user()->id;
        $training->save();
        return redirect('/setting/trainings')->with('message', 'Update successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $affected_row = Training::where('id', $id)
                ->update(['deletion_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/trainings')->with('message', 'Delete successfully.');
        }
        return redirect('/setting/trainings')->with('exception', 'Operation failed !');
    }

}
