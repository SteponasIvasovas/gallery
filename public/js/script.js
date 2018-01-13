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
/***************************/
	$(document).ready(function(){
		let galleryEntries = $('.gallery-entry-img');
		for (let i = 0; i < galleryEntries.length; i++) {
			console.log(galleryEntries[i].height);
		}
	});
	$(document).ready(function(){
		// let galleryEntries = $('.gallery-entry-img');
		$('.gallery-entry-img').each(function() {
			$(this).on('load', function(){
				// for (let i = 0; i < galleryEntries.length; i++) {
				let css;
				let ratio = $(this).width() / $(this).height();
				console.log($(this).width(), $(this).height(), ratio);
				if (ratio >= 1) {
					let width = 300 * ratio;
					width = Math.round(width);

					if (width > 500) {
						width = 500;
					}

					css = {"min-width": width.toString() + "px", "height":"300px"};
					$(this).parent().css(css);
					css = {"width" : "95%", "height" : "auto"};
					$(this).css(css);
				} else if (ratio < 1) {
					let width = 300 * ratio;
					width = Math.round(width);

					if (width <= 180) {
						width = 180;
					}

					css = {"min-width": width.toString() + "px", "height":"300px"};
					$(this).parent().css(css);
					css = {"width" : "auto", "height" : "95%"};
					$(this).css(css);
				}
				// }
			});

		});
	});

});

// function _loadimages(imgArr,callback) {
//   //Keep track of the images that are loaded
//   var imagesLoaded = 0;
//   function _loadAllImages(callback){
//    //Create an temp image and load the url
//    var img = new Image();
//    $(img).attr('src', imgArr[imagesLoaded]);
//    if (img.complete || img.readyState === 4) {
//     // image is cached
//     imagesLoaded++;
//     //Check if all images are loaded
//     if(imagesLoaded == imgArr.length) {
//      //If all images loaded do the callback
//      callback();
//     } else {
//      //If not all images are loaded call own function again
//      _loadAllImages(callback);
//     }
//    } else {
//     $(img).load(function(){
//      //Increment the images loaded variable
//      imagesLoaded++;
//      //Check if all images are loaded
//      if(imagesLoaded == imgArr.length) {
//       //If all images loaded do the callback
//       callback();
//      } else {
//       //If not all images are loaded call own function again
//       _loadAllImages(callback);
//      }
//     });
//    }
//   };
//   _loadAllImages(callback);
//  }
