<?php
/*
Plugin Name: USS Tornado
Description: A plugin to create custom post types for Command Staff and Events with custom fields.
Version: 1.0.3
Author: Feek21
GitHub Plugin URI: https://github.com/feek21/USS-Tornado
GitHub Branch: main
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register the Command Staff custom post type
function create_command_staff_cpt() {
    $labels = array(
        'name'                  => _x('Command Staff', 'Post Type General Name', 'textdomain'),
        'singular_name'         => _x('Command Staff', 'Post Type Singular Name', 'textdomain'),
        'menu_name'             => __('Command Staff', 'textdomain'),
        'name_admin_bar'        => __('Command Staff', 'textdomain'),
        'archives'              => __('Command Staff Archives', 'textdomain'),
        'attributes'            => __('Command Staff Attributes', 'textdomain'),
        'parent_item_colon'     => __('Parent Command Staff:', 'textdomain'),
        'all_items'             => __('All Command Staff', 'textdomain'),
        'add_new_item'          => __('Add New Command Staff', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'new_item'              => __('New Command Staff', 'textdomain'),
        'edit_item'             => __('Edit Command Staff', 'textdomain'),
        'update_item'           => __('Update Command Staff', 'textdomain'),
        'view_item'             => __('View Command Staff', 'textdomain'),
        'view_items'            => __('View Command Staff', 'textdomain'),
        'search_items'          => __('Search Command Staff', 'textdomain'),
        'not_found'             => __('Not found', 'textdomain'),
        'not_found_in_trash'    => __('Not found in Trash', 'textdomain'),
        'featured_image'        => __('Featured Image', 'textdomain'),
        'set_featured_image'    => __('Set featured image', 'textdomain'),
        'remove_featured_image' => __('Remove featured image', 'textdomain'),
        'use_featured_image'    => __('Use as featured image', 'textdomain'),
        'insert_into_item'      => __('Insert into Command Staff', 'textdomain'),
        'uploaded_to_this_item' => __('Uploaded to this Command Staff', 'textdomain'),
        'items_list'            => __('Command Staff list', 'textdomain'),
        'items_list_navigation' => __('Command Staff list navigation', 'textdomain'),
        'filter_items_list'     => __('Filter Command Staff list', 'textdomain'),
    );
    
    $args = array(
        'label'                 => __('Command Staff', 'textdomain'),
        'description'           => __('Custom Post Type for Command Staff', 'textdomain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),  // Thumbnail for Feature Image
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'menu_icon'             => 'dashicons-admin-users',
    );
    
    register_post_type('staff', $args);
}
add_action('init', 'create_command_staff_cpt', 0);

// Register the Events custom post type
function create_events_cpt() {
    $labels = array(
        'name'                  => _x('Events', 'Post Type General Name', 'textdomain'),
        'singular_name'         => _x('Event', 'Post Type Singular Name', 'textdomain'),
        'menu_name'             => __('Events', 'textdomain'),
        'name_admin_bar'        => __('Event', 'textdomain'),
        'archives'              => __('Event Archives', 'textdomain'),
        'attributes'            => __('Event Attributes', 'textdomain'),
        'parent_item_colon'     => __('Parent Event:', 'textdomain'),
        'all_items'             => __('All Events', 'textdomain'),
        'add_new_item'          => __('Add New Event', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'new_item'              => __('New Event', 'textdomain'),
        'edit_item'             => __('Edit Event', 'textdomain'),
        'update_item'           => __('Update Event', 'textdomain'),
        'view_item'             => __('View Event', 'textdomain'),
        'view_items'            => __('View Events', 'textdomain'),
        'search_items'          => __('Search Events', 'textdomain'),
        'not_found'             => __('Not found', 'textdomain'),
        'not_found_in_trash'    => __('Not found in Trash', 'textdomain'),
        'featured_image'        => __('Featured Image', 'textdomain'),
        'set_featured_image'    => __('Set featured image', 'textdomain'),
        'remove_featured_image' => __('Remove featured image', 'textdomain'),
        'use_featured_image'    => __('Use as featured image', 'textdomain'),
        'insert_into_item'      => __('Insert into Event', 'textdomain'),
        'uploaded_to_this_item' => __('Uploaded to this Event', 'textdomain'),
        'items_list'            => __('Events list', 'textdomain'),
        'items_list_navigation' => __('Events list navigation', 'textdomain'),
        'filter_items_list'     => __('Filter Events list', 'textdomain'),
    );
    
    $args = array(
        'label'                 => __('Event', 'textdomain'),
        'description'           => __('Custom Post Type for Events', 'textdomain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'menu_icon'             => 'dashicons-calendar-alt',
    );
    
    register_post_type('events', $args);
}
add_action('init', 'create_events_cpt', 0);

// Add Meta Boxes for Command Staff and Events
function add_custom_metaboxes() {
    // Command Staff meta boxes
    add_meta_box(
        'command_staff_bio',
        'Bio',
        'command_staff_bio_callback',
        'staff',
        'normal',
        'high'
    );
    
    // Events meta boxes
    add_meta_box(
        'event_date',
        'Event Date',
        'event_date_callback',
        'events',
        'side',
        'high'
    );
    add_meta_box(
        'event_time_length',
        'Event Time Length (in hours)',
        'event_time_length_callback',
        'events',
        'side',
        'high'
    );
    add_meta_box(
        'event_location',
        'Event Location',
        'event_location_callback',
        'events',
        'normal',
        'high'
    );
    add_meta_box(
        'event_url',
        'Event URL',
        'event_url_callback',
        'events',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_custom_metaboxes');

function command_staff_bio_callback($post) {
    $bio = get_post_meta($post->ID, '_command_staff_bio', true);
    echo '<textarea name="command_staff_bio" rows="5" cols="50">' . esc_attr($bio) . '</textarea>';
}

function event_date_callback($post) {
    $date = get_post_meta($post->ID, '_event_date', true);
    echo '<input type="date" name="event_date" value="' . esc_attr($date) . '" />';
}

function event_time_length_callback($post) {
    $time_length = get_post_meta($post->ID, '_event_time_length', true);
    echo '<input type="number" name="event_time_length" value="' . esc_attr($time_length) . '" step="0.1" min="0" />';
}

function event_location_callback($post) {
    $location = get_post_meta($post->ID, '_event_location', true);
    echo '<input type="text" name="event_location" value="' . esc_attr($location) . '" size="25" />';
}

function event_url_callback($post) {
    $url = get_post_meta($post->ID, '_event_url', true);
    echo '<input type="url" name="event_url" value="' . esc_attr($url) . '" size="50" />';
}

// Save Meta Box Data
function save_custom_metaboxes_data($post_id) {
    if (array_key_exists('command_staff_bio', $_POST)) {
        update_post_meta($post_id, '_command_staff_bio', sanitize_text_field($_POST['command_staff_bio']));
    }
    if (array_key_exists('event_date', $_POST)) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }
    if (array_key_exists('event_time_length', $_POST)) {
        update_post_meta($post_id, '_event_time_length', sanitize_text_field($_POST['event_time_length']));
    }
    if (array_key_exists('event_location', $_POST)) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }
    if (array_key_exists('event_url', $_POST)) {
        update_post_meta($post_id, '_event_url', esc_url_raw($_POST['event_url']));
    }
}
add_action('save_post', 'save_custom_metaboxes_data');

// Customize Admin Menu Icons and Colors
function custom_post_type_icons() {
    ?>
    <style type="text/css">
        /* Command Staff Icon */
        #menu-posts-staff .dashicons-admin-post:before {
            content: '\f110'; /* Dashicons admin-users icon */
            color: red;
        }

        /* Events Icon */
        #menu-posts-events .dashicons-admin-post:before {
            content: '\f073'; /* Dashicons calendar-alt icon */
            color: green;
        }
    </style>
    <?php
}
add_action('admin_head', 'custom_post_type_icons');
