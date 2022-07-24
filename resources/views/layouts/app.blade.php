<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
	<title>@yield('title')</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

	<!-- Styles -->
	{{--
	<link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
	<link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
</head>

<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/">Homepage</a></li>
					<li><a href="/about">About</a></li>
					<li><a href="/contacts">Contacts</a></li>

					<!-- Authentication Links -->
					@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
					@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
					@endguest
				</ul>

			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>


	<div class="container">
		<div class="row">
			<div class="col-xl-12">

				@include('layouts.flash')

				@yield('content')

				<h2>У вас есть следующие возможности:</h2>
				<ul>
					<h3>Доступ для всех:</h3>
					<li><a href="/">Главная</a></li>
					<li><a href="/about">О нас</a></li>
					<li><a href="/contacts">Контакты</a></li>
					<hr />
					<h3>Доступ для неавторизованнных:</h3>
					<li><a href="/register">Регистрация</a></li>
					<li><a href="/login">Войти в систему</a></li>
					<hr />
					<h3>Доступ для авторизованнных:</h3>
					<li><a href="/logout">Выйти из системы</a></li>
					<br>
					<h4>Показатать пользователей:</h4>
					<li><a href="/userlist">Показать всех пользователей</a></li>
					<li><a href="/profile/id={{ Auth::user()->id }}">Профиль пользователя</a></li>
					<li><a href="/paginator">Пагинация</a></li>
					<hr />
					<h3>Доступ для владельца профиля / личный кабинет:</h3>
					<li><a href="/cabinet/id={{ Auth::user()->id }}/index">Главная страница кабинета</a></li>
					<li><a href="/cabinet/id={{ Auth::user()->id }}/security">Изменить регистрационные данные</a></li>
					<li><a href="/cabinet/id={{ Auth::user()->id }}/activity">Изменить статус активности</a></li>
					<li><a href="/cabinet/id={{ Auth::user()->id }}/general">Изменить общую информацию</a></li>
					<li><a href="/cabinet/id={{ Auth::user()->id }}/social">Изменить контакты в соцсетях</a></li>
					<li><a href="/cabinet/id={{ Auth::user()->id }}/media">Изменить аватар или информацию о себе</a></li>
					<li><a href="/cabinet/id={{ Auth::user()->id }}/delete">Удалить профиль</a></li>
					<hr />
					<h3>Доступ для админа:</h3>
					<li><a href="/admin/index">Главная страница админки</a></li>
					<br>
					<h4>Работа с пользователями:</h4>
					<li><a href="/admin/users/">Списки пользователей</a></li>
					<li><a href="/admin/users/create/">Создать пользователя вручную</a></li>
					<li><a href="/admin/users/createFakerUser">Создать фейковый аккаунт</a></li>
					<li><a href="/admin/users/edit/id={{ Auth::user()->id }}">Редактировать профиль пользователя</a></li>
					<li><a href="/admin/users/delete/id={{ Auth::user()->id }}">Удалить профиль пользователя</a></li>
				</ul>
			</div>
		</div>
	</div>


</body>

</html>