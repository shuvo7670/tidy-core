<?php 


register_post_meta( 'book', 'author_name', array(
    'show_in_rest'      => true, // Expose to the REST API for Gutenberg
    'single'            => true, // It holds one value
    'type'              => 'string', // Data type
    'sanitize_callback' => 'sanitize_text_field',
    'auth_callback'     => '__return_true', // Allow all logged-in users to edit (adjust as needed)
) );

add_action( 'add_meta_boxes', function() {
    add_meta_box(
        'author_name_box',            // ID
        'Author Name',                // Title
        'render_author_name_metabox', // Callback
        'book',                       // Post type
        'normal',                       // Context (normal, side, advanced)
        'default'                     // Priority
    );
} );

function render_author_name_metabox( $post ) {
    // Get existing value (or an empty string)
    $value = get_post_meta( $post->ID, 'author_name', true );

    ?>
        <label for="author_name">Book Author :</label>
        <div>
            <input type="text" name="author_name" id="author_name" value="<?php echo esc_attr( $value ); ?>" size="25" />
        </div>
    <?php 
}
