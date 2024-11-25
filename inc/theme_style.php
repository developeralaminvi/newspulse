<?php

// Enqueue theme styles and scripts

if (!function_exists('newspulse_enqueue_styles')) {
    function newspulse_enqueue_styles()
    {
        // Get the version number of the stylesheet from the theme header
        $theme_version = wp_get_theme()->get('Version');

        // Get the URI Theme File
        $thenefilelocation = get_template_directory_uri();

        // Bootstrap
        wp_enqueue_style('newspulse-bootstrap', $thenefilelocation . '/public/frontend/assets/css/bootstrap.min.css', array(), $theme_version, 'all');

        // line-awesome-icon
        wp_enqueue_style('line-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css', array(), '1.3.0');

        // stellarnav
        wp_enqueue_style('newspulse-stellarnav', $thenefilelocation . '/public/frontend/assets/css/stellarnav.css', array(), $theme_version, 'all');

        // jquery-ui
        wp_enqueue_style('newspulse-jquery-ui', $thenefilelocation . '/public/frontend/assets/css/jquery-ui.css', array(), $theme_version, 'all');

        // magnific-popup
        wp_enqueue_style('newspulse-magnific-popup', $thenefilelocation . '/public/frontend/assets/css/magnific-popup.css', array(), $theme_version, 'all');

        // owl.carousel
        wp_enqueue_style('newspulse-owl.carousel', $thenefilelocation . '/public/frontend/assets/css/owl.carousel.min.css', array(), $theme_version, 'all');

        // responsive
        wp_enqueue_style('newspulse-responsive', $thenefilelocation . '/public/frontend/assets/css/responsive.css', array(), $theme_version, 'all');

        // mytheme-all-css
        wp_enqueue_style('newspulse-all', $thenefilelocation . '/public/frontend/assets/css/all.css', array(), $theme_version, 'all');

        // mytheme-all-css
        wp_enqueue_style('newspulse-all', $thenefilelocation . '/public/frontend/assets/css/all.css', array(), $theme_version, 'all');

        // mytheme-style-css
        wp_enqueue_style('newspulse-style', $thenefilelocation . '/public/frontend/style.css', array(), $theme_version, 'all');


        ////////////////////
        //    script     //
        ///////////////////

        // jquery
        wp_enqueue_script('jquery');

        //bootstrap.min.js
        wp_enqueue_script('newspulse-bootstrap.min', $thenefilelocation . '/public/frontend/assets/js/bootstrap.min.js', array(), $theme_version, 'all');

        //bootstrap.bundle.min.js
        wp_enqueue_script('newspulse-bootstrap.bundle.min', $thenefilelocation . '/public/frontend/assets/js/bootstrap.bundle.min.js', array(), $theme_version, 'all');

        //stellarnav.min.js
        wp_enqueue_script('newspulse-stellarnav.min', $thenefilelocation . '/public/frontend/assets/js/stellarnav.min.js', array(), $theme_version, 'all');

        //owl.carousel.min
        wp_enqueue_script('newspulse-owl.carousel.min', $thenefilelocation . '/public/frontend/assets/js/owl.carousel.min.js', array(), $theme_version, 'all');

        //jquery.magnific-popup.min
        wp_enqueue_script('newspulse-jquery.magnific-popup.min', $thenefilelocation . '/public/frontend/assets/js/jquery.magnific-popup.min.js', array(), $theme_version, 'all');

        //jquery-ui.js
        wp_enqueue_script('newspulse-jquery-ui', $thenefilelocation . '/public/frontend/assets/js/jquery-ui.js', array(), $theme_version, 'all');

        //lazyload.min.js
        wp_enqueue_script('newspulse-lazyload.min', $thenefilelocation . '/public/frontend/assets/js/lazyload.min.js', array(), $theme_version, 'all');

        //main.js
        wp_enqueue_script('newspulse-main', $thenefilelocation . '/public/frontend/assets/js/main.js', array(), $theme_version, 'all');
        


    }
}
add_action('wp_enqueue_scripts', 'newspulse_enqueue_styles');


function theme_enqueue_comment_scripts() {
    if (is_single() && comments_open()) {
        wp_enqueue_script('ajax-comment-script', get_template_directory_uri() . '/public/frontend/assets/js/ajax-comments.js', array('jquery'), null, true);
        
        // Localize script for AJAX URL and nonce
        wp_localize_script('ajax-comment-script', 'ajaxComments', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-comment-nonce'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_comment_scripts');



function newspulse_enqueue_custom_code() {
    // Get Redux options
    $options = get_option('newspulse_options');
    
    // Custom CSS
    if (!empty($options['custom_css'])) {
        wp_add_inline_style('newspulse-style', $options['custom_css']);
    }
    
    // Custom JavaScript
    if (!empty($options['custom_js'])) {
        wp_add_inline_script('newspulse-script', $options['custom_js']);
    }
}
add_action('wp_enqueue_scripts', 'newspulse_enqueue_custom_code');


function validate_custom_js($code) {
    return @json_decode(json_encode($code)) !== null; // Basic validation
}

function newspulse_safe_enqueue_custom_js() {
    $options = get_option('newspulse_options');
    if (!empty($options['custom_js']) && validate_custom_js($options['custom_js'])) {
        wp_add_inline_script('newspulse-script', $options['custom_js']);
    }
}
add_action('wp_enqueue_scripts', 'newspulse_safe_enqueue_custom_js');
