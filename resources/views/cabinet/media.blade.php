@php
use App\MyServices\Activity;
use App\MyServices\Roles;
use App\MyServices\Status;

use App\MyServices\Helpers;
@endphp
@extends('layouts.usershow')

@section('title', 'Laravel - Edit Media Info')
@section('topic_icon', 'fa-image')
@section('topic', 'Личный кабинет: '.$user->name .'.Загрузить аватар и рассказать о себе')

@section('content')

@include('layouts.cabinet_top_menu')


<form action="/cabinet/id={{ $user->id }}/media" enctype="multipart/form-data" method="POST">
	<input name="id" value="{{ $user->id }}" type="hidden">
	@csrf
	<div class="row">
		<div class="col-xl-6">
			<div id="panel-1" class="panel">
				<div class="panel-container">
					<div class="panel-hdr">
						<h2>Текущий аватар</h2>
					</div>
					<div class="panel-content">
						<div class="form-group">

							<img src="{{ Helpers::getAvatar($user->avatar) }}" alt="" class="img-responsive" width="200">
						</div>

						<div class="form-group">
							<label class="form-label" for="example-fileinput">Выберите аватар</label>
							<input name='avatar' type="file" id="example-fileinput" class="form-control-file">
						</div>

						<div class="form-group">
							<label class="form-label" for="simpleinput">
								Информация о себе 
							</label>
							<textarea name="about" rows="10" id="simpleinput" class="form-control" >{{ $user->about }}</textarea>
						</div>

						<div class="col-md-12 mt-3 d-flex flex-row-reverse">
							<button class="btn btn-warning">Отправить</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection