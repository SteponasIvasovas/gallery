@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
      @foreach ($galleryEntries as $galleryEntry)
        <div class="col-md-3 col-sm-4 col-xs-6 home-gallery-img-container">
          <a href="#">
            <img class="my-img img-responsive" src="{{$galleryEntry->image}}"/>
          </a>
          <div class="my-info">
            <h4><span class="">{{$galleryEntry->title}}</span></h4>
            @foreach ($users as $user)
              @if ($galleryEntry->user_id == $user->id)
                <h3>
									<a class="" href="#">{{$user->name}}</a>
								</h3>
              @endif
            @endforeach
            <p>
							<span class=""><i class="fa fa-star" aria-hidden="true"></i>&nbsp{{$galleryEntry->favorite_count}}</span>
						</p>
						<p>
            	<span class=""><i class="fa fa-comment" aria-hidden="true"></i>&nbsp{{$galleryEntry->comment_count}}</span>
						</p>
          </div>
        </div>
      @endforeach
  </div>
</div>
@endsection
