<?php

use Faker\Generator as Faker;
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->name,
		'email' => $faker->unique()->safeEmail,
		'email_confirm' => 1,
		'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
		'remember_token' => str_random(10),

		'roles' => Roles::USER,
		'status' => Status::PENDING_REVIEW,
		'activity' => Activity::ONLINE,

		'work_place' => $faker->company,
		'phone' => $faker->phoneNumber,
		'address' => $faker->address,

		'vk' => 'vk_' . $faker->name,
		'telegram' => 'tg_' . $faker->name,
		'instagram' => 'inst_' . $faker->name,

		'about' => $faker->text(50),
	];
});
