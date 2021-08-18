<?php
/**
 * BuddyBoss - Users Students
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
?>

<?php
$ajax_nonce = wp_create_nonce( "get-student-results" );

$austevexAPI = new AUSteve_xAPI();

$users = array();

    //Gets the list of group IDs administered by the user.
$groups = learndash_get_administrators_group_ids( get_current_user_id() );
    //error_log("Groups: ".print_r($groups, true));

foreach($groups as $group) {
    //Gets the list of user objects that belong to a group.
    $groupUsers = learndash_get_groups_users( $group );
    //error_log("Group users [$group]: ".print_r($groupUsers, true));

    foreach($groupUsers as $user) {

        if (!array_key_exists($user->ID, $users)) {
            $users[$user->ID] = array( 'id' => $user->ID, 'name' => $user->data->display_name, 'email' => $user->data->user_email, 'pronouns' => get_field('pronouns', 'user_'.$user->ID) );

        }
    }

}

?>
<div class="user accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">

    <?php

    foreach( $users as $user ) {
        $completion_times = get_field('lesson_completion_times', 'user_'.$user['id']);
        ?>
        <div class="user accordion-item" data-accordion-item data-user-id="<?php echo $user['id'];?>">
            <a href="#" class="accordion-title">

                <span class="avatar"><?php echo bp_get_group_member_avatar(array('item_id' => $user['id'], 'alt' => $user['name'])); ?></span>
                <div class="user-header">
                    <h5><?php echo $user['name'];?></h5>
                    <span class="pronouns"><?php echo $user['pronouns'];?></span>
                </div>
            </a>
            <div class="student-details accordion-content" data-tab-content data-user-id="<?php echo $user['id'];?>">
                <div class="student-progress">
                    <div class="results-loading text-center">
                        <i class="fas fa-2x fa-spinner fa-spin"></i>
                    </div>
                </div>
                <div class="student-goals">
                    
                </div>
                <div class="student-actions text-center">
                    <a class="button" href="<?php echo wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . bp_core_get_username( $user['id'] ) );?>">Send Message</a>
                </div>
            </div>
        </div>
        
        <?php
    }

    ?>
    <script type="text/javascript">
        function get_user_details(user_id) {
            console.log("get_user_details: " + user_id);

            jQuery.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php');?>',
                dataType: "html",  
                data: { 
                    action : 'austeve_get_user_results', 
                    security: '<?php echo $ajax_nonce; ?>',
                    user_id: user_id
                },
                error: function (xhr, status, error) {
                    console.log("Error: " + error);
                    jQuery("#search-result-summary").addClass('error').html("Search failed. Please contact us for further support");
                },
                success: function( response ) {
                    if (response) {
                        //console.log("response! " + response);
                        var detailsPanel = jQuery('.student-details[data-user-id='+user_id+'] .student-progress');
                        detailsPanel.html(response);
                        detailsPanel.parents(".user.accordion-item").first().attr('data-results-loaded', 'true');

                        var newAccordion = jQuery('.student-details[data-user-id='+user_id+'] .accordion.lessons')
                        var elem = new Foundation.Accordion(newAccordion);

                    }
                    else {
                        console.log("NO response!");

                    }
                }
            });

        }

        jQuery(document).on('click', 'div.user.accordion-item>a', function(el) {

                var parent = jQuery(el.target).parents(".user.accordion-item.is-active").first(); //is-active class will already be added if expanding

                if (parent.length && parent.attr('data-results-loaded') != 'true') {
                    console.log("accordion item clicked " + JSON.stringify(parent.data()));
                    var userId = parent.data('userId');
                    if (userId >= 0) {
                        get_user_details(userId);
                    }
                }
            });

        </script>

    </div>

