<?php

/**
 * Display Topics and Lesson lists for learn
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

global $post;
$currentPost = $post;
?>

<?php do_action('tutor_lesson/single/before/lesson_lists'); ?>

    <div class="tutor-topics-lesson-list">
		<?php

		$course_id = get_post_meta($post->ID, '_tutor_course_id_for_lesson', true);
		$topics = tutor_utils()->get_topics($course_id);

		if ($topics->have_posts()){

			while ($topics->have_posts()){ $topics->the_post();
				?>

                <div class="tutor-topics-in-single-lesson">
                    <div class="tutor-topics-title">
                        <h2><?php the_title(); ?></h2>
                    </div>

                    <div class="tutor-lessons-under-topic">
						<?php
						$lessons = tutor_utils()->get_lessons_by_topic(get_the_ID());
						if ($lessons->have_posts()){
							while ($lessons->have_posts()){
								$lessons->the_post();

								$video = tutor_utils()->get_video_info();

								$play_time = false;
								if ($video){
									$play_time = $video->playtime;
								}

								$is_completed_lesson = tutor_utils()->is_completed_lesson();
                                ?>
                                <p class="<?php echo ($currentPost->ID === get_the_ID()) ? 'active' : ''; ?>">
                                    <a href="<?php the_permalink(); ?>">
										<?php if ($play_time){ ?>
                                            <span class="play_icon">
                                                <img src="<?php echo tutor()->url.'assets/images/play-button.png'; ?>" />
                                            </span>
										<?php } ?>

                                        <span class="lesson_title"><?php the_title(); ?></span>

										<?php if ($play_time){ ?>
                                            <span class="play_duration"><?php echo $play_time; ?></span>
										<?php } ?>

	                                    <?php if ($is_completed_lesson){ ?>
                                            <span class="is_completed">&check;</span>
	                                    <?php } ?>
                                    </a>
                                </p>
								<?php
							}
							$lessons->reset_postdata();
						}
						?>
                    </div>
                </div>

				<?php
			}
			$topics->reset_postdata();
			wp_reset_postdata();
		}
		?>
    </div>

<?php do_action('tutor_lesson/single/after/lesson_lists'); ?>