<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_Confirmations extends Model
{
	/**
	 * Связанная с моделью таблица.
	 *
	 * @var string
	 */
	protected $table = 'users_confirmations';

	protected $guarded = [];
	
}
