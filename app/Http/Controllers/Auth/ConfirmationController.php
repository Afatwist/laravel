<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Users_Confirmations;
use App\User;

use Illuminate\Support\Facades\Session;

class ConfirmationController extends Controller
{


	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	protected $data;


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	public function confirmation($selector, $token)
	{
		$user_confirm = Users_Confirmations::where('selector', $selector)->where('token', $token)->firstOrFail();

		$user = User::where('id', $user_confirm->user_id)->first();
		$user->email = $user_confirm->email;
		$user->email_confirm = 1;
		$user->save();

		$user_confirm->delete();
		return redirect('/login')->withInput(['success'=>'Email подтвержден']);
	}
}
