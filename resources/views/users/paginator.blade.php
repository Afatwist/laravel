@php
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

use App\MyServices\Helpers;
@endphp
@extends('layouts.usershow')

@section('title', 'Laravel - Paginator')
@section('topic_icon', 'fa-users')
@section('topic', 'Постраничный вывод пользователей')

@section('content')

@include('layouts.user_search')

<a class="btn btn-success" href="/userlist">
	<i class="fa fa-sun"></i>
	Показать всех пользователей</a>
<!-- Вывод пользователей -->
<div class="row" id="js-contacts">

	@foreach ($users as $user)

	<div class="col-xl-4">
		<div id="c_{{ $user->id }}" class="card border shadow-0 mb-g shadow-sm-hover"
			data-filter-tags="{{ Helpers::name_to_tag($user->name) }}">
			<div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
				<div class="d-flex flex-row align-items-center">
					<span class="status status-{{ Activity::getStyle($user->activity) }} mr-3"
						title="{{  Activity::getActivity($user->activity) }}">
						<span class="rounded-circle profile-image d-block "
							style="background-image:url('{{ Helpers::getAvatar($user->avatar) }}'); background-size: cover;"></span>
					</span>

					<div class="info-card-text flex-1">
						@auth
						@if(Auth::user()->roles==Roles::ADMIN)
						<a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info"
							data-toggle="dropdown" aria-expanded="false">

							<i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
							<i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
						</a>

						<div class="dropdown-menu">
							<a class="dropdown-item" href="/admin/users/edit/id={{ $user->id }}">
								<i class="fa fa-edit"></i>
								Изменить Пользователя</a>
						</div>
						@elseif(Auth::user()->id==$user->id)

						<a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info"
							data-toggle="dropdown" aria-expanded="false">
							<i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
							<i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
						</a>

						<div class="dropdown-menu">
							<a class="dropdown-item" href="/users/cabinet/id={{  $user->id }}">
								<i class="fa fa-edit"></i>
								Кабинет</a>
						</div>

						@endif
						@endauth
						<span class="fs-xl text-truncate text-truncate-lg text-info">
							<b>
								{{ $user->name }}
							</b>
							User ID
							{{ $user->id }}
						</span>

						<span class="text-truncate text-truncate-xl">
							{{ $user->work_place }}
						</span>
						<a href="/users/profile/id={{ $user->id}}>">Профиль</a>
					</div>

					<button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse"
						data-target="#c_{{ $user->id }} > .card-body + .card-body" aria-expanded="false">
						<span class="collapsed-hidden">+</span>
						<span class="collapsed-reveal">-</span>
					</button>

				</div>
			</div>

			<div class="card-body p-0 collapse show">
				<div class="p-3">
					<div> Статус пользователя:
						{{ Status::getStatus($user->status) }}
					</div>

					<div> Роль пользователя:
						{{ Roles::getRole($user->roles) }}
					</div>

					<a href="tel: +{{ Helpers::phone_to_tag($user->phone) }}"
						class="mt-1 d-block fs-sm fw-400 text-dark">
						<i class="fas fa-mobile-alt text-muted mr-2"></i>
						{{ $user->phone }} <br />
					</a>
					<a href="mailto: {{ $user->email }}" class="mt-1 d-block fs-sm fw-400 text-dark">
						<i class="fas fa-mouse-pointer text-muted mr-2"></i>
						{{ $user->email }}
					</a>
					<address class="fs-sm fw-400 mt-4 text-muted">
						<i class="fas fa-map-pin mr-2"></i>
						{{ $user->address}}
					</address>

					<div class="d-flex flex-row">
						<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#4680C2">
							<i class="fab fa-vk"> @
								{{ $user->vk }}
							</i>
						</a>
						<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#38A1F3">
							<i class="fab fa-telegram"> @
								{{$user->telegram }}
							</i>
						</a>
						<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#E1306C">
							<i class="fab fa-instagram"> @
								{{ $user->instagram }}
							</i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>

	@endforeach
	<!-- Конец вывода пользователей -->

</div>
{{ $users->links() }}

<hr />

<div>
	<p>Всего пользователей {{ $users->total() }} .</p>

	<p>Показано с {{ $users->firstItem() }} по {{ $users->lastItem() }}.</p>

	<p>Всего страниц {{ $users->lastPage() }}</p>	
	
</div>

@endsection