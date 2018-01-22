@extends('layouts.app')

@section('content')
<div id="gallery-entry-create-container" >
  <form class="col-md-6" action="{{route('gallery-entry.store')}}" method="post" enctype="multipart/form-data">
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
        <input type="text" placeholder="Choose file" class="form-control" readonly>
      </div>
      <img id='img-upload'/>
    </div>
    <div class="form-group">
      <label for="img-title">Title</label>
      <div class="input-group col-md-12">
        <input id="img-title" type="text" placeholder="Image title" class="form-control" name="title" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="img-description">Description</label>
      <div class="input-group col-md-12">
        <textarea id="img-description" placeholder="Image description" class="form-control" name="description" rows="8" cols="80"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="img-tags">Tags</label>
      <div class="input-group col-md-12">
        <input id="img-tags" type="text" placeholder="Image tags separated by spaces (up to max 10 tags)" class="form-control" name="tags" value="">
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </form>
</div>
@endsection
