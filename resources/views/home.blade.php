@extends('layouts.app')
@section('content')
<div id="side-menu">
	<form id="as" class="navbar-form navbar-left" role="search" action="{{route('search')}}" method="get">
		{{ csrf_field() }}
		<h3><a href="#as-panel" data-toggle="collapse">Advanced search</a></h3>
		<hr>
		<div id="as-panel" class="collapse">
			<div class="search-checks form-check">
				<input class="form-check-input" type="checkbox" value="" id="as-title-check" name="as-title-check">
				<label class="form-check-label" for="as-title-check">by title</label>
			</div>
			<div class="search-box form-group toggleable">
				<input type="text" class="form-control" name="title" placeholder="Search for..." id="as-title">
			</div>
			<div class="search-checks form-check">
				<input class="form-check-input" type="checkbox" value="" id="as-tags-check" name="as-tags-check">
				<label class="form-check-label" for="as-tags-check">by tags</label>
			</div>
			<div class="search-box form-group toggleable">
				<input type="text" class="form-control" name="tags" placeholder="Search for..." id="as-tags">
			</div>
			<div class="search-checks form-check">
				<input class="form-check-input" type="checkbox" value="" id="as-user-check" name="as-user-check">
				<label class="form-check-label" for="as-user-check">by user</label>
			</div>
			<div class="search-box form-group toggleable">
				<input type="text" class="form-control" name="user" placeholder="Search for..." id="as-user">
			</div>
			<div class="search-checks form-check">
				<input class="form-check-input" type="checkbox" value="" id="as-category-check" name="as-category-check">
				<label class="form-check-label" for="as-category-check">by category</label>
			</div>
			<div class="toggleable as-categories">
			@foreach ($categories as $category)
			<div class="form-check">
				<input class="form-check-input" type="checkbox" value="">
				<label class="form-check-label">{{$category->name}}</label>
			</div>
			@endforeach
		</div>
		</div>
	</form>
</div>
<div id="home-container">
	<div id="home-banner-container">
		<img id="home-banner-image" alt="" src="{{ asset('images/banner.jpg')}}">
		<div id="home-banner-info" class="text-center">
			<img class="text-center" src="{{ asset('images/logo.png') }}" alt="">
			<p>Place where you can share captured moments of your life with everyone in the world</p>
			<a class="btn" href="{{ route('gallery-entry.create') }}">Submit</a>
		</div>
	</div>
	<div id="home-gallery-container" class="text-left">
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
								<a href="{{route('user.profile', $user)}}"><img src="{{$user->avatar}}"/><span>{{$user->username}}</span></a>
							</h3>
						@endif
					@endforeach
					<p>
						<span class=""><i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp;{{$galleryEntry->favorite_count}}</span>
						<span class=""><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;{{$galleryEntry->comment_count}}</span>
					</p>
				</div>
			@endforeach
	</div>
</div>
@endsection
