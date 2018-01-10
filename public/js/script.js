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
});
