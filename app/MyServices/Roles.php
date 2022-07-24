<?php

namespace App\MyServices;

class Roles
{
	const ADMIN = 1;
	const MODERATOR =	2;
	const USER = 3;

	public static function getRoleList()
	{
		return [
			[
				'id'     =>   self::USER,
				'title'  =>   'Обычный пользователь',
				'style'  =>   'info'
			],
			[
				'id'     =>   self::ADMIN,
				'title'  =>   'Администратор',
				'style'  =>   'warning'
			],
			[
				'id'     =>   self::MODERATOR,
				'title'  =>   'Модератор',
				'style'  =>   'success'
			]
		];
	}

	public static function getRole($key)
	{
		foreach (self::getRoleList() as $role) {
			if ($role['id'] == $key) {
				return $role['title'];
			}
		}
	}

	public static function getStyle($key)
	{
		foreach (self::getRoleList() as $role) {
			if ($role['id'] == $key) {
				return $role['style'];
			}
		}
	}
}
