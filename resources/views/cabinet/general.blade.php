@php
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

use App\MyServices\Helpers;
@endphp
@extends('layouts.usershow')

@section('title', 'Laravel - Edit General Info')
@section('topic_icon', 'fa-plus-circle')
@section('topic', 'Личный кабинет: '.$user->name .'. Изменить общую информацию')

@section('content')

@include('layouts.cabinet_top_menu')

<form action="/cabinet/id={{ $user->id }}/general" method="POST">
	<input type="hidden" name="id" value="{{ $user->id }}">
	@csrf
	<div class="row">
		<div class="col-xl-6">
			<div id="panel-1" class="panel">
				<div class="panel-container">
					<div class="panel-hdr">
						<h2>Общая информация</h2>
					</div>
					<div class="panel-content">

						<!-- work place -->
						<div class="form-group">
							<label class="form-label" for="work_place">Место работы</label>
							<input name="work_place" type="text" id="work_place" class="form-control"
								placeholder="{{ $user->work_place }}" value="{{ $user->work_place }}">
						</div>

						<!-- tel -->
						<div class="form-group">
							<label class="form-label" for="phone">Номер телефона</label>
							<input name="phone" type="text" id="phone" class="form-control" placeholder="{{ $user->phone }}"
								value="{{ $user->phone }}">
							<div class="help-block">Телефонный номер водите в указанном формате: 1 123-123-1234</div>
						</div>

						<!-- address -->
						<div class=" form-group">
							<label class="form-label" for="address">Адрес</label>
							<input name="address" type="text" id="address" class="form-control"
								placeholder="{{ $user->address }}" value="{{ $user->address }}">
						</div>
						<div class="col-md-12 mt-3 d-flex flex-row-reverse">
							<button class="btn btn-warning">Редактировать</button>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection