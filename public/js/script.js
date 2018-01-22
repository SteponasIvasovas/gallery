$(document).ready(function() {
/** Bootsnip image Upload **/
	$(document).on('change', '.btn-file :file', function() {
    let input = $(this);
    console.log("line:5 - " + input.val());
    let label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    console.log("line:7 - " + label);
    input.trigger('fileselect', [label]);
  });

	$('.btn-file :file').on('fileselect', function(event, label) {
    console.log("line:12 - " + event);
    let input = $(this).parents('.input-group').find(':text');
    let log = label;
    console.log("line:15 - " + log);

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
	/****************************/
	/****************************/
	/****************************/
	//galleryEntry view
});

function addFavorite(e, el, el2) {
	let url = '/favorite/add';
	let thisButton = e;
	let galleryEntryId = $(e).data('gallery_entry_id');
	let userId = $(e).data('user_id');
	console.log(galleryEntryId, userId);
	$(thisButton).removeClass('favorite-add');
	$(thisButton).addClass('favorite-remove');
	$(thisButton).html(el);
	$(thisButton).off('click');
	$(thisButton).on('click', function() {
		removeFavorite(thisButton, el2);
	});
	$.ajaxSetup({
		headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: "POST",
		url: url,
		data: {gallery_entry_id : galleryEntryId,
					 user_id : userId},
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
}
function removeFavorite(e, el, el2) {
	let url = '/favorite/remove';
	let thisButton = e;
	let galleryEntryId = $(e).data('gallery_entry_id');
	let userId = $(e).data('user_id');
	$(thisButton).removeClass('favorite-remove');
	$(thisButton).addClass('favorite-add');
	$(thisButton).html(el);
	$(thisButton).off('click');
	$(thisButton).on('click', function() {
		addFavorite(thisButton, el2);
	});
	$.ajaxSetup({
		headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: "POST",
		url: url,
		data: {gallery_entry_id : galleryEntryId,
					 user_id : userId},
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
}
