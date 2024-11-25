<?php

// Register Custom Post Type for Footer
function newspulse_footer_elements_post_type()
{
    $args = array(
        'label' => __('Footer Elements', 'newspulse'),
        'public' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true, // For Gutenberg & Elementor compatibility
        'menu_icon' => 'dashicons-editor-insertmore',
        'supports' => array('title', 'editor', 'thumbnail', 'elementor'), // Add Elementor support
        'has_archive' => false,
    );
    register_post_type('footer_element', $args);
}
add_action('init', 'newspulse_footer_elements_post_type');


