@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2" role='main'>
				@if ($errors->any())
					@foreach ($errors->all() as $error)
						<li class="list-group-item list-group-item-danger">{{ $error }}</li>
					@endforeach
				@endif
				{!! Form::model($discussion,['method'=>'PATCH','url'=>'/discussions/'.$discussion->id]) !!}
				@include('forum.form', ['id' => $discussion->id])
				<div>
					{!! Form::submit('更新帖子', ['class'=>'btn btn-primary pull-right']) !!}
				</div>
			</div>
		</div>
	</div>
@stop