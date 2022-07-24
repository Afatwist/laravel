@php
use App\MyServices\Roles;
@endphp
<div class="row">
	<div class="col-xl-12">

		@auth
		@if(Auth::user()->roles==Roles::ADMIN)
		<a class="btn btn-success" href="/admin/users/create/">Добавить</a>
		@endif
		@endauth
		<div class="border-faded bg-faded p-3 mb-g d-flex mt-3">
			<input type="text" id="js-filter-contacts" name="filter-contacts"
				class="form-control shadow-inset-2 form-control-lg" placeholder="Найти пользователя">
			<div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3" data-toggle="buttons">
				<label class="btn btn-default active">
					<input type="radio" name="contactview" id="grid" checked="" value="grid"><i class="fas fa-table"></i>
				</label>
				<label class="btn btn-default">
					<input type="radio" name="contactview" id="table" value="table"><i class="fas fa-th-list"></i>
				</label>
			</div>
		</div>
	</div>
</div>