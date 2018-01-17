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

	//textarea height user profile
	if ($("#user-about").length > 0) {
		let textHeight = $("#user-about").get(0).scrollHeight;
		$("#user-about").height(textHeight);
	}


	$(".search-checks input[type='checkbox']").change(function() {
		let searchBox = $(this).parent().next();
		let display = $(searchBox).css('display');

		if (display == "none") {
			$(searchBox).css({"display" : "block"});
		} else {
			$(searchBox).css({"display" : "none"});
		}

	});


});

$(window).on('load', function () {
	$(".gallery-entry-image").each(function (index) {
		var width = $(this).width();
		var height = $(this).height();
		let ratio = width / height;

		if (ratio >= 1) {
			let width = 200 * ratio;
			width = Math.round(width);

			if (width > 400) {
				width = 400;
			}

			css = {"min-width": width.toString() + "px", "height":"200px"};
			$(this).parent().css(css);
			css = {"width" : "95%", "height" : "auto"};
			$(this).css(css);
		} else if (ratio < 1) {
			let width = 200 * ratio;
			width = Math.round(width);

			if (width <= 100) {
				width = 100;
			}
			if (width > 400) {
				width = 400;
			}

			css = {"min-width": width.toString() + "px", "height":"200px"};
			$(this).parent().css(css);
			css = {"width" : "auto", "height" : "95%"};
			$(this).css(css);
		}
	});
});
