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

    $widgets_manager->register( new \TIDY_CORE_Hero() );
    $widgets_manager->register( new \TIDY_CORE_TAB_Widget() );
    $widgets_manager->register( new \TIDY_CORE_BLOG_Widget() );
    $widgets_manager->register( new \TIDY_CORE_Book() );

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
    wp_enqueue_style('tidy-core-styles', plugin_dir_url(__FILE__) . '/assets/css/style.css', array(), '0.1.0', 'all');
    wp_enqueue_script( 'tidy-core-script', plugin_dir_url(__FILE__) . 'assets/js/main.min.js', array('jquery'), '0.1.0', true );
}
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );


add_action('init', 'tidy_core_init');
function tidy_core_init() {
    require_once( __DIR__ . '/helper/cpt.php' );
    require_once( __DIR__ . '/helper/meta.php' );
}

add_action( 'save_post', function( $post_id ) {

    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save the field
    if ( isset( $_POST['author_name'] ) ) {
        update_post_meta(
            $post_id,
            'author_name',
            sanitize_text_field( $_POST['author_name'] )
        );
    } else {
        delete_post_meta( $post_id, 'author_name' );
    }
} );
