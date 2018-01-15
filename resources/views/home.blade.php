@extends('layouts.app')

@section('content')
<div id="side-menu">
</div>
<div id="home-container">
	<div id="home-banner-container">
		<img id="home-banner-image" alt="" src="{{ asset('images/banner.jpg')}}">
		<div id="home-banner-info" class="text-center">
			<img class="text-center" src="{{ asset('images/logo.png') }}" alt="">
			<p>Place where you can share captured moments of your life with everyone in the world</p>
			<a class="btn" href="{{ route('gallery-entry.create') }}">Upload</a>
		</div>
	</div>
	<div id="home-gallery-container" class="text-center">
			@foreach ($galleryEntries as $galleryEntry)
			<div class="home-gallery-entry-container text-left">
				<a href="#">
					<div class="gallery-entry-gradient">
					</div>
				</a>
				<img class="gallery-entry-image" src="{{$galleryEntry->image}}"/>
				@auth
				<a href="#" class="gallery-entry-fav">
					<i class="fa fa-star-o" aria-hidden="true"></i>
				</a>
				@endauth
				<h2>{{$galleryEntry->title}}</h2>
				@foreach ($users as $user)
				@if ($galleryEntry->user_id == $user->id)
				<h3>
					<img class="useravatar" src="{{$user->avatar}}"/>&nbsp<a href="{{route('user.index', $user)}}">{{$user->username}}</a>
				</h3>
				@endif
				@endforeach
				<p>
					<span class=""><i class="fa fa-star" aria-hidden="true"></i>&nbsp{{$galleryEntry->favorite_count}}</span>
					<span class=""><i class="fa fa-comment" aria-hidden="true"></i>&nbsp{{$galleryEntry->comment_count}}</span>
				</p>
			</div>
			@endforeach
	</div>
</div>
@endsection
