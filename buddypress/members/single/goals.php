<?php
/**
 * BuddyBoss - Users Goals
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
?>

<div id="my-goals">
    <?php
    if( have_rows('user_goals', 'user_'.get_current_user_id()) ):

        while( have_rows('user_goals', 'user_'.get_current_user_id()) ) : the_row();

            $goalId = get_sub_field('id');
            $relatedTopic = get_sub_field('related_topic');
            $relatedLesson = get_sub_field('related_lesson');
            $relatedCourse = get_sub_field('related_course');
            $goalText = get_sub_field('goal_text');
            $goalStatus = get_sub_field('status');
            $goalValue = get_sub_field('value');

            $checkbox_class = ($goalStatus == 'complete' || $goalStatus == 'approved') ? 'fa-check-square' : 'fa-square';
            $checkbox_class .= ($goalStatus == 'complete' || $goalStatus == 'incomplete' || $goalStatus == 'verified') ? ' enabled' : ' disabled';
            ?>
            <div class="goal">
                <div class="grid-x">
                    <div class="cell small-2 text-right">
                        <div class="checkbox"><i class="far <?php echo $checkbox_class; ?> fa-2x" title="Mark as complete" onclick="return goalChecked(this, '<?php echo $goalId;?>', '<?php echo $relatedCourse;?>' );"></i></div>
                    </div>
                    <div class="cell small-10">
                        <h5 class="goal-topic"><?php echo get_the_title($relatedTopic); ?></h5>
                        <?php echo $goalText; ?>
                    </div>
                </div>
                <?php

            endwhile;

        endif;

        ?>
        <script type="text/javascript">
            function goalChecked(el, goal_id, course_id, goal_status) {
                console.log("goal checkbox clicked for goal_id: " + goal_id);
                
                if (jQuery(el).hasClass("disabled")) {
                    console.log("DISABLED!");
                    return false;
                }

                var goal_checked = false;

                if (!jQuery(el).hasClass("fa-check-square")) {
                    goal_checked = true;
                }

                jQuery(el).removeClass("fa-check-square fa-square").addClass("fas fa-circle-notch fa-spin");

                jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php');?>',
                    dataType: "html",  
                    data: { 
                        action : 'austeve_update_user_goal_status', 
                        security: '<?php echo wp_create_nonce( "update-user-goal-".get_current_user_id()); ?>',
                        user_id: <?php echo get_current_user_id();?>,
                        goal_id: goal_id,
                        course_id: course_id,
                        goal_status: goal_checked ? 'complete' : 'incomplete'
                    },
                    error: function (xhr, status, error) {
                        if (goal_checked == true) {
                            jQuery(el).addClass("fa-square");
                        }
                        else  {
                            jQuery(el).addClass("fa-checked-square");
                        }
                        jQuery(el).removeClass("fas fa-circle-notch fa-spin");
                    },
                    success: function( response ) {
                        if (response == "success") {
                            if (goal_checked == true) {
                                jQuery(el).addClass("fa-check-square");
                            }
                            else {
                                jQuery(el).addClass("fa-square");
                            }
                            jQuery(el).removeClass("fas fa-circle-notch fa-spin");

                        }
                        else {
                            if (goal_checked == true) {
                                jQuery(el).addClass("fa-square");
                            }
                            else {
                                jQuery(el).addClass("fa-checked-square");
                            }
                            jQuery(el).removeClass("fas fa-circle-notch fa-spin");
                        }

                    }
                });
            }
        </script>
    </div>