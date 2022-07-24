@php
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

use App\MyServices\Helpers;
@endphp

@extends('layouts.usershow')

@section('title', 'Laravel - Activity Change')
@section('topic_icon', 'fa-sun')
@section('topic', 'Личный кабинет: '.$user->name .'. Установить статус активности')

@section('content')

@include('layouts.cabinet_top_menu')
<!--  Начало формы -->
<form action="/cabinet/id={{ $user->id }}/activity" method="POST">
	@csrf
	<input type="hidden" name="id" value="{{ $user->id }}">
	<div class="row">
		<div class="col-xl-6">
			<div id="panel-1" class="panel">
				<div class="panel-container">
					<div class="panel-hdr">
						<h2>Текущий статус активности {{ Activity::getActivity($user->activity) }} </h2>
					</div>
					<div class="panel-content">
						<div class="row">
							<div class="col-md-4">
								<!-- activity status -->
								<div class="form-group">
									<label class="form-label" for="example-select">Выберите статус</label>
									<select name="new_activity" class="form-control" id="example-select">
										@foreach (Activity::getActivityList() as $activity)
										<option
											@if($user->activity == $activity['id'])
											selected
											@endif
											 value="{{ $activity['id']}}">{{ $activity['title'] }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-12 mt-3 d-flex flex-row-reverse">
								<button class="btn btn-warning">Set Status</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Конец формы -->
@endsection