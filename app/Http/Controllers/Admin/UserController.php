<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Users_Confirmations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	public function index()
	{
		return view('admin/users/index', ['users' => User::all()]);
	}

	// создание профиля пользователя
	public function create()
	{
		return view('admin/users/create');
	}

	public function createAction(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|string|email|max:30|unique:users',
			'name' => 'required|string|max:25|unique:users',
			'password' => 'required|string|min:3|confirmed',

			'activity' => 'integer',
			'roles' => 'integer',
			'status' => 'integer',

			'work_place' => 'string|max:35',
			'phone' => 'digits_between:9,12',
			'address' => 'string|max:50',

			'vk' => 'string|max:50',
			'telegram' => 'string|max:50',
			'instagram' => 'string|max:50',

			'avatar' => 'image',
			'about' => 'string|max:200'
		]);

		$path = $request->file('avatar')->store('public/avatars');

		$path = str_after($path, 'public/');

		$user = User::create([
			'email' => $request->email,
			'name' => $request->name,
			'password' => Hash::make($request->password),

			'activity' => $request->activity,
			'roles' => $request->roles,
			'status' => $request->status,

			'work_place' => $request->work_place,
			'phone' => $request->phone,
			'address' => $request->address,

			'vk' => $request->vk,
			'telegram' => $request->telegram,
			'instagram' => $request->instagram,

			'avatar' => $path,
			'about' => $request->about,
			'remember_token' => str_random(60),
		]);

		if ($request->send_email == "true") {
			$confirmation = Users_Confirmations::create([
				'user_id' => $user->id,
				'email' => $user->email,
				'selector' => uniqid(),
				'token' => md5(uniqid())
			]);

			Mail::to($user->email)->send(new UserEmailConfirmations($confirmation));
		} else {
			$user->email_confirm = 1;
			$user->save();
		}

		session()->flash('success', 'Пользователь создан');
		return redirect('/edit/id=' . $user->id);
	}

	public function createFakerUserAction()
	{
		$user = factory(User::class, 1)->create();

		session()->flash('success', 'Пользователь создан');
		return redirect('/edit/id=' . $user->first()->id);
	}

	// редактирование профиля пользователя
	public function edit($id)
	{
		return view('admin/users/edit', ['user' => User::findOrFail($id)]);
	}

	public function editAction(Request $request, $id)
	{
		$user = User::findOrFail($id);

		if ($request->filled('password')) {
			$this->validate($request, [
				'password' => 'required|string|min:3|confirmed',
			]);
			
			$user->password = Hash::make($request->password);
		}

		if ($request->email != $user->email) {
			$this->validate($request, [
				'email' => 'required|string|email|max:255|unique:users',
			]);
			$user->email = $request->email;
			
			if ($request->send_email == "true") {
				$confirmation = Users_Confirmations::create([
					'user_id' => $user->id,
					'email' => $user->email,
					'selector' => uniqid(),
					'token' => md5(uniqid())
				]);

				Mail::to($user->email)->send(new UserEmailConfirmations($confirmation));
				session()->flash('warning', 'На указанный email было отправлено письмо для подтверждения.');
			} else {
				$user->email_confirm = 1;
			}
		}
		
		if ($request->name != $user->name) {
			$this->validate($request, [
				'name' => 'required|string|max:255|unique:users',
			]);
			$user->name = $request->name;
		}

		if (filled($request->file('avatar'))) {

			$this->validate($request, [
				'avatar' => 'image',
			]);

			Storage::delete('public/' . $user->avatar);

			$path = $request->file('avatar')->store('public/avatars');
			$path = str_after($path, 'public/');
			$user->avatar = str_after($path, 'public/');
		}

		$this->validate($request, [
			'activity' => 'integer',
			'roles' => 'integer',
			'status' => 'integer',

			'work_place' => 'nullable|string|max:100',
			'phone' => 'nullable|string|max:20',
			'address' => 'nullable|string|max:100',

			'vk' => 'nullable|string|max:50',
			'telegram' => 'nullable|string|max:50',
			'instagram' => 'nullable|string|max:50',

			'about' => 'nullable|string|max:200'
		]);

		$user->activity = $request->activity;
		$user->roles = $request->roles;
		$user->status = $request->status;

		$user->work_place = $request->work_place;
		$user->phone = $request->phone;
		$user->address = $request->address;

		$user->vk = $request->vk;
		$user->telegram = $request->telegram;
		$user->instagram = $request->instagram;

		$user->about = $request->about;

		$user->save();


		session()->flash('success', 'Профиль пользователя отредактирован');
		return redirect('admin/users/edit/id=' . $user->id);
	}

	public function deleteAction($id)
	{
		$user = User::findOrFail($id);
		Storage::delete('public/' . $user->avatar);

		Users_Confirmations::where('user_id', $user->id)->delete();
		
		$user->delete();
		session()->flash('warning', 'Пользователь с id '. $user->id . ' был удален!');
		return redirect('admin/users');
	}
}
