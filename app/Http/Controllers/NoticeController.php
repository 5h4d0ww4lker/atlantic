<?php

namespace App\Http\Controllers;

use App\Notice;
use App\User;
use Illuminate\Http\Request;
use Session;

class NoticeController extends Controller {
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

		$notices = Notice::query()
			->leftjoin('users as users', 'users.id', '=', 'notices.created_by')
			->orderBy('notices.id', 'DESC')
			->where('notices.deletion_status', 0)
			->whereBetween('notices.created_at',[$start_date, $end_date])
			->get([
				'notices.*',
				'users.name',
				'users.father_name',
				'users.grand_father_name',
			])
			->toArray();

		}

		else
		{
			$notices = Notice::query()
			->leftjoin('users as users', 'users.id', '=', 'notices.created_by')
			->orderBy('notices.id', 'DESC')
			->where('notices.deletion_status', 0)
			->get([
				'notices.*',
				'users.name',
				'users.father_name',
				'users.grand_father_name',
			])
			->toArray();

		}
		//return dd($notices);
		return view('administrator.hrm.notice.manage_notice', compact('notices'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('administrator.hrm.notice.add_notice');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//return($request->all());
		$notice = $this->validate($request, [
			'notice_title' => 'required',
			'from_date' => 'required',
			'to_date' => 'required',
			'description' => 'required',
			'publication_status' => 'required',
		]);
		$result = Notice::create($notice + ['created_by' => auth()->user()->id]);
		$inserted_id = $result->id;
		if (!empty($inserted_id)) {
			return redirect('/hrm/notice/create')->with('message', 'Add successfully.');
		}
		return redirect('/hrm/notice/create')->with('exception', 'Operation failed !');

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function published($id) {
		$affected_row = Notice::where('id', $id)
			->update(['publication_status' => 1]);

		if (!empty($affected_row)) {
			return redirect('/hrm/notice/')->with('message', 'Published successfully.');
		}
		return redirect('/hrm/notice/')->with('exception', 'Operation failed !');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function unpublished($id) {
		$affected_row = Notice::where('id', $id)
			->update(['publication_status' => 0]);

		if (!empty($affected_row)) {
			return redirect('/hrm/notice/')->with('message', 'Unpublished successfully.');
		}
		return redirect('/hrm/notice/')->with('exception', 'Operation failed !');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Holiday  $holidays
	 * @return \Illuminate\Http\Response
	 */
	public function show() {
		$notices = Notice::query()
		->leftjoin('users as users', 'users.id', '=', 'notices.created_by')
		->where('notices.deletion_status', 0)
		->where('notices.publication_status', 1)
		->orderBy('notices.id', 'DESC')
		->paginate(5);
		return view('administrator.hrm.notice.show_notice', compact('notices'));
	}

	public function detail($id) {
		$notice = Notice::find($id);
		
		$users = User::where('id', $notice->created_by)->get();
		
		return view('administrator.hrm.notice.detail_notice', compact('notice','users'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Notice  $notice
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Notice $notice) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Notice  $notice
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Notice $notice) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Notice  $notice
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$affected_row = Notice::where('id', $id)
			->update(['deletion_status' => 1]);

		if (!empty($affected_row)) {
			return redirect('/hrm/notice/')->with('message', 'Delete successfully.');
		}
		return redirect('/hrm/notice/')->with('exception', 'Operation failed !');
	}
}
