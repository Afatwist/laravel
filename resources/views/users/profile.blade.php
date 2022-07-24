@php
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

use App\MyServices\Helpers;
@endphp

@extends('layouts.usershow')

@section('title', 'Laravel - Profile of '. $user->name)
@section('topic_icon', 'fa-user')
@section('topic', 'Профиль пользователя: '. $user->name)

@section('content')

<div class="row">
	<div class="col-lg-6 col-xl-6 m-auto">
		<!-- profile summary -->
		<div class="card mb-g rounded-top">
			<div class="row no-gutters row-grid">

				<div class="col-12">
					<div class="d-flex flex-column align-items-center justify-content-center p-4">

						<img src="{{ Helpers::getAvatar($user->avatar) }}" class="rounded-circle shadow-2 img-thumbnail" alt="">
						<h5 class="mb-0 fw-700 text-center mt-3">
							{{ $user->name }}
							<small class="text-muted mb-0">{{ $user->work_place }}</small>
						</h5>

						<div class="mt-4 text-center demo">
							<a href="javascript:void(0);" class="fs-xl" style="color:#C13584">
								<i class="fab fa-instagram">{{ $user->instagram }}</i>
							</a>
							<a href="javascript:void(0);" class="fs-xl" style="color:#4680C2">
								<i class="fab fa-vk">{{ $user->vk }}</i>
							</a>
							<a href="javascript:void(0);" class="fs-xl" style="color:#0088cc">
								<i class="fab fa-telegram">{{ $user->telegram }}</i>
							</a>
						</div>

					</div>
				</div>

				<div class="col-12">
					<div class="col-1"></div>
					<div class="col-9">
						<div> Активность пользователя: {{ Activity::getActivity($user->activity) }}
						</div>
						<div> Статус пользователя: {{ Status::getStatus($user->status) }}</div>
						<div> Роль пользователя: {{ Roles::getRole($user->roles)}}</div>
					</div>
				</div>
				<div class="col-12">
					
					<div class="col-1"></div>
					<div class="col-9">
						О себе:
						{{ $user->about }}
					</div>
					</div>

					<div class="col-12">
						<div class="p-3 text-center">
							<a href="tel:+{{ $user->phone }}" class="mt-1 d-block fs-sm fw-400 text-dark">
								<i class="fas fa-mobile-alt text-muted mr-2"></i> +{{ $user->phone }}</a>
							<a href="mailto:{{ $user->email }}" class="mt-1 d-block fs-sm fw-400 text-dark">
								<i class="fas fa-mouse-pointer text-muted mr-2">{{ $user->email }}</i> </a>
							<address class="fs-sm fw-400 mt-4 text-muted">
								<i class="fas fa-map-pin mr-2"> {{ $user->address }} </i>
							</address>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection