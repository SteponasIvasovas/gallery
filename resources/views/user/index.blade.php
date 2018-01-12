@extends('layouts.app')
@section('content')
  <div style="min-width: 600px;">
    <div class="card hovercard">
      <div class="card-background">
      </div>
      {{-- @if ($user->avatar != null) --}}
        <div class="useravatar">
          <!-- <img alt="no-avatar" src="{{$user->avatar}}"> -->
          <img alt="" src="http://lorempixel.com/100/100/people/9/">
        </div>
      {{-- @endif --}}
      <div class="card-info text-left">
        <span class="card-title">{{$user->username}}</span>
        <span class="card-tagline">Tagline{{$user->tagline}}</span>
      </div>
    </div>
    <div class="my-btn-panel btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
      <div class="btn-group" role="group">
        <button type="button" id="home" class="btn btn-default" href="#tab1" data-toggle="tab">
          <div>Home</div>
        </button>
      </div>
      <div class="btn-group" role="group">
        <button type="button" id="gallery" class="btn btn-primary" href="#tab2" data-toggle="tab">
          <div>Gallery</div>
        </button>
      </div>
      <div class="btn-group" role="group">
        <button type="button" id="favorites" class="btn btn-default" href="#tab3" data-toggle="tab">
          <div>Favorites</div>
        </button>
      </div>
    </div>

    <div class="tab-content">
      <div class="tab-pane fade in" id="tab1">
        <p>{{$user->firstname}} {{$user->surname}}</p>
        <p>{{$user->gender}}</p>
        <p>{{$user->birthday}}</p>
        <p>{{$user->about}}</p>
      </div>
      <div class="tab-pane fade in active" id="tab2">
        <div class="row">
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
            </div>
          @endforeach
        </div>
      </div>
      <div class="tab-pane fade in" id="tab3">
        <h3>This is tab 3</h3>
      </div>
    </div>
  </div>

@endsection
