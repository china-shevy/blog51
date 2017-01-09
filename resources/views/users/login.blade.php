@extends('app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3" role="main">
				@if ($errors->any())
					<ul class="list-group">
						@foreach ($errors->all() as $error)
						<li class="list-group-item list-group-item-danger">{{ $error }}</li>
						@endforeach
					</ul>				
				@endif
				@if (Session::has('user_login_failed'))
					<div class="alert alert-danger" role="alert">
						{{ Session::get('user_login_failed') }}
					</div>
				@endif
				{!! Form::open(['url'=>'/user/login']) !!}
					<div class="form-group">
						{!! Form::label('email', '账号:') !!}
						{!! Form::text('email', null, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('password', '密码:') !!}
						{!! Form::password('password', ['class'=>'form-control']) !!}
					</div>
					{!! Form::submit('登录', ['class'=>'btn btn-success form-control']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop