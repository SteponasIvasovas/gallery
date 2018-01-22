@extends('layouts.app')
@section('content')
<div id="side-menu">
	<form id="as" class="navbar-form navbar-left" role="search" action="{{route('searchAdvanced')}}" method="get">
		{{ csrf_field() }}
		<h3><a data-target="#as-panel" data-toggle="collapse">Advanced search</a></h3>
		<hr>
		<div id="as-panel" class="collapse">
			<div class="search-checks form-check">
				<input class="form-check-input" type="checkbox" value="checked" id="as-title-check" name="as_title_check">
				<label class="form-check-label" for="as-title-check">by title</label>
			</div>
			<div class="search-box form-group toggleable">
				<input type="text" class="form-control" name="as_title" placeholder="Search for title..." id="as-title">
			</div>
			<div class="search-checks form-check">
				<input class="form-check-input" type="checkbox" value="checked" id="as-tags-check" name="as_tags_check">
				<label class="form-check-label" for="as-tags-check">by tags</label>
			</div>
			<div class="search-box form-group toggleable">
				<input type="text" class="form-control" name="as_tags" placeholder="Search for tags..." id="as-tags">
			</div>
			<div class="search-checks form-check">
				<input class="form-check-input" type="checkbox" value="checked" id="as-user-check" name="as_user_check">
				<label class="form-check-label" for="as-user-check">by user</label>
			</div>
			<div class="search-box form-group toggleable">
				<input type="text" class="form-control" name="as_user" placeholder="Search for user..." id="as-user">
			</div>
			<div class="search-checks form-check">
				<input class="form-check-input" type="checkbox" value="checked" id="as-category-check" name="as_category_check">
				<label class="form-check-label" for="as-category-check">by category</label>
			</div>
			<div class="toggleable as-categories">
			@foreach ($categories as $category)
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="as-category-{{$category->id}}" name="as_category[]" value="{{$category->id}}">
					<label class="form-check-label" for="as-category-{{$category->id}}">{{$category->name}}</label>
				</div>
			@endforeach
			</div>
			<button class="btn btn-secondary" type="submit">Search</button>
		</div>
		<h3>Categories</h3>
		<hr>
		<ol id="list-categories">
			@foreach ($categories as $category)
				<li><a href="{{ route('filterCategory', $category)}}">{{$category->name}}</a></li>
			@endforeach
		</ol>
	</form>

</div>
<div id="home-container">
	<div id="home-banner-container">
		<img id="home-banner-image" alt="" src="{{ asset('images/banner.jpg')}}">
		<div id="home-banner-info" class="text-center">
			<img class="text-center" src="{{ asset('images/logo.png') }}" alt="">
			<p>Place where you can share captured moments of your life with everyone in the world</p>
			@auth
			<a class="btn" href="{{ route('gallery-entry.create') }}">Submit</a>
			@endauth
		</div>
	</div>
	<div id="home-gallery-container" class="text-left">
			@foreach ($galleryEntries as $galleryEntry)
				<div class="home-gallery-entry-container text-left">
					<a href="{{ route('gallery-entry.show', $galleryEntry->galleryEntryId) }}">
						<div class="gallery-entry-gradient">
						</div>
					</a>
					<img class="gallery-entry-image" src="{{$galleryEntry->image}}"/>
					@auth
						@if (Auth::user()->id != $galleryEntry->userId)
							@if (App\Favorite::where('user_id', Auth::user()->id)
							->where('gallery_entry_id', $galleryEntry->galleryEntryId)
							->get()->isEmpty())
								<a data-user_id="{{Auth::user()->id}}" data-gallery_entry_id="{{$galleryEntry->galleryEntryId}}" class="favorite-add gallery-entry-fav">
									<i class="fa fa-star-o" aria-hidden="true"></i>
								</a>
							@else
								<a data-user_id="{{Auth::user()->id}}" data-gallery_entry_id="{{$galleryEntry->galleryEntryId}}" class="favorite-remove gallery-entry-fav">
									<i class="fa fa-star" aria-hidden="true"></i>
								</a>
							@endif
						@endif
					@endauth
					<h2>{{$galleryEntry->title}}</h2>
					<h3>
						<a href="{{route('user.profile', $galleryEntry->userId)}}">
						<img src="{{$galleryEntry->avatar}}"/><span>{{$galleryEntry->username}}</span></a>
					</h3>
					<p>
						<span class=""><i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp;{{App\Favorite::where('gallery_entry_id', $galleryEntry->galleryEntryId)->count()}}</span>
						<span class=""><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;{{App\Comment::where('gallery_entry_id', $galleryEntry->galleryEntryId)->count()}}</span>
					</p>
				</div>
			@endforeach
			<div class="page-links text-center">
				{{$galleryEntries->appends(Request::except('page'))->render()}}
			</div>
	</div>
</div>
@endsection
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/justifiedGallery.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/profile.js') }}"></script>
<script type="text/javascript">
	"use strict"
	$(document).ready(function() {
		// var jqueryObj = $;
		// jqueryObj("#home-gallery-container").justifiedGallery();
		//hide/unhide advanced search
		$(".search-checks input[type='checkbox']").change(function() {
			let searchBox = $(this).parent().next();
			let display = $(searchBox).css('display');

			if (display == "none") {
				$(searchBox).css('display', 'block');
			} else {
				$(searchBox).css({"display" : "none"});
			}
		});
		$('.favorite-add').click(function () {
			addFavorite(this,
			'<i class="fa fa-star" aria-hidden="true"></i>',
			'<i class="fa fa-star-o" aria-hidden="true"></i>');
		});
		$('.favorite-remove').click(function() {
			removeFavorite(this,
			'<i class="fa fa-star-o" aria-hidden="true"></i>',
			'<i class="fa fa-star" aria-hidden="true"></i>');
		});
	});

	$(window).on('resize', function() {
		resizeGalleryContainer();
	});
	$(window).on('load', function() {
		resizeGalleryContainer();
	});
	function resizeGalleryContainer() {
		let windowHeight = $(window).height();
		$(window).css('min-height', windowHeight)
		$("#home-container").css('min-height', windowHeight);
		$("#side-menu").css('min-height', windowHeight);
	}

	// $('.gallery-entry-image').each(function () {
		// 	let width = $(this).width();
		// 	let height = $(this).height();
		// 	let ratio = width / height;
		// 	console.log(width, height, ratio);
		// 	if (ratio >= 2.5) {
		// 		$(this).parent().css('min-width', '500px');
		// 	} else if (ratio >= 2) {
		// 		$(this).parent().css('min-width', '400px');
		// 	} else if (ratio >= 1.5) {
		// 		$(this).parent().css('min-width', '300px');
		// 	} else if (ratio >= 1) {
		// 		$(this).parent().css('min-width', '200px');
		// 	} else {
		// 		$(this).parent().css('min-width', '100px');
		// 	}
		// });

</script>
