<?php

namespace App\Http\Controllers;

use App\AwardCategory;
use Illuminate\Http\Request;
use App\User;

class MailController extends Controller {


	public function sendMail(Request $request)
	{

	$to = $request->caption;


	$subject = $request->subject;
	$txt = $request->message;
	$headers = "From: webmaster@atlanticplc.com";

	mail($to,$subject,$txt,$headers);

	}


		public function bulkMail(Request $request)
	{

	$role = $request->role;
	$users = User::where('role', $role)->get();
	foreach ($users as $user) {
	$to = $user->email;
	$subject = $request->subject;
	$txt = $request->message;
	$headers = "From: webmaster@atlanticplc.com";

	mail($to,$subject,$txt,$headers);
	}




	}

}
