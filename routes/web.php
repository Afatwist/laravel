<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ОБЩИЕ СТРАНИЦЫ
Route::get('/', 'HomeController@index');
Route::get('/index', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about', 'HomeController@about');
Route::get('/contacts', 'HomeController@contacts');

// ПОЛЬЗОВАТЕЛИ
/** в этом роуте: регистрация, login, logout, сброс пароля, запомнить меня*/
Auth::routes();
Route::middleware(['guest'])->group(function () {
	Route::get('/confirmation/selector={selector}/token={token}/', 'Auth\ConfirmationController@confirmation');
});

/** Вывод пользователей */
Route::middleware(['auth'])->group(function () {	
	Route::get('/userlist', 'UserShowController@userlist');
	Route::get('/profile/id={id}', 'UserShowController@profile');
	Route::get('/paginator', 'UserShowController@paginator');
});


/** Личный кабинет */
Route::prefix('/cabinet/id={id}')->middleware(['auth', 'profileOwner'])->group(function () {
	// Главная страница личного кабинета
	Route::get('', 'UserCabinetController@index');
	Route::get('/', 'UserCabinetController@index');
	Route::get('/index', 'UserCabinetController@index');

	// Изменение регистрационных данных (имя, емейл, пароль)
	Route::get('/security', 'UserCabinetController@security');
	Route::post('/security', 'UserCabinetController@securityAction');

	// Изменение статуса активности
	Route::get('/activity', 'UserCabinetController@activity');
	Route::post('/activity', 'UserCabinetController@activityAction');

	// Изменение общей информации: место работы, телефон, адрес
	Route::get('/general', 'UserCabinetController@general');
	Route::post('/general', 'UserCabinetController@generalAction');

	// Изменение контактов в социальных сетях
	Route::get('/social', 'UserCabinetController@social');
	Route::post('/social', 'UserCabinetController@socialAction');

	// Изменение Аватарки и "о себе"
	Route::get('/media', 'UserCabinetController@media');
	Route::post('/media', 'UserCabinetController@mediaAction');

	// Удаление профиля
	Route::get('/delete', 'UserCabinetController@delete');
	Route::post('/delete', 'UserCabinetController@deleteAction');
});

/** Админка */
Route::prefix('/admin')->middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
	// главная страница админки
	Route::get('', 'MainController@index');
	Route::get('/', 'MainController@index');
	Route::get('/index', 'MainController@index');

	// Работа с пользователями
	Route::prefix('/users')->group(function () {
		// общая страница пользователей
		Route::get('', 'UserController@index');
		Route::get('/', 'UserController@index');
		Route::get('/index', 'UserController@index');

		// создание пользователя вручную
		Route::get('/create', 'UserController@create');
		Route::post('/create', 'UserController@createAction');

		// создание пользователя автоматически - генератор пользователей
		Route::get('/createFakerUser', 'UserController@createFakerUserAction');

		//	редактирование профиля пользователя
		Route::get('/edit/id={id}', 'UserController@edit');
		Route::post('/edit/id={id}', 'UserController@editAction');

		// удаление пользователя
		Route::get('/delete/id={id}', 'UserController@deleteAction');
	});
});
