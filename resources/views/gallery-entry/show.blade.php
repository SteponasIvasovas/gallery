@extends('layouts.app')

@section('content')

<div id="gallery-entry-show-container">
  <div class="image-container">
    <img src="{{$galleryEntry->image}}" alt="">
  </div>
  <div class="image-description-container">
    <div class="user-owner">
      <a href="#"><img class="user-avatar" src="{{$galleryEntry->avatar}}"></a>
      <span class="entry-title"><a href="#">{{$galleryEntry->title}}</a></span>
      <span class="user-name">by&nbsp;:&nbsp;<a href="#">{{$galleryEntry->username}}</a></span>
      <div class="tags-container">
        <span>tags&nbsp;:&nbsp;</span>
        @foreach ($tags as $tag)
        <a href="#">{{$tag}}</a>
        @endforeach
      </div>
      <div class="category-container">
        <span>category&nbsp;:&nbsp;</span>
        <a href="#">{{App\Category::find($galleryEntry->category_id)->name}}</a>
      </div>
    </div>
    <p class="entry-description">{{$galleryEntry->description}}</p>
  </div>
  <div class="comment-container">
    @foreach ($userComments as $userComment)
    <p class="">{{$userComment->created_at}}</p>
    <img class="user-avatar" src="{{$userComment->avatar}}" alt="">
    <p>{{$userComment->username}}</p>
    <p>{{$userComment->text}}</p>
    @endforeach
  </div>
</div>
@endsection
