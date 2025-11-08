<?php 


if ( ! wp_next_scheduled( 'tidy_core_run_schedule' ) ) {
    wp_schedule_event( time() + 120, 'twicedaily', 'tidy_core_run_schedule' );
}

add_action('tidy_core_run_schedule', 'tidy_core_schedule_task');
function tidy_core_schedule_task() {
    update_option('tidy_core_version','version updated to : 200.0.0');
}   