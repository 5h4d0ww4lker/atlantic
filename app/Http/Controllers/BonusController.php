<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;
use App\User;
use App\BonusCategory;
use Session;

class BonusController extends Controller
{

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

             $bonuses = Bonus::query()
        ->leftjoin('users as users','users.id', '=', 'bonuses.user_id')
        ->leftjoin('designations','users.designation_id', '=', 'designations.id')
        ->orderBy('bonuses.id', 'DESC')
        ->where('bonuses.deletion_status', 0)
        ->whereBetween('bonuses.created_at', [$start_date, $end_date])
        ->get([
            'bonuses.*',
            'users.name',
            'users.father_name',
            'users.grand_father_name',
            'designations.designation'
        ])
        ->toArray();

    }

        else{
             $bonuses = Bonus::query()
        ->leftjoin('users as users','users.id', '=', 'bonuses.user_id')
        ->leftjoin('designations','users.designation_id', '=', 'designations.id')
        ->orderBy('bonuses.id', 'DESC')
        ->where('bonuses.deletion_status', 0)
        ->get([
            'bonuses.*',
            'users.name',
            'users.father_name',
            'users.grand_father_name',
            'designations.designation'
        ])
        ->toArray();
        }    



       
        return view('administrator.hrm.bonus.manage_bonuses', compact('bonuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         $users = User::where('deletion_status', 0)
         ->where('access_label', '>=', 2)
         ->where('access_label', '<=', 3)
        ->orderBy('name')
        ->get()
        ->toArray();
        $bonus_categories = BonusCategory::where('deletion_status', 0)
        ->orderBy('bonus_category')
        ->get()
        ->toArray();
        return view('administrator.hrm.bonus.add_bonus', compact('users', 'bonus_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $bonus = $this->validate(request(), [
            'user_id' => 'required',
            'bonus_name' => 'required|max:100',
            'bonus_month' => 'required',
            'bonus_month_to' => 'required',
            'bonus_amount' => 'required|numeric',
            'bonus_description' => 'required',
        ],[
            'user_id.required' => 'The employee name field is required.',
        ]);

        $result = Bonus::create([
            'created_by' => auth()->user()->id,
            'user_id' => $request->user_id,
            'bonus_name' => $request->bonus_name,
            'bonus_month' => $request->bonus_month,
            'bonus_month_to' => $request->bonus_month_to,
            'bonus_amount' => $request->bonus_amount,
            'bonus_description' => $request->bonus_description,
        ]);
        $inserted_id = $result->id;

        if (!empty($inserted_id)) {
            return redirect('/hrm/bonuses/create')->with('message', 'Add successfully.');
        }
        return redirect('/hrm/bonuses/create')->with('exception', 'Operation failed !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $bonus = Bonus::query()
        ->leftjoin('users as users','users.id', '=', 'bonuses.user_id')
        ->leftjoin('designations','users.designation_id', '=', 'designations.id')
        ->orderBy('bonuses.id', 'DESC')
        ->where('bonuses.deletion_status', 0)
        ->first([
            'bonuses.*',
            'users.name',
            'users.father_name',
            'users.grand_father_name',
            'designations.designation'
        ])
        ->toArray();

        $users = User::where('deletion_status', 0)
        ->orderBy('name')
        ->get()
        ->toArray();
        $bonus_category = BonusCategory::where('id', $id)
        ->orderBy('bonus_category')
        ->get()
        ->toArray();

        return view('administrator.hrm.bonus.show_bonus', compact('bonus', 'users', $bonus_category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $bonus = Bonus::find($id)->toArray();

        $users = User::where('deletion_status', 0)
        ->orderBy('name')
        ->get()
        ->toArray();

         $bonus_categories = BonusCategory::where('deletion_status', 0)
        ->orderBy('bonus_category')
        ->get()
        ->toArray();

        return view('administrator.hrm.bonus.edit_bonus', compact('bonus', 'users', 'bonus_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $bonus = Bonus::find($id);
        $this->validate(request(), [
            'user_id' => 'required',
            'bonus_name' => 'required|max:100',
            'bonus_month' => 'required',
            'bonus_month_to' => 'required',
            'bonus_amount' => 'required|numeric',
            'bonus_description' => 'required',
        ],[
            'user_id.required' => 'The employee name field is required.',
        ]);

        $bonus->user_id = $request->get('user_id');
        $bonus->bonus_name = $request->get('bonus_name');
        $bonus->bonus_month = $request->get('bonus_month');
         $bonus->bonus_month_to = $request->get('bonus_month_to');
        $bonus->bonus_amount = $request->get('bonus_amount');
        $bonus->bonus_description = $request->get('bonus_description');
        $affected_row = $bonus->save();

        if (!empty($affected_row)) {
            return redirect('/hrm/bonuses')->with('message', 'Update successfully.');
        }
        return redirect('/hrm/bonuses')->with('exception', 'Operation failed !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $affected_row = Bonus::where('id', $id)
        ->update(['deletion_status' => 1]);

        if (!empty($affected_row)) {
            return redirect('/hrm/bonuses')->with('message', 'Delete successfully.');
        }
        return redirect('/hrm/bonuses')->with('exception', 'Operation failed !');
    }

}

