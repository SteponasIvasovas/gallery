@extends('layouts.app')
@section('content')
  <div id="user-profile" style="min-width: 600px;">
    <div class="user-owner">
      <a href="{{route('user.profile', $user->id)}}"><img class="user-avatar" src="{{$user->avatar}}"></a>
      <span class="user-name"><a href="{{route('user.profile', $user->id)}}">{{$user->username}}</a></span>
      <span class="user-tagline">Random user tagline{{$user->tagline}}</span>
    </div>
    <div class="my-btn-panel btn-group-justified">
      <div class="btn-group">
        <a class="btn" href="{{route('user.profile', $user)}}">Profile</a>
      </div>
      <div class="btn-group">
        <a class="btn" href="{{route('user.gallery', $user)}}">Gallery</a>
      </div>
      <div class="btn-group">
        <a class="btn" href="{{route('user.favorites', $user)}}">Favorites</a>
      </div>
    </div>
    @yield('user-content')
  </div>
@endsection
