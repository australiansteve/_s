<?php
/**
 * BuddyBoss - Users Achievements
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
?>

<?php
$currentUserId = get_current_user_id();
$userCourses = ld_get_mycourses($currentUserId);

foreach($userCourses as $course) {
    $courseProgress = learndash_user_get_course_progress( $currentUserId,  $course);

?>
<div class="grid-x small-up-2 medium-up-3 grid-margin-x">
<?php
    foreach($courseProgress['lessons'] as $lkey => $lvalue) {
        if ($lvalue) {
            echo "<div class='cell text-center'>".get_the_post_thumbnail($lkey, 'achievement')."<div>".get_the_title($course).": ".get_the_title($lkey)."</div>"."</div>";
        }
    }
    ?>
</div>
<?php
}

?>
