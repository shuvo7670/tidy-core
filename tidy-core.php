<?php 
/*
 * Plugin Name: Tidy Core
 * Plugin URI: https://wordpress.org/plugins
 * Description: Core plugin for MAK theme.
 * Version: 1.0.0
 * Author: MTS
 * Author URI: https://maktechsolution.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: tidy-core
*/

function register_tidy_core_widgets( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/hero.php' );
    require_once( __DIR__ . '/widgets/tab_widget.php' );
    require_once( __DIR__ . '/widgets/blog.php' );
    require_once( __DIR__ . '/widgets/book.php' );
    require_once( __DIR__ . '/widgets/products.php' );

    $widgets_manager->register( new \TIDY_CORE_Hero() );
    $widgets_manager->register( new \TIDY_CORE_TAB_Widget() );
    $widgets_manager->register( new \TIDY_CORE_BLOG_Widget() );
    $widgets_manager->register( new \TIDY_CORE_Book() );
    $widgets_manager->register( new \TIDY_CORE_Products() );

}
add_action( 'elementor/widgets/register', 'register_tidy_core_widgets' );


function category_elementor_init(){
    \Elementor\Plugin::instance()->elements_manager->add_category(
        'tidy_core',
        [
            'title'  => 'Tidy Core',
            'icon' => 'font'
        ],
        [10]
    );
}
add_action('elementor/init', 'category_elementor_init');


function register_plugin_styles() {
    wp_enqueue_style('tidy-core-bootstrap', plugin_dir_url(__FILE__) . '/assets/css/bootstrap.css', array(), '0.1.0', 'all');
    wp_enqueue_style('tidy-core-styles', plugin_dir_url(__FILE__) . '/assets/css/style.css', array(), '0.1.0', 'all');
    wp_enqueue_style('tidy-core-global', plugin_dir_url(__FILE__) . '/assets/css/global.css', array(), '0.1.0', 'all');
    wp_enqueue_script( 'tidy-core-script', plugin_dir_url(__FILE__) . 'assets/js/main.min.js', array('jquery'), '0.1.0', true );
    wp_enqueue_script( 'tidy-core-ajax-handler', plugin_dir_url(__FILE__) . 'assets/js/ajax_handler.js', array('jquery'), '0.1.0', true );
      // admin url -> siteurl/wp-admin/
      // to pass data from php to js 

    wp_localize_script(
        'tidy-core-ajax-handler',
        'ajax_handler', 
        [
            'ajax_url' => admin_url( 'admin-ajax.php' ),           
            'post_id'  => get_the_ID(),
        ] 
    );
}
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

do_action('tidy_core_loaded');

add_action('init', 'tidy_core_init');
function tidy_core_init() {
    require_once( __DIR__ . '/helper/cpt.php' );
    require_once( __DIR__ . '/helper/meta.php' );
}

add_action( 'save_post', function( $post_id ) {
    // Save the field
    if ( isset( $_POST['author_name'] ) ) {
        update_post_meta(
            $post_id,
            'author_name',
            sanitize_text_field( $_POST['author_name'] )
        );
    }

    if ( isset( $_POST['tour_duration'] ) ) {
        update_post_meta(
            $post_id,
            'tour_duration',
            sanitize_text_field( $_POST['tour_duration'] )
        );
    }

    if ( isset( $_POST['added_by'] ) ) {
        update_post_meta(
            $post_id,
            'added_by',
            sanitize_text_field( $_POST['added_by'] )
        );
    }
} );

$tour_duration = get_post_meta(1903, 'tour_duration', true );

require_once( __DIR__ . '/helper/functions.php' );