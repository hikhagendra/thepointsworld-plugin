<?php

add_action('init', 'register_course_post_type', 11);
add_action('init', 'register_review_post_type', 11);

function register_course_post_type() {  
    $text_domain = TEXTDOMAIN; // Ensure TEXTDOMAIN is defined somewhere  
    $singular_name = 'Course';  
    $plural_name = 'Courses';  
    $post_type_slug = 'course';  
    $archive_slug = 'courses'; // Archive slug  
    $single_slug = 'course'; // Single course slug, for example  

    // Set rewrite rules  
    $rewrite = array(  
        'slug' => $single_slug, // slug for single post  
        'with_front' => false,  
        'feeds' => true,  
        'ep_mask' => EP_PERMALINK // Enable permalinks for this post type  
    );  

    $labels = array(  
        'name' => _x($plural_name, 'Post Type General Name', $text_domain),  
        'singular_name' => _x($singular_name, 'Post Type Singular Name', $text_domain),  
        'menu_name' => __($plural_name, $text_domain),  
        'name_admin_bar' => __($plural_name, $text_domain),  
        'archives' => __($plural_name . ' Archives', $text_domain),  
        'parent_item_colon' => __('Parent Item:', $text_domain),  
        'all_items' => __('All ' . $plural_name, $text_domain),  
        'add_new_item' => __('Add New ' . $singular_name, $text_domain),  
        'add_new' => __('Add New', $text_domain),  
        'new_item' => __('New ' . $singular_name, $text_domain),  
        'edit_item' => __('Edit ' . $singular_name, $text_domain),  
        'update_item' => __('Update ' . $singular_name, $text_domain),  
        'view_item' => __('View ' . $singular_name, $text_domain),  
        'search_items' => __('Search ' . $singular_name, $text_domain),  
        'not_found' => __('Not found', $text_domain),  
        'not_found_in_trash' => __('Not found in Trash', $text_domain),  
        'featured_image' => __('Featured Image', $text_domain),  
        'set_featured_image' => __('Set featured image', $text_domain),  
        'remove_featured_image' => __('Remove featured image', $text_domain),  
        'use_featured_image' => __('Use as featured image', $text_domain),  
        'insert_into_item' => __('Insert into ' . $singular_name, $text_domain),  
        'uploaded_to_this_item' => __('Uploaded to this ' . $singular_name, $text_domain),  
        'items_list' => __($singular_name . ' list', $text_domain),  
        'items_list_navigation' => __($singular_name . ' list navigation', $text_domain),  
        'filter_items_list' => __('Filter ' . $singular_name . ' list', $text_domain),  
    );  

    $args = array(  
        'label' => __($singular_name, $text_domain),  
        'description' => __($singular_name, $text_domain),  
        'labels' => $labels,  
        'supports' => array('title', 'editor', 'thumbnail'),  
        'show_in_rest' => true,  
        'hierarchical' => true,  
        'public' => true,  
        'show_ui' => true,  
        'show_in_menu' => true,  
        'menu_position' => 25,  
        'menu_icon' => 'dashicons-book-alt',  
        'show_in_admin_bar' => true,  
        'show_in_nav_menus' => true,  
        'can_export' => true,  
        'has_archive' => $archive_slug, // Archive slug  
        'exclude_from_search' => true,  
        'rewrite' => $rewrite, // Single post rewrite settings  
    );  

    register_post_type($post_type_slug, $args);  
}

function register_review_post_type() {  
    $text_domain = TEXTDOMAIN; // Ensure TEXTDOMAIN is defined somewhere  
    $singular_name = 'Review';  
    $plural_name = 'Reviews';  
    $post_type_slug = 'course_review';  
    $archive_slug = 'reviews'; // Archive slug  
    $single_slug = 'review'; // Single course slug, for example  

    // Set rewrite rules  
    $rewrite = array(  
        'slug' => $single_slug, // slug for single post  
        'with_front' => false,  
        'feeds' => true,  
        'ep_mask' => EP_PERMALINK // Enable permalinks for this post type  
    );  

    $labels = array(  
        'name' => _x($plural_name, 'Post Type General Name', $text_domain),  
        'singular_name' => _x($singular_name, 'Post Type Singular Name', $text_domain),  
        'menu_name' => __($plural_name, $text_domain),  
        'name_admin_bar' => __($plural_name, $text_domain),  
        'archives' => __($plural_name . ' Archives', $text_domain),  
        'parent_item_colon' => __('Parent Item:', $text_domain),  
        'all_items' => __('All ' . $plural_name, $text_domain),  
        'add_new_item' => __('Add New ' . $singular_name, $text_domain),  
        'add_new' => __('Add New', $text_domain),  
        'new_item' => __('New ' . $singular_name, $text_domain),  
        'edit_item' => __('Edit ' . $singular_name, $text_domain),  
        'update_item' => __('Update ' . $singular_name, $text_domain),  
        'view_item' => __('View ' . $singular_name, $text_domain),  
        'search_items' => __('Search ' . $singular_name, $text_domain),  
        'not_found' => __('Not found', $text_domain),  
        'not_found_in_trash' => __('Not found in Trash', $text_domain),  
        'featured_image' => __('Featured Image', $text_domain),  
        'set_featured_image' => __('Set featured image', $text_domain),  
        'remove_featured_image' => __('Remove featured image', $text_domain),  
        'use_featured_image' => __('Use as featured image', $text_domain),  
        'insert_into_item' => __('Insert into ' . $singular_name, $text_domain),  
        'uploaded_to_this_item' => __('Uploaded to this ' . $singular_name, $text_domain),  
        'items_list' => __($singular_name . ' list', $text_domain),  
        'items_list_navigation' => __($singular_name . ' list navigation', $text_domain),  
        'filter_items_list' => __('Filter ' . $singular_name . ' list', $text_domain),  
    );  

    $args = array(  
        'label' => __($singular_name, $text_domain),  
        'description' => __($singular_name, $text_domain),  
        'labels' => $labels,  
        'supports' => array('title', 'editor', 'author'),  
        'show_in_rest' => true,  
        'hierarchical' => true,  
        'public' => false,  
        'show_ui' => true,  
        'show_in_menu' => true,  
        'menu_position' => 25,  
        'menu_icon' => 'dashicons-star-filled',  
        'show_in_admin_bar' => true,  
        'show_in_nav_menus' => true,  
        'can_export' => true,  
        'has_archive' => $archive_slug, // Archive slug  
        'exclude_from_search' => true,  
        'rewrite' => $rewrite, // Single post rewrite settings  
    );  

    register_post_type($post_type_slug, $args);  
}