jQuery(document).ready(function ($) {
	'use strict';
	
	$(document).on('input', '.wordle-word', function () {
		$(this).removeAttr("required");
		if($(this).val().length < 5 || $(this).val().length > 5){
			$(this).prop("required", true );
		}
		
		if ($(this).val() !== '' && $(this).next().length == 0) {
			$(document).find('#wordle_words').append(
				`<input placeholder="Word" type="text" name="wordle_words[]" title='Word length must be 5 characters.' class="wordle-word">`
			);
		}
		if ($(this).val() === '') {
			$(this).remove();
		}
	});

	$('#correct_letters_box_bg').wpColorPicker();
	$('#misplaced_letters_box_bg').wpColorPicker();
	$('#incorrect_letters_box_bg').wpColorPicker();
});
