jQuery(document).ready(function($) {
 	$.each(travel_form_data, function(index, val) {
 		var name_main = index;

 		$.each(val, function(index, val) {
 			if(index != 'status') {
 				$('[name="'+name_main+'['+index+']"]').val(val);
 			}
 		});
 	});

	$('.color').colorPicker(); // that's it

	$('.color-hex').colorPicker(
	{
        opacity: false, // disables opacity slider
        renderCallback: function ($elm, toggled) {
        	$elm.val('#' + this.color.colors.HEX);
        }
    }
    )
});