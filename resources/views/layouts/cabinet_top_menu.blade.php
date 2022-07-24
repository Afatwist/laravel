<div>
	<h3>Действия с профилем:</h3>

	<a class="btn btn-warning" href="/cabinet/id={{ $user->id }}/security">
		<i class="fa fa-lock"></i>
		Изменить регистрационные данные</a>
	<a class="btn btn-primary" href="/cabinet/id={{ $user->id }}/general">
		<i class="fa fa-edit"></i>
		Редактировать общую информацию</a>
	<a class="btn btn-info" href="/cabinet/id={{ $user->id }}/activity">
		<i class="fa fa-edit"></i>
		Изменить Активность</a>
	<a class="btn btn-secondary" href="/cabinet/id={{ $user->id }}/media">
		<i class="fa fa-camera"></i>
		Изменить автар и рассказать о себе</a>
	<a class="btn btn-success" href="/cabinet/id={{ $user->id }}/social">
		<i class="fa fa-sun"></i>
		Изменить контакты в соцсетях</a>
	<a class="btn btn-danger" href="/cabinet/id={{ $user->id }}/delete" onclick="return confirm('are you sure?');">
		<i class="fa fa-window-close"></i>
		Удалить профиль</a>
	<br />
	<a class="btn btn-success" href="/cabinet/id=<?= $user->id ?>">
		<i class="fa fa-sun"></i>
		Кабинет</a>
	<br />
	<hr />
</div>
<br /><br />