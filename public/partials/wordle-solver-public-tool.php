<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Wordle_Solver
 * @subpackage Wordle_Solver/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="wordle_wrapper" class="default">
    <div id="wordle_filter_bar_wrapper">
        <div class="wordle_filter_bar correct">
            <h2>Correct Letters</h2>
            <div class="wordle_filter_boxs">
                <input <?php echo ((!empty($atts['corr_first'])) ? 'readonly': '') ?> type="text" name="searchBox0" class="search_bar" maxlength="1" value="<?php echo $atts['corr_first'] ?>">
                <input <?php echo ((!empty($atts['corr_second'])) ? 'readonly': '') ?> type="text" name="searchBox1" class="search_bar" maxlength="1" value="<?php echo $atts['corr_second'] ?>">
                <input <?php echo ((!empty($atts['corr_third'])) ? 'readonly': '') ?> type="text" name="searchBox2" class="search_bar" maxlength="1" value="<?php echo $atts['corr_third'] ?>">
                <input <?php echo ((!empty($atts['corr_fourth'])) ? 'readonly': '') ?> type="text" name="searchBox3" class="search_bar" maxlength="1" value="<?php echo $atts['corr_fourth'] ?>">
                <input <?php echo ((!empty($atts['corr_fifth'])) ? 'readonly': '') ?> type="text" name="searchBox4" class="search_bar" maxlength="1" value="<?php echo $atts['corr_fifth'] ?>">
            </div>
        </div>
        <div class="wordle_filter_bar misplaced">
            <h2>Misplaced Letters</h2>
            <div class="wordle_filter_boxs">
                <input <?php echo ((!empty($atts['missp_first'])) ? 'readonly': '') ?> type="text" name="searchBox0" class="search_bar" maxlength="1" value="<?php echo $atts['missp_first'] ?>">
                <input <?php echo ((!empty($atts['missp_second'])) ? 'readonly': '') ?> type="text" name="searchBox1" class="search_bar" maxlength="1" value="<?php echo $atts['missp_second'] ?>">
                <input <?php echo ((!empty($atts['missp_third'])) ? 'readonly': '') ?> type="text" name="searchBox2" class="search_bar" maxlength="1" value="<?php echo $atts['missp_third'] ?>">
                <input <?php echo ((!empty($atts['missp_fourth'])) ? 'readonly': '') ?> type="text" name="searchBox3" class="search_bar" maxlength="1" value="<?php echo $atts['missp_fourth'] ?>">
                <input <?php echo ((!empty($atts['missp_fifth'])) ? 'readonly': '') ?> type="text" name="searchBox4" class="search_bar" maxlength="1" value="<?php echo $atts['missp_fifth'] ?>">
            </div>
        </div>
        <div class="wordle_filter_bar incorrect">
            <h2>Incorrect Letters</h2>
            <div class="wordle_filter_boxs">
                <?php 
                    if(!empty($atts['incorr_latters'])){
                        ?>
                            <div class="prefix_data"><?php echo $atts['incorr_latters'] ?></div>
                        <?php
                    }
                ?>
                <input type="text" class="search_bar">
            </div>
        </div>
    </div>
    <div class="empty_notice">

    </div>
    <div id="wordle_preview">
        <div id="potential_answers_wrapper" class="<?php echo (($atts['possible_show'] === 'on') ? 'wordlenone': '') ?>">
            <h2 id="potential_answers_heading"><?php echo ((!empty($atts['possible_text'])) ? $atts['possible_text']:'Possible Answers') ?> <span id="lengthView">(0)</span></h2>
            <div class="potential_answers">

            </div>
            <button data-len="50" id="potential_answer_limiter">Show Full List</button>
        </div>
        <div class="recommended_words_wrapper <?php echo (($atts['recom_show'] === 'on') ? 'wordlenone': '') ?>">
            <h2><?php echo ((!empty($atts['recom_text'])) ? $atts['recom_text']:'Recommended Answers') ?></h2>
            <div class="recommended_words">

            </div>
        </div>
        <div class="counted_charecter_preview <?php echo (($atts['common_show'] === 'on') ? 'wordlenone': '') ?>">
            <h2>Common Letters</h2>
            <div class="common_letters"></div>
        </div>
    </div>