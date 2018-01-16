@extends('layouts.app')
@section('content')
  <div id="user-profile" style="min-width: 600px;">
    <div class="card hovercard">
      <div class="card-background">
      </div>
      {{-- @if ($user->avatar != null) --}}
        <div class="user-avatar">
          <!-- <img alt="no-avatar" src="{{$user->avatar}}"> -->
          <img alt="" src="{{$user->avatar}}">
        </div>
      {{-- @endif --}}
      <div class="card-info text-left">
        <span class="card-title">{{$user->username}}</span>
        <span class="card-tagline">{{$user->tagline}}</span>
      </div>
    </div>
    <div class="my-btn-panel btn-group-justified">
      <div class="btn-group">
        <a class="btn" href="{{route('user.profile', $user) }}">Profile</a>
      </div>
      <div class="btn-group">
        <a class="btn" href="{{ route('user.gallery', $user) }}">Gallery</a>
      </div>
      <div class="btn-group">
        <a class="btn" href="#">Favorites</a>
      </div>
    </div>
    @yield('user-content')
  </div>
@endsection
