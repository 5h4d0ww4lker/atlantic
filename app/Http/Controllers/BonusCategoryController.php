<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BonusCategory;

class BonusCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $bonus_categories = BonusCategory::query()
        ->leftjoin('users as users','users.id', '=', 'bonus_categories.created_by')
        ->orderBy('bonus_categories.bonus_category', 'ASC')
        ->where('bonus_categories.deletion_status', 0)
        ->get([
            'bonus_categories.*',
            'users.name',
        ])
        ->toArray();
        return view('administrator.setting.bonus_category.manage_bonus_categories', compact('bonus_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('administrator.setting.bonus_category.add_bonus_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $bonus_category = $this->validate(request(), [
            'bonus_category' => 'required|unique:bonus_categories|max:100',
            'publication_status' => 'required',
            'bonus_category_description' => 'required',
        ]);

        $result = BonusCategory::create($bonus_category + ['created_by' => auth()->user()->id]);
        $inserted_id = $result->id;

        if (!empty($inserted_id)) {
            return redirect('/setting/bonus_categories/create')->with('message', 'Add successfully.');
        }
        return redirect('/setting/bonus_categories/create')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function published($id) {
        $affected_row = BonusCategory::where('id', $id)
        ->update(['publication_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/bonus_categories')->with('message', 'Published successfully.');
        }
        return redirect('/setting/bonus_categories')->with('exception', 'Operation failed !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpublished($id) {
        $affected_row = BonusCategory::where('id', $id)
        ->update(['publication_status' => 0]);

        if (!empty($affected_row)) {
            return redirect('/setting/bonus_categories')->with('message', 'Unpublished successfully.');
        }
        return redirect('/setting/bonus_categories')->with('exception', 'Operation failed !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $bonus_category = BonusCategory::query()
        ->leftjoin('users as users','users.id', '=', 'bonus_categories.created_by')
        ->orderBy('bonus_categories.bonus_category', 'ASC')
        ->where('bonus_categories.id', $id)
        ->where('bonus_categories.deletion_status', 0)
        ->first([
            'bonus_categories.*',
            'users.name',
        ])
        ->toArray();
        return view('administrator.setting.bonus_category.show_bonus_category', compact('bonus_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $bonus_category = BonusCategory::find($id)->toArray();
        return view('administrator.setting.bonus_category.edit_bonus_category', compact('bonus_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $bonus_category = BonusCategory::find($id);
        $this->validate(request(), [
            'bonus_category' => 'required|max:100',
            'publication_status' => 'required',
            'bonus_category_description' => 'required',
        ]);

        $bonus_category->bonus_category = $request->get('bonus_category');
        $bonus_category->bonus_category_description = $request->get('bonus_category_description');
        $bonus_category->publication_status = $request->get('publication_status');
        $affected_row = $bonus_category->save();

        if (!empty($affected_row)) {
            return redirect('/setting/bonus_categories')->with('message', 'Update successfully.');
        }
        return redirect('/setting/bonus_categories')->with('exception', 'Operation failed !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $affected_row = BonusCategory::where('id', $id)
        ->update(['deletion_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/setting/bonus_categories')->with('message', 'Delete successfully.');
        }
        return redirect('/setting/bonus_categories')->with('exception', 'Operation failed !');
    }

}
