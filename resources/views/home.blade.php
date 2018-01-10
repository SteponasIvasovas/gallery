@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="container">
        <h1>Masonry + imagesLoaded, iteratively reveal items</h1>
        <div id="container">
        </div>
        <div id="images">
            <div class="item">
                <img src="http://lorempixel.com/425/299/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/190/292/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/520/329/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/404/176/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/530/290/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/228/200/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/207/316/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/435/162/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/376/175/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/508/338/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/404/389/nature">
            </div>
            <div class="item">
                <img src="http://lorempixel.com/216/304/nature">
            </div>
        </div>
      </div>

        <div class="col-md-8 col-md-offset-2">
          @foreach($galleryEntries as $galleryEntry)

          @endforeach
        </div>
    </div>
</div>

<script src="//masonry.desandro.com/masonry.pkgd.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.js"></script>
@endsection
