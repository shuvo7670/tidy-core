<?php 

$labels = array(
    'name'                  => _x( 'Books', 'Post type general name', 'tidy-core' ),
    'singular_name'         => _x( 'Book', 'Post type singular name', 'tidy-core' ),
    'menu_name'             => _x( 'Books', 'Admin Menu text', 'tidy-core' ),
    'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'tidy-core' ),
    'add_new'               => __( 'Add New', 'tidy-core' ),
    'add_new_item'          => __( 'Add New Book', 'tidy-core' ),
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'book' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor', 'thumbnail', '_author_name' ),
);

register_post_type( 'book', $args );


$labels = array(
    'name'                  => _x( 'Tours', 'Post type general name', 'tidy-core' ),
    'singular_name'         => _x( 'Tour', 'Post type singular name', 'tidy-core' ),
    'menu_name'             => _x( 'Tours', 'Admin Menu text', 'tidy-core' ),
    'name_admin_bar'        => _x( 'Tour', 'Add New on Toolbar', 'tidy-core' ),
    'add_new'               => __( 'Add New', 'tidy-core' ),
    'add_new_item'          => __( 'Add New Tour', 'tidy-core' ),
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'tour' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor', 'thumbnail', '_author_name' ),
);

register_post_type( 'tour', $args );

$category_labels = array(
    'name'              => _x( 'Books Category', 'taxonomy general name', 'tidy-core' ),
    'singular_name'     => _x( 'Book Category', 'taxonomy singular name', 'tidy-core' ),
    'search_items'      => __( 'Search Books', 'tidy-core' ),
    'all_items'         => __( 'All Books Category', 'tidy-core' ),
    'parent_item'       => __( 'Parent Book Category', 'tidy-core' ),
    'parent_item_colon' => __( 'Parent Book Category:', 'tidy-core' ),
    'edit_item'         => __( 'Edit Book Category', 'tidy-core' ),
    'update_item'       => __( 'Update Book Category', 'tidy-core' ),
    'add_new_item'      => __( 'Add New Book Category', 'tidy-core' ),
    'new_item_name'     => __( 'New Book Category Name', 'tidy-core' ),
    'menu_name'         => __( 'Book Category', 'tidy-core' ),
);


register_taxonomy( 'book-category', 'book', array(
    'rewrite'      => array( 'slug' => 'book-category' ),
    'labels'       => $category_labels,
    'hierarchical'      => true,
) );



$tour_types_labels = array(
    'name'              => _x( 'Tour Types', 'taxonomy general name', 'tidy-core' ),
    'singular_name'     => _x( 'Tour Types', 'taxonomy singular name', 'tidy-core' ),
    'search_items'      => __( 'Search Tour', 'tidy-core' ),
    'all_items'         => __( 'All Tour Types', 'tidy-core' ),
    'parent_item'       => __( 'Parent Tour Types', 'tidy-core' ),
    'parent_item_colon' => __( 'Parent Tour Types:', 'tidy-core' ),
    'edit_item'         => __( 'Edit Tour Types', 'tidy-core' ),
    'update_item'       => __( 'Update Tour Types', 'tidy-core' ),
    'add_new_item'      => __( 'Add New Tour Types', 'tidy-core' ),
    'new_item_name'     => __( 'New Tour Types Name', 'tidy-core' ),
    'menu_name'         => __( 'Tour Types', 'tidy-core' ),
);

register_taxonomy( 'tour-type', 'tour', array(
    'rewrite'      => array( 'slug' => 'tour-type' ),
    'labels'       => $tour_types_labels,
    'hierarchical' => true,
) );
