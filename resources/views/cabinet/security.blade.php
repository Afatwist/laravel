@php
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

use App\MyServices\Helpers;
@endphp
@extends('layouts.usershow')

@section('title', 'Laravel - Registration Data Change')
@section('topic_icon', 'fa-lock')
@section('topic', 'Личный кабинет: '.$user->name .'. Изменение регистрационныз данных')

@section('content')

@include('layouts.cabinet_top_menu')

<form action="/cabinet/id={{ $user->id }}/security" method="POST">
	<input name="id" value="{{ $user->id }}" type="hidden">
	@csrf
	<div class="row">
		<div class="col-xl-6">
			<div id="panel-1" class="panel">
				<div class="panel-container">
					<div class="panel-hdr">
						<h2>Обновить эл. адрес, имя или пароль</h2>
					</div>
					<div class="panel-content">
						<!-- email -->
						<div class="form-group">
							<label class="form-label" for="simpleinput">Email</label><h3>При обновлении Email вы не сможете совершать дальнейшие действия, пока не подтвердите новый почтовый адрес</h3>
							<input name="email" type="text" id="simpleinput" class="form-control" placeholder="{{ $user->email }}" value="{{ $user->email }}">
						</div>

						<!-- username-->
						<div class="form-group">
							<label class="form-label" for="simpleinput">Username</label>
							<input name="name" type="text" id="simpleinput" class="form-control" placeholder="{{ $user->name }}" value="{{ $user->name }}">
						</div>
						При обновлении электронной почты или имени пользователя не забудьте указать свой текущий пароль
						<!-- current password -->
						<div class="form-group">
							<label class="form-label" for="simpleinput">Текущий Пароль</label>
							<input name="current_password" type="password" id="simpleinput" class="form-control">
						</div>

						<!-- new password -->
						<div class="form-group">
							<label class="form-label" for="simpleinput">Новый Пароль</label>
							<input name="new_password" type="password" id="simpleinput" class="form-control">
						</div>

						<!-- password confirmation-->
						<div class="form-group">
							<label class="form-label" for="simpleinput">Подтверждение пароля</label>
							<input name="new_password_confirmation" type="password" id="simpleinput" class="form-control">
						</div>

						<div class="col-md-12 mt-3 d-flex flex-row-reverse">
							<button class="btn btn-warning">Изменить</button>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</form>
@endsection