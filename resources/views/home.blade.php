@extends('layouts.app')

@section('content')
<div class="my-container">
	<div id="gallery-container" class="row text-center">
      @foreach ($galleryEntries as $galleryEntry)
        <div class="home-gallery-entry-container text-left">
					<a href="#">
						<div class="gallery-entry-gradient" >

						</div>
					</a>
            <img class="gallery-entry-img" src="{{$galleryEntry->image}}"/>
					@auth
						<a href="#" class="gallery-entry-fav">
							<i class="fa fa-star-o" aria-hidden="true"></i>
						</a>
					@endauth
					<h2>{{$galleryEntry->title}} hgjhfjhfjg jkggk kjjh jkgkjg</h2>
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
