@extends('layouts.app')

@section('content')

<div id="gallery-entry-show-container">
  <div class="image-container">
    <img src="{{$galleryEntry->image}}" alt="">
  </div>
  <div class="image-description-container">
    <div class="user-owner">
      <a href="{{route('user.profile', $galleryEntry->user_id)}}"><img class="user-avatar" src="{{$galleryEntry->avatar}}"></a>
      <span class="entry-title"><a href="#">{{$galleryEntry->title}}</a></span>
      <span class="user-name">by&nbsp;:&nbsp;<a href="{{route('user.profile', $galleryEntry->user_id)}}">{{$galleryEntry->username}}</a></span>
      <div class="tags-container">
        <span>tags&nbsp;:&nbsp;</span>
        @foreach ($tags as $tag)
        <a href="{{route('searchTag', $tag)}}">{{$tag}}</a>
        @endforeach
      </div>
      <div class="category-container">
        <span>category&nbsp;:&nbsp;</span>
        <a href="{{route('filterCategory', App\Category::find($galleryEntry->category_id))}}">{{App\Category::find($galleryEntry->category_id)->name}}</a>
      </div>
    </div>
    <p class="entry-description">{{$galleryEntry->description}}</p>
  </div>
  @auth
  <form class="form-new-comment" action="index.html" method="post">
    <img class="user-avatar" src="{{$galleryEntry->avatar}}" alt="">
    <textarea class="new-comment-post" name="name" rows="4" cols="80"></textarea>
    <button class="btn" type="submit" name="button">Submit</button>
  </form>
  @endauth
  <div class="user-comments-container">
    @foreach ($userComments as $userComment)
    <div class="comment-container">
      <hr>
      <p class="user-name-date">
        Comment&nbsp;by&nbsp;<a href="{{ route('user.profile', $userComment->id) }}">{{$userComment->username}}</a>&nbsp;posted&nbsp;on&nbsp;{{$userComment->created_at}}
      </p>
      <hr>
      <img class="user-avatar" src="{{$userComment->avatar}}" alt="">
      <textarea class="user-comment" disabled>{{$userComment->text}}</textarea>
      <div class="button-panel">
        <a class="btn" href="#">Edit</a>
        <a class="btn" href="#">Delete</a>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
