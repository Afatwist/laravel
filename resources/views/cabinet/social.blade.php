@php
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

use App\MyServices\Helpers;
@endphp
@extends('layouts.usershow')

@section('title', 'Laravel - Edit Social info')
@section('topic_icon', 'fa-plus-circle')
@section('topic', 'Личный кабинет: '.$user->name .'.Изменить контакты социальных сетей')

@section('content')

@include('layouts.cabinet_top_menu')

<form action="/cabinet/id={{ $user->id }}/social" method="POST">
	<input type="hidden" name="id" value="{{ $user->id }}">
	@csrf
	<div class="col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-container">
				<div class="panel-hdr">
					<h2>Социальные сети</h2>
				</div>
				<div class="panel-content">
					<div class="row">
						<div class="col-md-4">
							<!-- vk -->
							<div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text bg-transparent border-right-0 py-1 px-3">
										<span class="icon-stack fs-xxl">
											<i class="base-7 icon-stack-3x" style="color:#4680C2"></i>
											<i class="fab fa-vk icon-stack-1x text-white"></i>
										</span>
									</span>
								</div>
								<input name="vk" type="text" class="form-control border-left-0 bg-transparent pl-0" value="{{ $user->vk }}">
							</div>
						</div>
						<div class="col-md-4">
							<!-- telegram -->
							<div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text bg-transparent border-right-0 py-1 px-3">
										<span class="icon-stack fs-xxl">
											<i class="base-7 icon-stack-3x" style="color:#38A1F3"></i>
											<i class="fab fa-telegram icon-stack-1x text-white"></i>
										</span>
									</span>
								</div>
								<input name="telegram" type="text" class="form-control border-left-0 bg-transparent pl-0" value="{{ $user->telegram }}">
							</div>
						</div>
						<div class="col-md-4">
							<!-- instagram -->
							<div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text bg-transparent border-right-0 py-1 px-3">
										<span class="icon-stack fs-xxl">
											<i class="base-7 icon-stack-3x" style="color:#E1306C"></i>
											<i class="fab fa-instagram icon-stack-1x text-white"></i>
										</span>
									</span>
								</div>
								<input name="instagram" type="text" class="form-control border-left-0 bg-transparent pl-0" value="{{ $user->instagram }}">
							</div>
						</div>
						<div class="col-md-12 mt-3 d-flex flex-row-reverse">
							<button class="btn btn-success">Изменить</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	</div>
</form>
@endsection