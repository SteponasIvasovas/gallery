@extends('layouts/user')
@section('user-content')
  <div id="user-favorite-container">
    @foreach ($favorites as $favorite)
      <div class="home-gallery-entry-container text-left">
        <a href="{{ route('gallery-entry.show', $favorite->galleryEntryId) }}">
        <div class="gallery-entry-gradient">
        </div>
        </a>
        <img class="gallery-entry-image" src="{{$favorite->image}}"/>
        @auth
          @if (Auth::user()->id != $favorite->galleryEntryUserId)
            @if (App\Favorite::where('user_id', Auth::user()->id)
            ->where('gallery_entry_id', $favorite->galleryEntryId)
            ->get()->isEmpty())
              <a data-user_id="{{Auth::user()->id}}" data-gallery_entry_id="{{$favorite->galleryEntryId}}" class="favorite-add gallery-entry-fav">
                <i class="fa fa-star-o" aria-hidden="true"></i>
              </a>
            @else
              <a @if (Auth::user()->id == $favorite->userId) data-this_user="true" @endif data-user_id="{{Auth::user()->id}}" data-gallery_entry_id="{{$favorite->galleryEntryId}}" class="favorite-remove gallery-entry-fav">
                <i class="fa fa-star" aria-hidden="true"></i>
              </a>
            @endif
          @endif
        @endauth
        <h2>{{$favorite->title}}</h2>
        <h3>
          <a href="{{route('user.profile', $favorite->galleryEntryUserId)}}">
          <img src="{{$favorite->avatar}}"/><span>{{$favorite->username}}</span></a>
        </h3>
        <p>
          <span class=""><i class="fa fa-star" aria-hidden="true"></i>&nbsp;{{App\Favorite::where('gallery_entry_id', $favorite->galleryEntryId)->count()}}</span>
          <span class=""><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;{{App\Comment::where('gallery_entry_id', $favorite->galleryEntryId)->count()}}</span>
        </p>
      </div>
    @endforeach
    <div class="page-links text-center">
      {{$favorites->appends(Request::except('page'))->render()}}
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
    console.log($(this).data('this_user'));

    if ($(this).data('this_user') != undefined) {
      $(this).parent().remove();
    }
  });
});
</script>
