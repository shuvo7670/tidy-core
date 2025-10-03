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
    'supports'           => array( 'title', 'editor', 'thumbnail' ),
);

register_post_type( 'book', $args );

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
