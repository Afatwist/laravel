<?php

namespace App\MyServices;


use Illuminate\Support\Facades\Storage;

/**
 * Свои хелперы для упрощения работы 
 */
class Helpers
{
	/**
	 *  ссылка на автарку-заглушку 
	 * @var string 
	 */
	private const AVATAR_NOT = '/storage/avatar_not/avatar.png';

	/**
	 * Проверяет наличие аватара, если нет, то выводит заглушку
	 * @param string $userAvatar название аватара из БД
	 * @return string ссылка на аватар или на заглушку
	 */
	public static function getAvatar($userAvatar = null)
	{
		if ($userAvatar === null) {
			return self::AVATAR_NOT;
		}
		if (!Storage::exists('public/' . $userAvatar)) {
			return self::AVATAR_NOT;
		}
		return '/storage/' . $userAvatar;
	}

	/**
	 *  конвертация имени пользователя в тег
	 * @param string $username 
	 * @return string in lowercase
	 */
	public static function name_to_tag($username)
	{
		if (filled($username)) {
			$username = strtolower($username);
		}
		return $username;
	}

	/**
	 *  конвертация номера телефона пользователя в тег
	 * @param string $phone 
	 * @return string only digit
	 */ 
	public static function phone_to_tag($phone)
	{
		if (filled($phone)) {
			$phone = str_replace(['+', '-', ' ', '(', ')'], '', $phone);
		}
		return $phone;
	}
}
