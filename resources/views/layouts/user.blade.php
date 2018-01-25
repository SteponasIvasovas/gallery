@extends('layouts.app')
@section('content')
  <div id="user-profile" style="min-width: 600px;">
    <div class="user-owner">
      <a href="{{route('user.profile', $user->id)}}"><img class="user-avatar" src="{{$user->avatar}}"></a>
      @auth
        @if (Auth::user()->id == $user->id)
          <form class="avatar-change" action="{{route('user.avatarUpdate')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="imgInp" class="btn">Change..</label>
            <input type="file" id="imgInp" name="image">
          </form>
        @endif
      @endauth
      <span class="user-name">
        <a href="{{route('user.profile', $user->id)}}">{{$user->username}}</a>
      </span>
      <input id="user-tagline" type="text" value="{{$user->tagline}}" placeholder="--not specified--" disabled>
      @auth
        <button class="btn btn-primary edit-profile" type="button">Edit profile</button>
      @endauth
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
