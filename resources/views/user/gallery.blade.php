@extends('layouts/user')
@section('user-content')
  <div id="user-gallery-container">
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
      <h3>
        <img src="{{$user->avatar}}"/>&nbsp<a href="{{route('user.profile', $user)}}">{{$user->username}}</a>
      </h3>
      <p>
        <span class=""><i class="fa fa-star" aria-hidden="true"></i>&nbsp{{$galleryEntry->favorite_count}}</span>
        <span class=""><i class="fa fa-comment" aria-hidden="true"></i>&nbsp{{$galleryEntry->comment_count}}</span>
      </p>
    </div>
  @endforeach
  </div>
@endsection
