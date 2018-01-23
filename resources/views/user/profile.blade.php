@extends('layouts/user')
@section('user-content')
  <div id="user-profile-container">
    <div class="">
      <label for="">Name: </label>
      <input id="user-firstname" type="text" value="{{$user->firstname}}" placeholder="--not specified--" disabled></input>
    </div>
    <div class="">
      <label for="">Surname: </label>
      <input id="user-lastname" type="text" value="{{$user->lastname}}" placeholder="--not specified--" disabled></input>
    </div>
    <div class="">
      <label for="">Gender: </label>
      <select id="user-gender" name="" disabled>
        <option value="null" @if ($user->gender == null) selected @endif>--not specified--</option>
        <option value="male" @if ($user->gender == "male") selected @endif>male</option>
        <option value="female" @if ($user->gender == "female") selected @endif>female</option>
      </select>
    </div>
    <div class="">
      <label for="">Birthday: </label>
      <input id="user-birthday" type="text" value="{{$user->birthday}}" placeholder="--not specified--" disabled></input>
    </div>
    <div class="">
      <label for="">Country: </label>
      <input id="user-country" type="text" value="{{$user->country}}" placeholder="--not specified--" disabled></input>
    </div>
    <div class="">
      <label for="">City: </label>
      <input id="user-city" type="text" value="{{$user->city}}" placeholder="--not specified--" disabled></input>
    </div>
    <label for="">About :</label>
    <textarea id="user-about" placeholder="--not specified--" disabled>{{$user->about}}</textarea>
    <div class="profile-control">
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
  $(document).on('change', '#imgInp', function() {
    console.log('change');
    let input = $(this);
    let label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
  });
	$('#imgInp').on('fileselect', function(event, label) {
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
        $('.user-avatar').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
	}
	$("#imgInp").change(function(){
    readURL(this);
	});

  $('#user-about').height(0);
  let textHeight = $('#user-about').get(0).scrollHeight;
  $('#user-about').height(textHeight);

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
    $(".image-change").css('display', 'block');
    let oldAvatar = $('.user-avatar').prop('src');

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
      $(".image-change").css('display', 'none');


      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: url,
        data: {
          // test : 'test'
          tagline : $(tagline).val(),
          firstname : $(firstname).val(),
          lastname : $(lastname).val(),
          birthday : $(birthday).val(),
          country : $(country).val(),
          city : $(city).val(),
          gender : $(gender).val(),
          about : $(about).val(),
          avatar : $('#imgInp').val()
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
      $(".image-change").css('display', 'none');
      $('.user-avatar').prop('src', oldAvatar);
    });
  });
});
</script>
