(function() {
    var correctLaters = {};
    var missplacedLaters = {};
    var incorrect_latters = jQuery("input[name='incorrect_latters']").val();
    var recom_show = ((jQuery("input[name='recommended_letters_show']").prop("checked")) ? 'on': '');
    var possible_show = ((jQuery("input[name='possible_letters_show']").prop("checked")) ? 'on': '');
    var common_show = ((jQuery("input[name='common_letters_show']").prop("checked")) ? 'on': '');
    var possible_text = jQuery("input[name='custom_text_possible']").val();
    var recom_text = jQuery("input[name='custom_text_recommended']").val();
    var post_ID = jQuery("#post_ID").val();

    function updateSettings(){
        jQuery.ajax({
            type: "post",
            url: wordleajax.ajaxurl,
            data: {
                action: "wordle_settings_update",
                post_ID: post_ID,
                data: {
                    correctLaters,
                    missplacedLaters,
                    incorrect_latters,
                    recom_show,
                    possible_show,
                    common_show,
                    possible_text,
                    recom_text
                }
            },
            dataType: "json",
            success: function (response) {
                
            }
        });
    }

    getCurrboxValue(jQuery('.wordle_correct'));
    function getCurrboxValue(){
        jQuery('.wordle_correct').children("input").each(function(ind){
            switch (ind) {
                case 0:
                    correctLaters.first =  jQuery(this).val();
                    break;
                case 1:
                    correctLaters.second =  jQuery(this).val();
                    break;
                case 2:
                    correctLaters.third =  jQuery(this).val();
                    break;
                case 3:
                    correctLaters.fourth =  jQuery(this).val();
                    break;
                case 4:
                    correctLaters.fifth =  jQuery(this).val();
                    break;
            }
        });
    }

    getMissplacedboxValue(jQuery('.wordle_missplaced'));
    function getMissplacedboxValue(){
        jQuery('.wordle_missplaced').children("input").each(function(ind){
            switch (ind) {
                case 0:
                    missplacedLaters.first =  jQuery(this).val();
                    break;
                case 1:
                    missplacedLaters.second =  jQuery(this).val();
                    break;
                case 2:
                    missplacedLaters.third =  jQuery(this).val();
                    break;
                case 3:
                    missplacedLaters.fourth =  jQuery(this).val();
                    break;
                case 4:
                    missplacedLaters.fifth =  jQuery(this).val();
                    break;
            }
        });
    }

    tinymce.PluginManager.add('wordle_tinymce_button', function( editor, url ) {
        editor.addButton( 'wordle_tinymce_button', {
            icon : "wordle-mce-icon", // optional
            text : false,
            title : 'Wordle solver',
            onclick: function() {
                jQuery("#wordle-setup-page").removeClass("wordlenone");
            }
        });

        jQuery(document).on("click", ".close_wordle_window", function(){
            jQuery("#wordle-setup-page").addClass("wordlenone");
        });

        jQuery('.wordle_correct').children("input").each(function(ind){
            jQuery(this).on("input", function(){
                getCurrboxValue();
                updateSettings();
            });
        });
        jQuery('.wordle_missplaced').children("input").each(function(ind){
            jQuery(this).on("input", function(){
                getMissplacedboxValue();
                updateSettings();
            });
        });

        jQuery("input[name='recommended_letters_show']").on("change", function () {
            if(jQuery(this).prop("checked")){
                recom_show = 'on';
            }else{
                recom_show = 'off';
            }
            updateSettings();
        });
        jQuery("input[name='possible_letters_show']").on("change", function () {
            if(jQuery(this).prop("checked")){
                possible_show = 'on';
            }else{
                possible_show = 'off';
            }
            updateSettings();
        });
        jQuery("input[name='common_letters_show']").on("change", function () {
            if(jQuery(this).prop("checked")){
                common_show = 'on';
            }else{
                common_show = 'off';
            }
            updateSettings();
        });
        jQuery("input[name='incorrect_latters']").on("blur", function () {
            incorrect_latters = jQuery(this).val();
            updateSettings();
        });
        jQuery("input[name='custom_text_recommended']").on("blur", function () {
            recom_text = jQuery(this).val();
            updateSettings();
        });
        jQuery("input[name='custom_text_possible']").on("blur", function () {
            possible_text = jQuery(this).val();
            updateSettings();
        });
       
        jQuery(document).on("click", "#insert-custom", function(){
            let shortcode = `[wordle recom_show="${recom_show}" possible_show="${possible_show}" common_show="${common_show}" possible_text="${possible_text}" recom_text="${recom_text}" incorr_latters="${incorrect_latters}" corr_first="${correctLaters.first}" corr_second="${correctLaters.second}" corr_third="${correctLaters.third}" corr_fourth="${correctLaters.fourth}" corr_fifth="${correctLaters.fifth}" missp_first="${missplacedLaters.first}" missp_second="${missplacedLaters.second}" missp_third="${missplacedLaters.third}" missp_fourth="${missplacedLaters.fourth}" missp_fifth="${missplacedLaters.fifth}"]`;

            editor.insertContent(shortcode, false);
            jQuery("#wordle-setup-page").addClass("wordlenone");
        });
        jQuery(document).on("click", "#insert-default", function(){
            editor.insertContent("[wordle]", false);
            jQuery("#wordle-setup-page").addClass("wordlenone");
        });
    });
})();