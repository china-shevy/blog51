@extends('app')
	
@section('content')
	<div class="public-wrap index-wrap">
		
		<div class="jumbotron">
	      	<div class="container">
	        	<h2>欢迎来到Phil Home社区
	        		<a class="btn btn-lg btn-primary pull-right" href="../../components/#navbar" role="button">发布新的帖子</a>
	      		</h2>
	      	</div>
	    </div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-9" role='main'>
					@foreach ($discussions as $discussion)
						<div class="media list-wrap">
							<a class="media-left avatar-wrap" href="#">
								<img class="media-object img-circle avatar" src="{{$discussion->user->avatar}}" alt="Image">
							</a>
							<div class="media-body">
								<h4 class="media-heading"><a href="/discussions/{{ $discussion->id }}">{{$discussion->title}}</a></h4>
								{{$discussion->user->name}}
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>

	</div>

@stop()