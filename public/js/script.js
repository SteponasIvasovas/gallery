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
