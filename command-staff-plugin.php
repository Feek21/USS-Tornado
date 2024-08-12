<?php
/*
Plugin Name: USS Tornado
Description: A plugin to create a custom post type for Command Staff with Name, Bio, and Feature Image fields.
Version: 1.0
Author: Feek
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register the custom post type
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
		'menu_icon'				=< 'groups',
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('staff', $args);
}
add_action('init', 'create_command_staff_cpt', 0);

// Add the custom meta box for Bio
function add_command_staff_metaboxes() {
    add_meta_box(
        'command_staff_bio',
        'Bio',
        'command_staff_bio_callback',
        'staff',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_command_staff_metaboxes');

function command_staff_bio_callback($post) {
    // Retrieve current value of the meta key
    $bio = get_post_meta($post->ID, '_command_staff_bio', true);
    ?>
    <textarea style="width:100%; height: 150px;" id="command_staff_bio" name="command_staff_bio"><?php echo esc_textarea($bio); ?></textarea>
    <?php
}

// Save the Bio Meta Box data
function save_command_staff_meta($post_id) {
    // Save the bio field
    if (isset($_POST['command_staff_bio'])) {
        update_post_meta($post_id, '_command_staff_bio', sanitize_textarea_field($_POST['command_staff_bio']));
    }
}
add_action('save_post', 'save_command_staff_meta');



/* EVENTS POST Type */

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
		'menu_icon'				=< 'caldendar-alt',
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
    );
    
    register_post_type('events', $args);
}
add_action('init', 'create_events_cpt', 0);



// Customize Admin Menu Icons and Colors
function custom_post_type_icons() {
    ?>
    <style type="text/css">
        /* Command Staff Icon */
        #menu-posts-staff .dashicons-admin-post:before {
            content: '\f110'; /* Dashicons admin-users icon */
            color: green;
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
