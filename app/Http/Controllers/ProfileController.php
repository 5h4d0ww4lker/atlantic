<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller {
	public function index() {
		$user = User::find(auth()->user()->id)->toArray();
		//return dd($user);
		return view('administrator.profile.user_profile', compact('user'));
	}

	public function update(Request $request) {
		$user = User::find(auth()->user()->id);

	

		$data = request()->validate([
			
			
			'profile_picture' => 'nullable|mimes:jpeg,png,jpg,gif',
		
		]);

		if (!empty($data['profile_picture'])) {
			$profile_picture = time() . '.' . request()->profile_picture->getClientOriginalExtension();
			$user->profile_picture = $profile_picture;
			request()->profile_picture->move(public_path('public/profile_picture'), $profile_picture);
		} else {
			$profile_picture = $request->get('previous_avater');
		}

		$user->name = $request->get('name');
		$user->contact_no_one = $request->get('contact_no_one');
		$user->gender = $request->get('gender');
		$user->date_of_birth = $request->get('date_of_birth');
		$user->present_address = $request->get('present_address');
		$user->permanent_address = $request->get('permanent_address');
		

		$affected_row = $user->save();

		if (!empty($affected_row)) {
			return redirect('/profile/user-profile')->with('message', 'Update successfully.');
		}
		return redirect('/profile/user-profile')->with('exception', 'Operation failed !');
	}

	public function change_password() {
		return view('administrator.profile.change_password');
	}

	public function update_password(Request $request) {
		$user = User::find(auth()->user()->id);

		$data = request()->validate([
			'password' => 'required|string|min:8|confirmed',
			'password_confirmation' => '',
		], [
			'password.required' => 'The new password field is required.',
		]);

		$user->password = bcrypt($request->get('password'));

		$affected_row = $user->save();

		if (!empty($affected_row)) {
			return redirect('/profile/change-password')->with('message', 'Update successfully.');
		}
		return redirect('/profile/change-password')->with('exception', 'Operation failed !');

	}
}
