<?php

/* Social Media CPT */
function register_social_media_cpt()
{

    register_post_type('social_media', array(
        'labels'       => array(
            'name'           => 'Social Media',
            'singular_name'  => 'Social Media Post',
            'menu_name'      => 'Social Media',
            'all_items'      => 'All Posts',
            'add_new_item'   => 'Add Post',
            'edit_item'      => 'Edit Post',
        ),
        'public'       => true,
        'show_in_rest' => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'social-media'),
        'menu_icon'    => 'dashicons-share',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
    ));

    /* Social Media Category */
    register_taxonomy('social_media_category', array('social_media'), array(
        'hierarchical'      => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'labels'            => array(
            'name'              => 'Categories',
            'singular_name'     => 'Category',
            'search_items'      => 'Search Categories',
            'all_items'         => 'All Categories',
            'edit_item'         => 'Edit Category',
            'update_item'       => 'Update Category',
            'add_new_item'      => 'Add New Category',
            'new_item_name'     => 'New Category Name',
            'menu_name'         => 'Categories',
        ),
    ));
}
add_action('init', 'register_social_media_cpt');


/* Social Media Filter Script */
function load_scripts()
{
    wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css', array(), '1.0.1', false);
    wp_enqueue_script('main_js', get_stylesheet_directory_uri() . '/js/main.js', array(), '1.0.1', true);
}
add_action('wp_enqueue_scripts', 'load_scripts');
