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
	      					@if (Auth::check() && Auth::user()->id == $discussion->user_id)
	      						<a class="btn btn-lg btn-primary pull-right" href="/discussions/{{ $discussion->id }}/edit" role="button">修改帖子</a>
	      					@endif
	      				</h4>
	      				{{ $discussion->user->name }}
	      			</div>
	      		</div>
	      	</div>
	    </div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-9" role='main' id="post">
					{{-- 内容 --}}
					<div class="blog-post">
					{!! $html !!}
		            </div>
		            <hr>
		            {{-- 评论 --}}
		            @foreach ($discussion->comments as $comment)
		            	<div class="media list-wrap">
		            		<a class="pull-left avatar-wrap" href="#">
		            			<img class="media-object img-circle avatar" src="{{ $comment->user->avatar }}">
		            		</a>
		            		<div class="media-body">
		            			<h4 class="media-heading">{{ $comment->user->name }}</h4>
		            			<p>{{ $comment->body }}</p>
		            		</div>
		            	</div>
		            @endforeach
		            @if (Auth::check())
		            <div class="media list-wrap" v-for="comment in comments">
		            	<a class="pull-left avatar-wrap" href="#">
		            		<img class="media-object img-circle avatar" :src='comment.avatar'>
		            	</a>
		            	<div class="media-body">
		            		<h4 class="media-heading">@{{ comment.name }}</h4>
		            		<p>@{{ comment.body }}</p>
		            	</div>
		            </div>
		            @endif
		            <hr>
					@if (Auth::check())
			            {!! Form::open(['url'=>'/comments','v-on:submit'=>'onSubmitForm']) !!}
			            {!! Form::hidden('discussion_id', $discussion->id) !!}
			            <div class="form-group">
			            	{!! Form::textarea('body', null, ['class'=>'form-control','v-model'=>"newComment.body"]) !!}
			            </div>
			            {!! Form::submit('发表评论', ['class'=>'btn btn-success pull-right']) !!}
			            {!! Form::close() !!}
		            @else
		            	<a href="/user/login" class="btn btn-success btn-block">登录参与评论</a>
					@endif
				</div>
			</div>
		</div>

	</div>
    @if (Auth::check())
	<script>
		Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
		new Vue({
			el:'#post',
			data:{
				comments:[],
				newComment:{
					name:'{{Auth::user()->name}}',
					avatar:'{{Auth::user()->avatar}}',
					body:''
				},
				newPost:{
					discussion_id:'{{$discussion->id}}',
					user_id:'{{Auth::user()->id}}',
					body:'',
				}
			},
			methods:{
				onSubmitForm:function(e){
					e.preventDefault();
					var comment = this.newComment,
						postData = this.newPost;
					postData.body = comment.body;

					// 提交服务器
					this.$http.post('/comments', postData).then(res => {
						this.comments.push(comment); // 异步加载数据
					});
					// 置空textarea
					this.newComment = {
						name:'{{Auth::user()->name}}',
						avatar:'{{Auth::user()->avatar}}',
						body:''
					};
				}
			}
		})
	</script>
	@endif
@stop()