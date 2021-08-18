<?php
/**
 * BuddyBoss - Users Students
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
?>

<div id="my-goals">
    <?php
    if( have_rows('user_goals', 'user_'.get_current_user_id()) ):

        while( have_rows('user_goals', 'user_'.get_current_user_id()) ) : the_row();

            $relatedTopic = get_sub_field('related_topic');
            $goalText = get_sub_field('goal_text');
            $goalCompleted = get_sub_field('goal_status');
 
        ?>
        <div class="goal">
            <div class="grid-x">
                <div class="cell small-2 text-right">
                    <div class="checkbox"><i class="far fa-square fa-2x" title="Mark as complete" onclick="return goalChecked(this, <?php echo $relatedTopic;?>);"></i></div>
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
        function goalChecked(el, topicId) {
            console.log("goal checkbox clicked for topic: " + topicId);

            if (jQuery(el).hasClass("fa-check-square")) {
jQuery(el).removeClass("fa-check-square");
            jQuery(el).addClass("fa-square");
            }
            else {
                jQuery(el).addClass("fa-check-square");
            jQuery(el).removeClass("fa-square");
            }
            
        }
    </script>
</div>