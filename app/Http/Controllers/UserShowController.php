<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserShowController extends Controller
{

	public function userList()
	{
		return view('users/userlist',['users' => User::all()]);
	}

	public function paginator()
	{
		return view('users/paginator', ['users' => User::paginate(6)]);
	}

	public function profile($id)
	{
		return view('users/profile', ['user' => User::findOrFail($id)]);
	}
}
