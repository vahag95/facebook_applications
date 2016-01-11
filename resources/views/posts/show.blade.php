@extends('layouts.main')

@section('title')

	{{$title}}

@stop

@section('header')

	@include('posts._header')

@stop

@section('content')
<div class="row">
	<div class="col-md-12" style="border-bottom:1px solid #EEEEEE;">

		<p class="text-center" style="font-family: Georgia, Times New Roman, Times, serif;">
			{{{$post->updated_at}}} by
			@if(Auth::check() && Auth::user()->id === $post->user_id)
				<a href="#">Me</a>
			@else
				<a href="#">{{{ $post->user?$post->user->name:'User deleted' }}}</a>
			@endif

		</p>
		<p class="text-center" style="font-family: Georgia, Times New Roman, Times, serif;">
			Categories: 
			@if(count($post->categories))
				@foreach($post->categories as $category)
            		<a href="{!!url('/category/'.$category->id)!!}">{{{$category->title}}}</a>,	
            	@endforeach
			<a href="#">...</a>
			@else 
				Single Post
			@endif
		</p>
			<img src="{!!url('/images/'.$post->image)!!}" class="img-thumbnail center-block" alt="{{{$post->title}}}" width="304" height="236" > 
		<p class="text-center">
			{{{$post->description}}}
		</p>
		<p class="text-center">
			@if(Auth::check() && Auth::user()->id === $post->user_id)	
				<a class="btn btn-warning btn-sm" href="{{url('/post/'.$post->id.'/edit')}}" role="button">Edit »</a>
			@endif
		</p>
			@if(Auth::check() && Auth::user()->id === $post->user_id)	
			<div class="text-center" onclick="return confirm('Are you sure')">
				{!! Form::open(array('url' => '/post/'.$post->id, 'method' => 'DELETE')) !!}
					{!! Form::submit('Delete!', array('class'=>'btn btn-danger btn-sm')) !!}
				{!! Form::close() !!}
			</div>
			@endif
	</div>
</div>
@stop