@extends('layouts/user')
@section('user-content')
  <div id="user-gallery-container">
    @foreach ($galleryEntries as $galleryEntry)
      <div class="home-gallery-entry-container text-left">
        <a href="{{ route('gallery-entry.show', $galleryEntry->gallery_entry_id) }}">
          <div class="gallery-entry-gradient">
          </div>
        </a>
        <img class="gallery-entry-image" src="{{$galleryEntry->image}}"/>
        @auth
          @if (Auth::user()->id != $galleryEntry->user_id)
            @if (App\Favorite::where('user_id', Auth::user()->id)
            ->where('gallery_entry_id', $galleryEntry->gallery_entry_id)
            ->get()->isEmpty())
              <a data-user_id="{{Auth::user()->id}}" data-gallery_entry_id="{{$galleryEntry->gallery_entry_id}}" class="favorite-add gallery-entry-fav">
                <i class="fa fa-star-o" aria-hidden="true"></i>
              </a>
            @else
              <a data-user_id="{{Auth::user()->id}}" data-gallery_entry_id="{{$galleryEntry->gallery_entry_id}}" class="favorite-remove gallery-entry-fav">
                <i class="fa fa-star" aria-hidden="true"></i>
              </a>
            @endif
          @endif
        @endauth
        <h2>{{$galleryEntry->title}}</h2>
        <h3>
          <a href="{{route('user.profile', $galleryEntry->user_id)}}">
          <img src="{{$galleryEntry->avatar}}"/><span>{{$galleryEntry->username}}</span></a>
        </h3>
        <p>
          <span class=""><i class="fa fa-star" aria-hidden="true"></i>&nbsp;{{App\Favorite::where('gallery_entry_id', $galleryEntry->gallery_entry_id)->count()}}</span>
          <span class=""><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;{{App\Comment::where('gallery_entry_id', $galleryEntry->gallery_entry_id)->count()}}</span>
        </p>
      </div>
    @endforeach
    <div class="page-links text-center">
      {{$galleryEntries->appends(Request::except('page'))->render()}}
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
</script>
