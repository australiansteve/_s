<?php
/**
 * BuddyBoss - Member Courses
 *
 * @since BuddyBoss 1.2.0
 * @version 1.0.0
 */

$filepath = locate_template(
	array(
		'learndash/learndash_template_script.min.js',
		'learndash/learndash_template_script.js',
		'learndash_template_script.min.js',
		'learndash_template_script.js',
	)
);

if ( ! empty( $filepath ) ) {
	wp_enqueue_script( 'learndash_template_script_js', str_replace( ABSPATH, '/', $filepath ), array( 'jquery' ), LEARNDASH_VERSION, true );
	$learndash_assets_loaded['scripts']['learndash_template_script_js'] = __FUNCTION__;
} elseif ( file_exists( LEARNDASH_LMS_PLUGIN_DIR . '/templates/learndash_template_script' . ( ( defined( 'LEARNDASH_SCRIPT_DEBUG' ) && ( LEARNDASH_SCRIPT_DEBUG === true ) ) ? '' : '.min' ) . '.js' ) ) {
	wp_enqueue_script( 'learndash_template_script_js', LEARNDASH_LMS_PLUGIN_URL . 'templates/learndash_template_script' . ( ( defined( 'LEARNDASH_SCRIPT_DEBUG' ) && ( LEARNDASH_SCRIPT_DEBUG === true ) ) ? '' : '.min' ) . '.js', array( 'jquery' ), LEARNDASH_VERSION, true );
	$learndash_assets_loaded['scripts']['learndash_template_script_js'] = __FUNCTION__;

	$data            = array();
	$data['ajaxurl'] = admin_url( 'admin-ajax.php' );
	$data            = array( 'json' => json_encode( $data ) );
	wp_localize_script( 'learndash_template_script_js', 'sfwd_data', $data );

}

//LD_QuizPro::showModalWindow();
add_action( 'wp_footer', array( 'LD_QuizPro', 'showModalWindow' ), 20 );

$user_id            = bp_displayed_user_id();
$atts               = apply_filters( 'bp_learndash_user_courses_atts', array() );
$user_courses       = apply_filters( 'bp_learndash_user_courses', ld_get_mycourses( $user_id, $atts ) );
$usermeta           = get_user_meta( $user_id, '_sfwd-quizzes', true );
$quiz_attempts_meta = empty( $usermeta ) ? false : $usermeta;
$quiz_attempts      = array();

if ( ! empty( $quiz_attempts_meta ) ) {
	foreach ( $quiz_attempts_meta as $quiz_attempt ) {
		$c                          = learndash_certificate_details( $quiz_attempt['quiz'], $user_id );
		$quiz_attempt['post']       = get_post( $quiz_attempt['quiz'] );
		$quiz_attempt['percentage'] = ! empty( $quiz_attempt['percentage'] ) ? $quiz_attempt['percentage'] : ( ! empty( $quiz_attempt['count'] ) ? $quiz_attempt['score'] * 100 / $quiz_attempt['count'] : 0 );

		if ( $user_id == get_current_user_id() && ! empty( $c['certificateLink'] ) && ( ( isset( $quiz_attempt['percentage'] ) && $quiz_attempt['percentage'] >= $c['certificate_threshold'] * 100 ) ) ) {
			$quiz_attempt['certificate'] = $c;
		}
		$quiz_attempts[ learndash_get_course_id( $quiz_attempt['quiz'] ) ][] = $quiz_attempt;
	}
}
?>
<div id="learndash_profile" class="<?php echo empty( $user_courses ) ? 'user-has-no-lessons' : ''; ?>">
	<div id="course_list" class="grid-x small-up-1 medium-up-2 grid-margin-x align-center">
		<?php
		if ( ! empty( $user_courses ) ) {
			foreach ( $user_courses as $course_id ) {

				/**
				 * Do not show the free/open course unless those are explicitly started by the users
				 *
				 */

				//Check user have enrolled for course
				$since = ld_course_access_from( $course_id, $user_id );

				/**
				 * if $since is empty then this could be a free/open course
				 * however we need to check for learndash group level course enrollment status
				 */
				if ( empty( $since ) ) {

					//Check user has mass enrolled for course
					$since = learndash_user_group_enrolled_to_course_from( $user_id, $course_id );

					/**
					 * if $since is still empty then we absolutely sure that the course is free/open
					 * now we only need to check "Has user started taking course? or Did he completed it?"
					 */
					if ( empty( $since ) ) {

						//Check user has started course(topic or lesson)
						$course_status = learndash_course_status( $course_id, $user_id, true );

						if ( 'not_started' === $course_status ) {
							continue;
						}
					}
				}

				$course      = get_post( $course_id );
				$course_link = get_permalink( $course_id );
				$progress    = learndash_course_progress(
					array(
						'user_id'   => $user_id,
						'course_id' => $course_id,
						'array'     => true,
					)
				);
				$status      = ( $progress['percentage'] == 100 ) ? 'completed' : 'notcompleted';
				?>
				<div id="course-<?php echo $course->ID; ?>" class="cell text-center">

					<div class="learndash-course-link color-<?php echo get_field('course_accent_color', $course_id); ?>">
							<a href="<?php echo esc_attr( $course_link ); ?>">
							<div class="grid-y align-center" style="height: 200px">
								<div class="cell">
									<h3 class="course-title"><?php echo $course->post_title; ?></h3>
								</div>
							</div>
						</a>
					</div>

					<dd class="course_progress" title='<?php echo sprintf( __( '%s out of %s steps completed', 'buddyboss' ), $progress['completed'], $progress['total'] ); ?>'>

						<?php echo esc_attr( $progress['percentage'] ); ?>% <?php _e( 'COMPLETE', 'hamburger-cat' ); ?> 
						<div class="course_progress_fill" style='width: <?php echo esc_attr( $progress['percentage'] ); ?>%;'></div>
					</dd>

					<?php 
					$next_step = learndash_user_progress_get_first_incomplete_step( $user_id,  $course_id );
					error_log("next step: ".print_r($next_step, true));
					if ($next_step) :
					?>
						<a class="continue-course button yellow" href="<?php echo get_permalink($next_step);?>">
							<?php _e('Continue Course', 'hamburger-cat');?>
						</a>
					<?php endif; ?>
				</div>
				<?php
			}
		} else {
			?>
			<aside class="bp-feedback bp-messages info">

				<span class="bp-icon" aria-hidden="true"></span>
				<p><?php printf( __( 'Sorry, no %s were found.', 'buddyboss' ), LearnDash_Custom_Label::label_to_lower( 'courses' ) ); ?></p>

			</aside>
			<?php
		}
		?>
	</div>
</div>
