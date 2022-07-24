@php
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

use App\MyServices\Helpers;

use Carbon\Carbon;
$today = Carbon::now();
@endphp
@extends('layouts.usershow')

@section('title', 'Laravel - User list for Admin')
@section('topic_icon', 'fa-user')
@section('topic', 'Списки всех пользователей')

@section('content')

<h2>Список всех пользователей</h2>
<a class="btn btn-success" href="/admin/users/create">
	<i class="fa fa-sun"></i>
	Создать пользователя вручную</a><br />
<a class="btn btn-warning" href="/admin/users/createFakerUser">
	<i class="fa fa-sun"></i>
	Сгенерировать пользователя автоматически</a>
	<br/><br/>
<table class="table m-0">
	<thead>
		<tr>
			<th>id</th>
			<th>Аватар</th>
			<th>Логин</th>
			<th>E-mail</th>
			<th>Роль</th>
			<th>Статус</th>
			<th>Активность</th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<th scope="row"> {{ $user->id }} </th>
			<td>
				<img src="{{ Helpers::getAvatar($user->avatar) }}" width="75">
			</td>
			<td> {{ $user->name }} </td>
			<td> {{ $user->email }} </td>
			<td> {{ Roles::getRole($user->roles) }} </td>
			<td> {{ Status::getStatus($user->status) }} </td>
			<td> {{ Activity::getActivity($user->activity) }} </td>
			<td>
				<!-- Меню действий -->
				<a href="/users/profile/id={{ $user->id }}" class="btn btn-info">Посмотреть</a>
				<a href="/admin/users/edit/id={{ $user->id }}" class="btn btn-warning">Изменить</a>
				<a href="/admin/users/delete/id={{ $user->id }}" class="btn btn-danger"
					onclick="return confirm('are you sure?');">Удалить</a>
				<!-- Конец меню действий -->
			</td>
		</tr>
		@endforeach

	</tbody>
</table>

<br /><br /><hr /><hr /><br /><br />
<h2>Список пользователей ожидающих подтверждения регистрации</h2>
<table class="table m-0">
	<thead>
		<tr>
			<th>id</th>
			<th>Аватар</th>
			<th>Логин</th>
			<th>E-mail</th>
			<th>Роль</th>
			<th>Статус</th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		
		@continue($user->status != Status::PENDING_REVIEW)
		
		<tr>
			<th scope="row"> {{ $user->id }} </th>
			<td>
				<img src="{{ Helpers::getAvatar($user->avatar) }}" width="75">
			</td>
			<td> {{ $user->name }} </td>
			<td> {{ $user->email }} </td>
			<td> {{ Roles::getRole($user->roles) }} </td>
			<td> {{ Status::getStatus($user->status) }} </td>
			<td>
				<!-- Меню действий -->
				<a href="/users/profile/id={{ $user->id }}" class="btn btn-info">Посмотреть</a>
				<a href="/admin/users/edit/id={{ $user->id }}" class="btn btn-warning">Изменить</a>
				<a href="/admin/users/delete/id={{ $user->id }}" class="btn btn-danger"
					onclick="return confirm('are you sure?');">Удалить</a>
				<!-- Конец меню действий -->
			</td>
		</tr>
		@endforeach

	</tbody>
</table>

<br/><br/><hr/><hr/><br/><br/>
<h2>Пользователи неподтвердившие свой Email</h2>
<table class="table m-0">
	<thead>
		<tr>
			<th>id</th>
			<th>Логин</th>
			<th>E-mail</th>
			<th>Дата регистрации</th>
			<th>Прошло дней после регистрации</th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)		
		@continue($user->email_confirm!=0)	
		<tr>

			<th scope="row">{{ $user->id }}</th>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<th scope="row">{{ $user->created_at}}</th>
			<th scope="row">{{ $today->diffInDays($user->created_at) }}</th>

			<td>
				<!-- Меню действий -->
				<a href="/admin/users/delete/id={{ $user->id }}" class="btn btn-danger"
					onclick="return confirm('are you sure?');">Удалить</a>
				<a href="/users/profile/id={{ $user->id }}" class="btn btn-warning">Посмотреть</a>
				<!-- Конец меню действий -->
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection