@extends('layouts/user')
@section('user-content')
  <div id="user-profile-container">
    <div class="col-md-6 profile-info">
      <div>
        <label for="user-firstname">Name: </label>
        <input id="user-firstname" type="text" value="{{$user->firstname}}" placeholder="--not specified--" disabled></input>
      </div>
      <div>
        <label for="user-lastname">Surname: </label>
        <input id="user-lastname" type="text" value="{{$user->lastname}}" placeholder="--not specified--" disabled></input>
      </div>
      <div>
        <label for="user-gender">Gender: </label>
        <select id="user-gender" name="" disabled>
          <option value="null" @if ($user->gender == null) selected @endif>--not specified--</option>
          <option value="male" @if ($user->gender == "male") selected @endif>male</option>
          <option value="female" @if ($user->gender == "female") selected @endif>female</option>
        </select>
      </div>
      <div>
        <label for="user-birthday">Birthday: </label>
        <input id="user-birthday" type="text" value="{{$user->birthday}}" placeholder="--not specified--" disabled></input>
      </div>
      <div>
        <label for="user-country">Country: </label>
        <input id="user-country" type="text" value="{{$user->country}}" placeholder="--not specified--" disabled></input>
      </div>
      <div>
        <label for="user-city">City: </label>
        <input id="user-city" type="text" value="{{$user->city}}" placeholder="--not specified--" disabled></input>
      </div>
      <label for="user-about">About :</label>
      <textarea id="user-about" placeholder="--not specified--" disabled>{{$user->about}}</textarea>
      <div class="profile-control">
      </div>
    </div>
    <div class="col-md-6 latest-image">
      @if ($latest != null)
        <h2>LATEST ENTRY</h2>
        <a href="{{route('gallery-entry.show', $latest->id)}}">
          <img src="{{$latest->image}}" alt="">
        </a>
      @endif
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
	function readURL(input) {
    if (input.files && input.files[0]) {
      let reader = new FileReader();

      reader.onload = function (e) {
        $('.user-avatar').attr('src', e.target.result);
        $('.avatar-change').submit();
      }

      reader.readAsDataURL(input.files[0]);
    }
	}
	$("#imgInp").change(function(){
    readURL(this);
	});


  $(".edit-profile").click(function () {
    console.log('click');
    $('.edit-profile').prop('disabled', true);
    let css = {'background-color' : 'white', 'border' : '1px solid black'};
    let tagline = $('#user-tagline');
    $(tagline).prop('disabled', false);
    $(tagline).css(css);
    $(tagline).css('min-width', '200px');
    let oldTagline = $(tagline).val();
    let firstname = $('#user-firstname');
    $(firstname).prop('disabled', false);
    $(firstname).css(css);
    let oldFirstname = $(firstname).val();
    let lastname = $('#user-lastname');
    $(lastname).prop('disabled', false);
    $(lastname).css(css);
    let oldLastname = $(lastname).val();
    let birthday = $('#user-birthday');
    $(birthday).prop('disabled', false);
    $(birthday).prop('type', 'date');
    $(birthday).css(css);
    let oldBirthday = $(birthday).val();
    let country = $('#user-country');
    $(country).prop('disabled', false);
    $(country).css(css);
    let oldCountry = $(country).val();
    let city = $('#user-city');
    $(city).prop('disabled', false);
    $(city).css(css);
    let oldCity = $(city).val();
    let gender = $('#user-gender');
    $(gender).prop('disabled', false);
    $(gender).css(css);
    $(gender).css('-webkit-appearance', 'none');
    let oldGender = $(gender).val();
    let about = $('#user-about');
    $(about).prop('disabled', false);
    $(about).css(css);
    $(about).css({'cursor' : 'text', 'min-height' : '100px'});
    let oldAbout = $(about).val();
    // $(".avatar-change").css('display', 'block');
    // let oldAvatar = $('.user-avatar').prop('src');

    let saveChanges = $("<button class='btn save-profile' type='button'>Save</button>");
    $('.profile-control').append(saveChanges);
    let discardChanges = $("<button class='btn discard-profile' type='button'>Discard</button>");
    $('.profile-control').append(discardChanges);

    $(saveChanges).click(function() {
      $(saveChanges).remove();
      $(discardChanges).remove();
      let url = "http://gallery.test/user/update";
      css = {'background-color' : 'transparent', 'border' : '0'}
      $(tagline).css(css);
      $(tagline).css('min-width', '0');
      $(tagline).prop('disabled', true);
      $(firstname).css(css);
      $(firstname).prop('disabled', true);
      $(lastname).css(css);
      $(lastname).prop('disabled', true);
      $(birthday).css(css);
      $(birthday).prop('disabled', true);
      $(birthday).prop('type', 'text');
      $(country).css(css);
      $(country).prop('disabled', true);
      $(city).css(css);
      $(city).prop('disabled', true);
      $(gender).css(css);
      $(gender).css('-webkit-appearance', 'none');
      $(gender).prop('disabled', true);
      $('.edit-profile').prop('disabled', false);
      $(about).css(css);
      $(about).css({'cursor' : 'default', 'min-height' : '0'});
      $(about).prop('disabled', true);
      $(about).height(0);
      let aboutHeight = $(about).get(0).scrollHeight;
      $(about).height(aboutHeight);
      // $(".avatar-change").css('display', 'none');

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: url,
        data: {
          tagline : $(tagline).val(),
          firstname : $(firstname).val(),
          lastname : $(lastname).val(),
          birthday : $(birthday).val(),
          country : $(country).val(),
          city : $(city).val(),
          gender : $(gender).val(),
          about : $(about).val(),
        },
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
    $(discardChanges).click(function() {
      $(saveChanges).remove();
      $(discardChanges).remove();
      css = {'background-color' : 'transparent', 'border' : '0'}
      $(tagline).css(css);
      $(tagline).css('min-width', '0');
      $(tagline).prop('disabled', true);
      $(tagline).val(oldTagline);
      $(firstname).css(css);
      $(firstname).prop('disabled', true);
      $(firstname).val(oldFirstname);
      $(lastname).css(css);
      $(lastname).prop('disabled', true);
      $(lastname).val(oldLastname);
      $(birthday).css(css);
      $(birthday).prop('disabled', true);
      $(birthday).prop('type', 'text');
      $(birthday).val(oldBirthday);
      $(country).css(css);
      $(country).prop('disabled', true);
      $(country).val(oldCountry);
      $(city).css(css);
      $(city).prop('disabled', true);
      $(city).val(oldCity);
      $(gender).css(css);
      $(gender).css('-webkit-appearance', 'none');
      $(gender).prop('disabled', true);
      $(gender).val(oldGender);
      $('.edit-profile').prop('disabled', false);
      $(about).css(css);
      $(about).css({'cursor' : 'default', 'min-height' : '0'});
      $(about).prop('disabled', true);
      $(about).val(oldAbout);
      $(about).height(0);
      let aboutHeight = $(about).get(0).scrollHeight;
      $(about).height(aboutHeight);
      // $(".avatar-change").css('display', 'none');
      // $('.user-avatar').prop('src', oldAvatar);
    });
  });
});

$(window).on('load', function() {
  $('#user-about').height(0);
  let textHeight = $('#user-about').get(0).scrollHeight;
  $('#user-about').height(textHeight);
});

$(window).on('resize', function() {
  $('#user-about').height(0);
  let textHeight = $('#user-about').get(0).scrollHeight;
  $('#user-about').height(textHeight);
});
</script>
