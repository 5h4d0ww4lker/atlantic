<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Branch;

class BranchController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $branchs = Branch::all()
                ->sortByDesc('branch')
                ->where('deletion_status', 0)
                ->toArray();
        return view('administrator.setting.branch.manage_branchs', compact('branchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('administrator.setting.branch.add_branch');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $branch = $this->validate(request(), [
            'branch' => 'required|unique:branchs|max:100',
            'publication_status' => 'required',
            'branch_description' => 'required',
        ]);

        $result = Branch::create($branch + ['created_by' => auth()->user()->id]);
        $inserted_id = $result->id;

        if (!empty($inserted_id)) {
            return redirect('/setting/branchs/create')->with('message', 'Add successfully.');
        }
        return redirect('/setting/branchs/create')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function published($id) {
        $affected_row = Branch::where('id', $id)
                ->update(['publication_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/branchs')->with('message', 'Published successfully.');
        }
        return redirect('/setting/branchs')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpublished($id) {
        $affected_row = Branch::where('id', $id)
                ->update(['publication_status' => 0]);

        if (!empty($affected_row)) {
            return redirect('/setting/branchs')->with('message', 'Unpublished successfully.');
        }
        return redirect('/setting/branchs')->with('exception', 'Operation failed !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $branch = DB::table('branchs')
                ->join('users', 'branchs.created_by', '=', 'users.id')
                ->select('branchs.*', 'users.name')
                ->where('branchs.id', $id)
                ->first();
        return view('administrator.setting.branch.show_branch', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $branch = Branch::find($id)->toArray();
        return view('administrator.setting.branch.edit_branch', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $branch = Branch::find($id);
        $this->validate(request(), [
            'branch' => 'required|max:100',
            'publication_status' => 'required',
            'branch_description' => 'required',
        ]);

        $branch->branch = $request->get('branch');
        $branch->branch_description = $request->get('branch_description');
        $branch->publication_status = $request->get('publication_status');
        $affected_row = $branch->save();

        if (!empty($affected_row)) {
            return redirect('/setting/branchs')->with('message', 'Update successfully.');
        }
        return redirect('/setting/branchs')->with('exception', 'Operation failed !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $affected_row = Branch::where('id', $id)
                ->update(['deletion_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/branchs')->with('message', 'Delete successfully.');
        }
        return redirect('/setting/branchs')->with('exception', 'Operation failed !');
    }

}
