@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row text-center">
      @foreach ($galleryEntries as $galleryEntry)
        <div class="home-gallery-entry-container">
          <a href="#">
            <img class="gallery-entry-img img-responsive" src="{{$galleryEntry->image}}"/>
          </a>
					@auth
						<a href="#" class="gallery-entry-fav">
							<i class="fa fa-star-o" aria-hidden="true"></i>
						</a>
					@endauth
					<h2>{{$galleryEntry->title}}</h2>
					@foreach ($users as $user)
						@if ($galleryEntry->user_id == $user->id)
							<h3>
								<a href="{{route('user.index', $user)}}">{{$user->username}}</a>
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
