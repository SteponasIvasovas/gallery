@extends('layouts.app')
@section('content')
<div id="gallery-entry-show-container">
  <div class="image-container">
    <img src="{{$galleryEntry->image}}" alt="">
    @auth
    @endauth
  </div>
  <div class="image-description-container">
    <div class="user-owner">
      <a href="{{route('user.profile', $galleryEntry->userId)}}"><img class="user-avatar" src="{{$galleryEntry->avatar}}"></a>
      <span class="entry-title"><a href="#">{{$galleryEntry->title}}</a></span>
      <span class="user-name">by&nbsp;:&nbsp;<a href="{{route('user.profile', $galleryEntry->userId)}}">{{$galleryEntry->username}}</a></span>
      <div class="tags-container">
        <span>tags&nbsp;:&nbsp;</span>
        @foreach ($tags as $tag)
        <a href="{{route('searchTag', $tag)}}">{{$tag}}</a>
        @endforeach
      </div>
      <div class="category-container">
        <span>category&nbsp;:&nbsp;</span>
        @if (App\Category::find($galleryEntry->category_id))
          <a href="{{route('filterCategory', App\Category::find($galleryEntry->category_id))}}">{{App\Category::find($galleryEntry->category_id)->name}}</a>
        @endif
      </div>
      @auth
        @if (Auth::user()->id == $galleryEntry->userId)
          <a href="{{route('gallery-entry.edit', $galleryEntry->galleryEntryId)}}" class="btn btn-primary edit-entry">Edit image</a>
          <a onclick=" if (confirm('Are you sure?')) {
                          event.preventDefault();
                          document.getElementById('delete-entry-form').submit();
                        }" class="btn btn-primary delete-entry" >Delete image</a>
          <form id="delete-entry-form" action="{{route('gallery-entry.destroy', $galleryEntry->galleryEntryId)}}" method="POST" style="display: none;">
              {{ method_field('delete') }}
              {{ csrf_field() }}
          </form>
        @else
        <div class="favorite-button">
          @if (App\Favorite::where('user_id', Auth::user()->id)
          ->where('gallery_entry_id', $galleryEntry->galleryEntryId)
          ->get()->isEmpty())
            <a data-user_id="{{Auth::user()->id}}" data-gallery_entry_id="{{$galleryEntry->galleryEntryId}}" class="favorite-add gallery-entry-fav">
              <i class="fa fa-star-o" aria-hidden="true"></i>&nbsp;Add&nbsp;to&nbsp;favorites
            </a>
          @else
            <a data-user_id="{{Auth::user()->id}}" data-gallery_entry_id="{{$galleryEntry->galleryEntryId}}" class="favorite-remove gallery-entry-fav">
              <i class="fa fa-star" aria-hidden="true"></i>&nbsp;Remove&nbsp;from&nbsp;favorites
            </a>
          @endif
        </div>
        @endif
      @endauth
    </div>
    <p class="entry-description">{{$galleryEntry->description}}</p>
  </div>
  @auth
  <form class="new-comment-box" action="{{route('comment.post')}}" method="post">
    {{csrf_field()}}
    <a href="{{route('user.profile', Auth::user()->id)}}">
      <img class="user-avatar" src="{{Auth::user()->avatar}}" alt="">
    </a>
    <input type="hidden" name="gallery_entry_id" value="{{$galleryEntry->galleryEntryId}}">
    <textarea class="new-comment-post" name="text" rows="4" cols="80"></textarea>
    <button class="btn" type="submit" name="button">Submit</button>
  </form>
  @endauth
  <div class="user-comments-container">
    @foreach ($userComments as $userComment)
    <div class="comment-container">
      <hr>
      <p class="user-name-date">
        Comment&nbsp;by&nbsp;<a href="{{ route('user.profile', $userComment->userId) }}">{{$userComment->username}}</a>&nbsp;posted&nbsp;on&nbsp;{{$userComment->created_at}}@if ($userComment->created_at != $userComment->updated_at)&nbsp;edited on {{$userComment->updated_at}}@endif
      </p>
      <hr>
      <a href="{{route('user.profile', $userComment->userId)}}"><img class="user-avatar" src="{{$userComment->avatar}}" alt=""></a>
      <textarea data-id="{{$userComment->commentId}}" class="user-comment" disabled>{{$userComment->text}}</textarea>
      @auth
        @if ($userComment->userId == Auth::user()->id)
          <div class="button-panel">
            <a class="btn edit-comment">Edit</a>
            <a class="btn delete-comment">Delete</a>
          </div>
        @endif
      @endauth
    </div>
    @endforeach
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
  $(".edit-comment").click(function() {
    $(this).addClass('disable-anchor-click');
    let thisButton = this;
    let textarea = $(this).parent().parent().children(".user-comment");
    $(textarea).prop('disabled', false);
    $(textarea).css({'background-color' : 'white',
    'cursor' : 'text',
    'border' : '1px solid rgb(169, 169, 169)',
    'min-height' : '75px'});
    $(textarea).focus();

    let oldText = $(textarea).val();

    let extraButtons = $("<div class='extra-buttons'></div>");
    extraButtons.insertAfter(textarea);
    let saveChanges = $("<button class='btn'>Save</button>");
    extraButtons.append(saveChanges);
    let discardChanges = $("<button class='btn'>Discard</button>");
    discardChanges.css('margin-left', '10px');
    extraButtons.append(discardChanges);
    saveChanges.click(function() {
        let commentId = $(textarea).data('id');
        let commentText = $(textarea).val();
        let url = "http://gallery.test/comment/update";
        $(extraButtons).remove();
        $(textarea).prop('disabled', true);
        $(textarea).css({'background-color' : 'transparent',
        'cursor' : 'default',
        'border' : '0'});
        $(thisButton).removeClass('disable-anchor-click');
        $(textarea).height(0);
        let textHeight = $(textarea).get(0).scrollHeight;
        $(textarea).height(textHeight);
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          url: url,
          data: {id : commentId,
                 text : commentText},
          dataType: "json",
          success: function (data) {
            console.log('Success');
            console.log(data);
          },
          error: function (error) {
            console.log('Error');
            console.log(error);
          }
        });
    });
    discardChanges.click(function() {
      $(extraButtons).remove();
      $(textarea).val(oldText);
      $(textarea).prop('disabled', true);
      $(textarea).css({'background-color' : 'transparent',
      'cursor' : 'default',
      'border' : '0'});
      $(thisButton).removeClass('disable-anchor-click');
    })
  });
  $(".delete-comment").click(function() {
    var doDelete = confirm('Are u sure you want to delete your comment ?');

    if (!doDelete) {
      return;
    }

    let textarea = $(this).parent().parent().children(".user-comment");
    let commentContainer = $(textarea).parent();
    let commentId = $(textarea).data('id');
    let url = "http://gallery.test/comment/delete";
    $(commentContainer).remove();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: url,
      data: {id : commentId},
      dataType: "json",
      success: function (data) {
        console.log('Success');
        console.log(data);
      },
      error: function (error) {
        console.log('Error');
        console.log(error);
      }
    });
  });
  $('.favorite-add').click(function () {
    addFavorite(this,
    '<i class="fa fa-star" aria-hidden="true"></i>&nbsp;Remove&nbsp;from&nbsp;favorites',
    '<i class="fa fa-star-o" aria-hidden="true"></i>&nbsp;Add&nbsp;to&nbsp;favorites',);
  });
  $('.favorite-remove').click(function() {
    removeFavorite(this,
    '<i class="fa fa-star-o" aria-hidden="true"></i>&nbsp;Add&nbsp;to&nbsp;favorites',
    '<i class="fa fa-star" aria-hidden="true"></i>&nbsp;Remove&nbsp;from&nbsp;favorites');
  });
});

$(window).on('resize', function() {
	resizeGalleryEntryTextarea();
});

$(window).on('load', function() {
	resizeGalleryEntryTextarea();
  let width = $('.image-container img').width();
  let height = $('.image-container img').height();
  console.log(height, width);
  let ratio = width / height;

  if (ratio <= 1) {
    $('.image-container').css('max-height', '800px');
    if (height > 800) {
      $('.image-container img').css('height', '100%');      
    }
  } else {
    $('.image-container').css('max-width', '800px');
    if (width > 800) {
      $('.image-container img').css('width', '100%');
    }
  }
});

function resizeGalleryEntryTextarea() {
	let windowWidth = $(window).width();
	$("textarea").width(windowWidth - 95 - 20);
	$(".user-comment").each(function (){
		$(this).height(0);
		let textHeight = $(this).get(0).scrollHeight;
		$(this).height(textHeight);
	});
}
</script>
