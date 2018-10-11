<?php
/**
 * Question and answer
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 */

?>


<div class="tutor-queston-and-answer-wrap">


    <div class="tutor-question-top">

        <div class="tutor-question-search-form">
            <form method="get">
                <input type="text" name="q" value="" placeholder="<?php _e('search for a question', 'tutor'); ?>">
                <button type="submit" name="tutor_question_search_btn"><?php _e('Search Question', 'tutor'); ?> </button>
            </form>
        </div>


        <div class="tutor-ask-question-btn-wrap">
            <a href="javascript:;" class="tutor-ask-question-btn tutor-btn"> <?php _e('Ask a new question', 'tutor'); ?> </a>
        </div>

    </div>

    <div class="tutor-add-question-wrap">

        <form method="post" id="tutor-ask-question-form">
			<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
            <input type="hidden" value="add_question" name="tutor_action"/>
            <input type="hidden" value="<?php echo get_the_ID(); ?>" name="tutor_course_id"/>

            <div class="tutor-form-group">
                <input type="text" name="question_title" value="" placeholder="<?php _e('Question Title', 'tutor'); ?>">
            </div>

            <div class="tutor-form-group">
				<?php
				$settings = array(
					'teeny' => true,
					'media_buttons' => false,
					'quicktags' => false,
					'editor_height' => 100,
				);
				wp_editor(null, 'question', $settings);
				?>
            </div>

            <div class="tutor-form-group">
                <a href="javascript:;" class="tutor_question_cancel"><?php _e('Cancel', 'tutor'); ?></a>
                <button type="submit" class="tutor-btn tutor_ask_question_btn" name="tutor_question_search_btn"><?php _e('Post Question', 'tutor'); ?> </button>
            </div>
        </form>


    </div>



    <div class="tutor_question_answer_wrap">




		<?php
		$questions = tutor_utils()->get_top_question();
		?>


		<?php
		if (is_array($questions) && count($questions)){
			foreach ($questions as $question){
				$answers = tutor_utils()->get_qa_answer_by_question($question->comment_ID);
				?>
                <div class="tutor_original_question">
                    <div class="question-left">
	                    <?php echo tutor_utils()->get_tutor_avatar($question->display_name); ?>
                    </div>

                    <div class="question-right">
                        <div class="question-top-meta">
                            <p class="review-meta">
		                        <?php echo $question->display_name; ?> -
                                <span class="tutor-text-mute"><?php _e(sprintf('%s ago', human_time_diff(strtotime($question->comment_date))), 'lms'); ?></span>
                            </p>
                        </div>

                        <div class="tutor_question_area">
                            <p><strong><?php echo $question->question_title; ?> </strong></p>
	                        <?php echo wpautop($question->comment_content); ?>
                        </div>
                    </div>
                </div>



                <div class="tutor_admin_answers_list_wrap">
					<?php
					if (is_array($answers) && count($answers)){
						foreach ($answers as $answer){
							?>
                            <div class="tutor_individual_answer <?php echo ($question->user_id == $answer->user_id) ? 'tutor-bg-white' : 'tutor-bg-light'
							?> ">
                                <div class="question-left">
	                                <?php echo tutor_utils()->get_tutor_avatar($answer->display_name); ?>
                                </div>

                                <div class="question-right">
                                    <div class="question-top-meta">
                                        <p class="review-meta">
											<?php echo $answer->display_name; ?> -
                                            <span class="tutor-text-mute">
										<?php _e(sprintf('%s ago', human_time_diff(strtotime($answer->comment_date))), 'lms'); ?>
									</span>
                                        </p>
                                    </div>

                                    <div class="tutor_question_area">
										<?php echo wpautop(stripslashes($answer->comment_content)); ?>
                                    </div>
                                </div>
                            </div>
							<?php
						}
					}
					?>
                </div>





				<?php
			}
		}
		?>


        <div class="tutor_answer_list">




        </div>


    </div>


</div>
