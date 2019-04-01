<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Recruitment;
use App\User;

class RecruitmentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $recruitments = Recruitment::all()
                ->sortByDesc('recruitment')
                ->where('deletion_status', 0)
                ->toArray();
        return view('administrator.setting.recruitment.manage_recruitments', compact('recruitments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $employees = User::all();
        return view('administrator.setting.recruitment.add_recruitment', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
      
        $recruitment = new Recruitment;
        $recruitment->first_name = $request->first_name;
        $recruitment->last_name = $request->last_name;
        $recruitment->status = $request->status;
        $recruitment->point = $request->point;
        $recruitment->qualification = $request->qualification;
        $recruitment->experience = $request->experience;
        $recruitment->created_by = auth()->user()->id;
       
            if (!empty($request->cv)) {
            $cv = time() . '.' . request()->cv->getClientOriginalExtension();
            $recruitment->cv = $cv;
            request()->cv->move(public_path('public/cv'), $cv);
        } else {
            $cv = $request->get('cv');
        }
 
       $recruitment->save();
            return redirect('/setting/recruitments')->with('message', 'Add successfully.');
          }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function published($id) {
        $affected_row = Recruitment::where('id', $id)
                ->update(['publication_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/recruitments')->with('message', 'Published successfully.');
        }
        return redirect('/setting/recruitments')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpublished($id) {
        $affected_row = Recruitment::where('id', $id)
                ->update(['publication_status' => 0]);

        if (!empty($affected_row)) {
            return redirect('/setting/recruitments')->with('message', 'Unpublished successfully.');
        }
        return redirect('/setting/recruitments')->with('exception', 'Operation failed !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $recruitment = DB::table('recruitments')
                ->join('users', 'recruitments.created_by', '=', 'users.id')
                ->select('recruitments.*', 'users.name')
                ->where('recruitments.id', $id)
                ->first();
        return view('administrator.setting.recruitment.show_recruitment', compact('recruitment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $recruitment = Recruitment::find($id)->toArray();
        return view('administrator.setting.recruitment.edit_recruitment', compact('recruitment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $recruitment = Recruitment::find($id);
        $recruitment->first_name = $request->first_name;
        $recruitment->last_name = $request->last_name;
        $recruitment->status = $request->status;
        $recruitment->point = $request->point;
        $recruitment->qualification = $request->qualification;
        $recruitment->experience = $request->experience;
        $recruitment->updated_by = auth()->user()->id;
       
        if (!empty($request->cv)) {
            $cv = time() . '.' . request()->cv->getClientOriginalExtension();
            $recruitment->cv = $cv;
            request()->cv->move(public_path('public/cv'), $cv);
        } else {
            $cv = $request->get('cv');
        }

        $recruitment->save();
        return redirect('/setting/recruitments')->with('message', 'Update successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $affected_row = Recruitment::where('id', $id)
                ->update(['deletion_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/recruitments')->with('message', 'Delete successfully.');
        }
        return redirect('/setting/recruitments')->with('exception', 'Operation failed !');
    }

}
