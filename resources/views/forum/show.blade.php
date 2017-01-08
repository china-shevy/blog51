@extends('app')
	
@section('content')
	<div class="public-wrap index-wrap">
		
		<div class="jumbotron">
	      	<div class="container">
	      		<div class="media">
	      			<a class="media-left avatar-wrap" href="#">
	      				<img class="media-object img-circle avatar" src="{{ $discussion->user->avatar }}" alt="Image">
	      			</a>
	      			<div class="media-body body-wrap">
	      				<h4 class="media-heading">
	      					{{ $discussion->title }}
	      					<a class="btn btn-lg btn-primary pull-right" href="" role="button">修改帖子</a>
	      				</h4>
	      				{{ $discussion->user->name }}
	      			</div>
	      		</div>
	      	</div>
	    </div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-9" role='main'>
					<div class="blog-post">
					{{ $discussion->body }}
		            </div>
				</div>
			</div>
		</div>

	</div>

@stop()