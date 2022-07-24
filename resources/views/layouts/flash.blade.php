@if (session()->has('success'))
<div class="alert alert-success">
	{!! session()->get('success') !!}
</div>
@endif

@if (session()->has('warning'))
<div class="alert alert-warning">
	{!! session()->get('warning') !!}
</div>
@endif

@if (session()->has('info'))
<div class="alert alert-info">
	{!! session()->get('info') !!}
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif