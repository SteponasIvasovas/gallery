@extends('layouts.app')

@section('content')
<div id="gallery-entry-create-container" >
  <form class="col-md-6" action="{{route('gallery-entry.update', $galleryEntry)}}" method="post" enctype="multipart/form-data">
    {{ method_field('put') }}
    {{ csrf_field() }}
    <h2>Submit new gallery entry</h2>
    @if ($errors->count() > 0)
      <div class="form-group">
        @foreach($errors->all() as $error)
          <p class="my-error-message alert alert-warning" style="list-style: none;">{{ $error }}</p>
        @endforeach
      </div>
    @endif
    <div class="form-group">
      <label for="imgInp">Upload Image</label>
      <div class="input-group">
        <span class="input-group-btn">
          <span class="btn btn-default btn-file">
            Browse… <input type="file" id="imgInp" name="image">
          </span>
        </span>
        <input type="text" placeholder="Choose file" class="form-control" value="{{$galleryEntry->image}}" readonly>
      </div>
      <img id='img-upload' src="{{$galleryEntry->image}}"/>
    </div>
    <div class="form-group">
      <label for="img-title">Title</label>
      <div class="input-group col-md-12">
        <input id="img-title" type="text" placeholder="Image title" class="form-control" name="title" value="{{$galleryEntry->title}}">
      </div>
    </div>
    <div class="form-group">
      <label for="img-description">Description</label>
      <div class="input-group col-md-12">
        <textarea id="img-description" placeholder="Image description" class="form-control" name="description" rows="8" cols="80">{{$galleryEntry->description}}</textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="img-tags">Tags</label>
      <div class="input-group col-md-12">
        <input id="img-tags" type="text" placeholder="Image tags separated by spaces (up to max 10 tags)" class="form-control" name="tags" value="{{$galleryEntry->tags}}">
      </div>
    </div>
    <div class="form-group">
      <label for="img-category">Category</label>
      <select id="img-category" class="form-control col-md-12" name="category">
        @foreach ($categories as $category)
          <option value="{{$category->id}}" @if ($galleryEntry->category_id == $category->id) selected @endif>{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </form>
</div>
@endsection
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/justifiedGallery.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/profile.js')}}"></script>
<script type="text/javascript">
"use strict"
$(document).ready(function() {
	$(document).on('change', '.btn-file :file', function() {
    let input = $(this);
    let label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
  });

	$('.btn-file :file').on('fileselect', function(event, label) {
    let input = $(this).parents('.input-group').find(':text');
    let log = label;

    if(input.length) {
      input.val(log);
    } else {
      if(log) {
        alert(log);
      }
    }
	});
	function readURL(input) {
    if (input.files && input.files[0]) {
      let reader = new FileReader();

      reader.onload = function (e) {
        $('#img-upload').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
	}

	$("#imgInp").change(function(){
    readURL(this);
	});

});
</script>
