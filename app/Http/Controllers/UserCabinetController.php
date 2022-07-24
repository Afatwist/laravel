<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\PasswordCheck;
use App\Rules\IdCheck;
use App\User;
use App\Users_Confirmations;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserEmailConfirmations;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class UserCabinetController extends Controller
{
	/** Главная страница */
	public function index($id)
	{
		return view('cabinet/index', ['user' => User::findOrFail($id)]);
	}

	/** Изменение регистрационных данных. Форма */
	public function security($id)
	{
		return view('cabinet/security', ['user' => User::findOrFail($id)]);
	}

	/** Изменение регистрационных данных. Обработчик */
	public function securityAction(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$this->validate($request, [
			'id' => ['required', new IdCheck($id)],
			'current_password' => ['required', new PasswordCheck()],
		]);

		if ($request->email != $user->email) {
			$this->validate($request, [
				'email' => 'required|string|email|max:255|unique:users',
			]);

			$confirmation = Users_Confirmations::create([
				'user_id' => $user->id,
				'email' => $request->email,
				'selector' => uniqid(),
				'token' => md5(uniqid())
			]);

			Mail::to($request->email)->send(new UserEmailConfirmations($confirmation));

			session()->flash('warning', 'На указанный email было отправлено письмо для подтверждения.');
		}

		if ($request->name != $user->name) {
			$this->validate($request, [
				'name' => 'required|string|max:255|unique:users',
			]);
			$user->name = $request->name;
			$user->save();
		}

		if ($request->filled('new_password')) {
			$this->validate($request, [
				'new_password' => 'required|string|min:3|confirmed',
			]);
			$user->password = Hash::make($request->new_password);
			$user->save();
		}
		session()->flash('success', 'Данные изменены');
		return redirect('/cabinet/id=' . $id);
	}

	/** Изменение активности. Форма */
	public function activity($id)
	{
		return view('cabinet/activity', ['user' => User::findOrFail($id)]);
	}

	/** Изменение активности. Обработчик */
	public function activityAction(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$this->validate($request, [
			'id' => ['required', new IdCheck($id)],
			'new_activity' => 'required|integer'
		]);
		$user->activity = $request->new_activity;
		$user->save();

		session()->flash('success', 'Активность изменена');
		return redirect('/cabinet/id=' . $id);
	}

	/** Изменение общей информации. Форма */
	public function general($id)
	{
		return view('cabinet/general', ['user' => User::findOrFail($id)]);
	}

	/** Изменение общей информации. Обработчик */
	public function generalAction(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$this->validate($request, [
			'id' => ['required', new IdCheck($id)],
			'work_place' => 'string|max:35',
			'phone' => 'digits_between:9,12',
			'address' => 'string|max:50',
		]);

		$user->work_place = $request->work_place;
		$user->phone = $request->phone;
		$user->address = $request->address;
		$user->save();

		session()->flash('success', 'Данные изменены');
		return redirect('/cabinet/id=' . $id);
	}

	/** Изменение контактов в социальных сетях. Форма */
	public function social($id)
	{
		return view('cabinet/social', ['user' => User::findOrFail($id)]);
	}

	/** Изменение контактов в социальных сетях. Обработчик */
	public function socialAction(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$this->validate($request, [
			'id' => ['required', new IdCheck($id)],
			'vk' => 'string|max:50',
			'telegram' => 'string|max:50',
			'instagram' => 'string|max:50',
		]);

		$user->vk = $request->vk;
		$user->telegram = $request->telegram;
		$user->instagram = $request->instagram;
		$user->save();

		session()->flash('success', 'Данные изменены');
		return redirect('/cabinet/id=' . $id);
	}

	/** Изменение аватарки и "о себе". Форма */
	public function media($id)
	{
		return view('cabinet/media', ['user' => User::findOrFail($id)]);
	}

	/** Изменение аватарки и "о себе". Форма */
	public function mediaAction(Request $request, $id)
	{
		$user = User::findOrFail($id);

		$this->validate($request, [
			'id' => ['required', new IdCheck($id)],
			'avatar' => 'image',
			'about' => 'string|max:200'
		]);

		Storage::delete('public/' . $user->avatar);

		$path = $request->file('avatar')->store('public/avatars');

		$user->avatar = str_after($path, 'public/');
		$user->about = $request->about;
		$user->save();

		session()->flash('success', 'Данные изменены');
		return redirect('/cabinet/id=' . $id);
	}

	/** Удаление профиля. Форма */
	public function delete($id)
	{
		return view('cabinet/delete', ['user' => User::findOrFail($id)]);
	}

	/** Удаление профиля. Обработчик */
	public function deleteAction(Request $request, $id)
	{
		$user = User::findOrFail($id);

		$this->validate($request, [
			'id' => ['required', new IdCheck($id)],
			'current_password' => ['required', new PasswordCheck()],
			'sure' => 'required|accepted'

		]);

		Storage::delete('public/' . $user->avatar);

		$user->delete();
		session()->flash('warning', 'Профиль удален!');
		return redirect('/');
	}
}
