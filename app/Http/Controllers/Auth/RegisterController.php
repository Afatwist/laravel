<?php

namespace App\Http\Controllers\Auth;

use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;
use App\Mail\UserEmailConfirmations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;


use App\User;
use App\Http\Controllers\Controller;
use App\Users_Confirmations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');

	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:3|confirmed',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\User
	 */
	protected function create(array $data)
	{
		 $user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'roles' => Roles::USER,
			'status' => Status::PENDING_REVIEW,
			'activity' => Activity::ONLINE,
		]);

		$confirmation = Users_Confirmations::create([
			'user_id' => $user->id,
			'email' => $user->email,
			'selector' => uniqid(),
			'token' =>md5(uniqid())
			]);
			
		Mail::to($user->email)->send(new UserEmailConfirmations($confirmation));
		//Session::flash('status', 'Спасибо за регистрацию! На указанный email было отправлено письмо для подтверждения регистрации.');
		/* 	redirect($this->redirectPath())
		->withSuccess('status','Спасибо за регистрацию! На указанный email было отправлено письмо для подтверждения регистрации.'); */
	
		return $user;
	}

	protected function registered(Request $request, $user)
	{
		$this->guard()->logout();
	}
}
