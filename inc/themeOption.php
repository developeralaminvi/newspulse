<?php
// Check if Redux Framework is installed and active
if (!class_exists('Redux')) {
    return;
}

$opt_name = 'newspulse_options';  // The options name for your theme

$theme = wp_get_theme();  // To fetch the theme details (useful for theme version)

// Set the Redux arguments to configure the theme options panel
$args = array(
    'display_name' => $theme->get('Name'),
    'display_version' => $theme->get('Version'),
    'menu_title' => esc_html__('Theme Settings', 'newspulse'),
    'menu_slug' => 'newspulse_options',  // Unique menu slug for theme options
    'page_title' => esc_html__('NewsPulse Theme Settings', 'newspulse'),
    'customizer' => true,  // Enable live preview in customizer
    'dev_mode' => false,  // Disable dev mode in production
    'update_notice' => true,  // Show update notice
    'icon' => 'el el-cogs',  // Optionally, you can customize the icon
    'opt_name' => $opt_name,
);

Redux::set_args($opt_name, $args);

// Example section
Redux::set_section($opt_name, array(
    'title' => __('Header', 'newspulse'),
    'id' => 'header',
    'desc' => __('Customize your header', 'newspulse'),
    'icon' => 'el el-home',
    'fields' => array(
        array(
            'id' => 'header_logo',
            'type' => 'media',
            'title' => __('Logo', 'newspulse'),
            'desc' => __('Upload your site logo', 'newspulse'),
            'default' => array(
                'url' => get_template_directory_uri() . '/public/frontend/assets/images/WP BIG PRO.png'
            ),
        ),
        array(
            'id' => 'header_content_color',
            'type' => 'color',
            'title' => __('Header Content Color', 'newspulse'),
            'default' => '#6B7280',
            'validate' => 'color',
        ),

        array(
            'id' => 'search_form_placeholder',
            'title' => __('Search Form Placeholder', 'newspulse'),
            'type' => 'text',
            'default' => 'এখানে লিখুন', // Default placeholder text
        ),

        array(
            'id' => 'search_button_text',
            'title' => __('Search Button Text', 'newspulse'),
            'type' => 'text',
            'default' => 'খুজুন', // Default button text
        )

    ),
));

// In your Redux options file
Redux::set_section($opt_name, array(
    'title' => __('Live TV Button', 'newspulse'),
    'subsection' => true,
    'id' => 'live_tv_button_section',
    'icon' => 'el el-tv',
    'fields' => array(
        array(
            'id' => 'live_tv_enable',
            'type' => 'switch',
            'title' => __('Enable Live TV Button', 'newspulse'),
            'default' => true,
            'on' => 'Enabled',
            'off' => 'Disabled',
        ),
        array(
            'id' => 'live_tv_text',
            'type' => 'text',
            'title' => __('Live TV Button Text', 'newspulse'),
            'default' => 'লাইভ',
            'required' => array('live_tv_enable', '=', true),
        ),
        array(
            'id' => 'live_tv_link',
            'type' => 'text',
            'title' => __('Live TV Link', 'newspulse'),
            'default' => '#',
            'required' => array('live_tv_enable', '=', true),
        ),
        array(
            'id' => 'live_tv_icon',
            'type' => 'select',
            'title' => __('Live TV Icon', 'newspulse'),
            'options' => array(
                'las la-tv' => 'TV Icon',
                // Add more icons if needed
            ),
            'default' => 'las la-tv',
            'required' => array('live_tv_enable', '=', true),
        ),
    ),
));



Redux::set_section($opt_name, array(
    'title' => __('Side Menu', 'newspulse'),
    'id' => 'side_menu',
    'desc' => __('Settings for Side Menu colors', 'newspulse'),
    'icon' => 'el el-menu',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'side_menu_color',
            'type' => 'color',
            'title' => __('Menu Color', 'newspulse'),
            'subtitle' => __('Pick a color for the side menu links', 'newspulse'),
            'default' => '#333333', // Default color
            'output' => array('.click-menu ul li a'), // Directly output to selector
        ),
        array(
            'id' => 'side_menu_hover_color',
            'type' => 'color',
            'title' => __('Hover Color', 'newspulse'),
            'subtitle' => __('Pick a hover color for the side menu links', 'newspulse'),
            'default' => '#ff0000', // Default hover color
            'output' => array('#menu-main-menu .click-menu ul li a:hover'), // Directly output to selector on hover
        ),
        array(
            'id' => 'side_menu_active_color',
            'type' => 'color',
            'title' => __('Active Color', 'newspulse'),
            'subtitle' => __('#menu-main-menu Pick a Active color for the side menu links', 'newspulse'),
            'default' => '#ff0000', // Default hover color
        ),
    )
));



Redux::set_section(
    $opt_name,
    array(
        'title' => esc_html__('Typography Settings', 'newspulse'),
        'id' => 'typography',
        'desc' => esc_html__('Customize your theme typography here.', 'newspulse'),
        'icon' => 'el el-font',
        'fields' => array(
            // Primary Typography
            array(
                'id' => 'primary_typography',
                'type' => 'typography',
                'title' => esc_html__('Primary Typography', 'newspulse'),
                'subtitle' => esc_html__('Controls the main typography settings for headings.', 'newspulse'),
                'google' => true,
                'font-backup' => true,
                'output' => array('h1, h2, h3, h4, h5, h6'), // Apply to headings by default
                'units' => 'px',
                'color' => false,
                'default' => array(
                    'font-size' => '24px',
                    'font-family' => 'Hind Siliguri',
                    'font-weight' => '700',
                ),
            ),

            // Secondary Typography
            array(
                'id' => 'secondary_typography',
                'type' => 'typography',
                'title' => esc_html__('Secondary Typography', 'newspulse'),
                'subtitle' => esc_html__('Controls typography settings for body text.', 'newspulse'),
                'google' => true,
                'font-backup' => true,
                'output' => array('body, p, a'), // Apply to body text
                'units' => 'px',
                'color' => false,
                'default' => array(
                    'font-size' => '16px',
                    'font-family' => 'Hind Siliguri',
                    'font-weight' => '400',
                ),
            ),

        ),
    )
);

// Assuming you already have Redux framework setup
Redux::set_section($opt_name, array(
    'title' => __('Color Settings', 'newspulse'),
    'id' => 'color_settings',
    'desc' => __('Manage the color options for the theme.', 'newspulse'),
    'icon' => 'el el-brush',
    'fields' => array(
        array(
            'id' => 'primary_color',
            'type' => 'color',
            'title' => __('Primary Color', 'newspulse'),
            'default' => '#bb1c1c'
        ),
        array(
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => __('Secondary Color', 'newspulse'),
            'default' => '#333333',
        ),
        array(
            'id' => 'link_color',
            'type' => 'color',
            'title' => __('Link Color', 'newspulse'),
            'default' => '#bb1c1c',
            'output' => array('a'),
        ),
        array(
            'id' => 'link_hover_color',
            'type' => 'color',
            'title' => __('Link Hover Color', 'newspulse'),
            'default' => '#dc2626',
            'output' => array('a:hover'),
        ),
        array(
            'id' => 'active_color',
            'type' => 'color',
            'title' => __('Active Color', 'newspulse'),
            'default' => '#dc2626',
        ),
    )
));

Redux::set_section($opt_name, array(
    'title' => __('Background Colors', 'newspulse'),
    'id' => 'background_colors',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'gradient_from_color',
            'type' => 'color',
            'title' => __('Gradient Start Color', 'newspulse'),
            'subtitle' => __('Set the starting color for the gradient.', 'newspulse'),
            'default' => '#811d1d', // Default start color
        ),
        array(
            'id' => 'gradient_to_color',
            'type' => 'color',
            'title' => __('Gradient 2nd Color', 'newspulse'),
            'subtitle' => __('Set the ending color for the gradient.', 'newspulse'),
            'default' => '#da1f1f', // Default end color
        ),

        array(
            'id' => 'gradient_three_color',
            'type' => 'color',
            'title' => __('Gradient End Color', 'newspulse'),
            'subtitle' => __('Set the background color for posts.', 'newspulse'),
            'default' => 'rgb(205, 31, 31)',
        ),

        array(
            'id' => 'gradient_angle',
            'type' => 'text',
            'title' => __('Gradient Angle', 'newspulse'),
            'subtitle' => __('Set the angle for the gradient (e.g., 90deg, 45deg).', 'newspulse'),
            'default' => '90deg',
        ),
    ),
));


Redux::set_section(
    $opt_name,
    array(
        'title' => __('Language Settings', 'newspulse'),
        'id' => 'language-settings',
        'desc' => __('Choose a language for the site content.', 'newspulse'),
        'icon' => 'el el-globe',
        'fields' => array(
            array(
                'id' => 'language_select',
                'type' => 'select',
                'title' => __('Select Language', 'newspulse'),
                'options' => array(
                    'bn' => __('Bangla', 'newspulse'),
                    'en' => __('English', 'newspulse'),
                ),
                'default' => 'bn',
            ),
        )
    )
);

Redux::set_section($opt_name, array(
    'title' => __('Default Image', 'newspulse'),
    'id' => 'default_image_section',
    'icon' => 'el el-smiley',
    'fields' => array(
        array(
            'id' => 'default_image',
            'type' => 'media',
            'title' => __('Default Image', 'newspulse'),
            'subtitle' => __('Upload a default image to display when a post does not have a featured image.', 'newspulse'),
            'default' => array(
                'url' => get_template_directory_uri() . '/public/frontend/assets/images/WP BIG PRO.png' // Initial default image
            ),
        ),
    ),
));




Redux::set_section($opt_name, array(
    'title' => __('Footer Settings', 'newspulse'),
    'id' => 'footer_settings',
    'icon' => 'el el-photo',
    'fields' => array(
        array(
            'id' => 'footer_layout',
            'type' => 'select',
            'title' => __('Select Footer Layout', 'newspulse'),
            'data' => 'posts',
            'args' => array(
                'post_type' => 'footer_element',
                'posts_per_page' => -1,
            ),
            'default' => '',
        ),
    ),
));




Redux::set_section($opt_name, array(
    'title' => __('Single Post', 'newspulse'),
    'id' => 'single_post',
    'desc' => __('Customize typography and text for the single post page.', 'newspulse'),
    'icon' => 'el el-pencil',
    'fields' => array(

        // Title Typography for Single Post
        array(
            'title' => __('Single Post Title Typography', 'newspulse'),
            'id' => 'single_post_title_typo',
            'type' => 'typography',
            'output' => array('.single_page_title'),
            'default' => array(
                'font-size' => '37px',
                'font-family' => 'Hind Siliguri',
                'font-weight' => '700',
                'color' => '#fff'
            ),
            'subsets' => true,
            'google' => true,
        ),

        // Heading Typography for Single Post
        array(
            'title' => __('Single Post Heading Typography', 'newspulse'),
            'id' => 'single_post_heading_typo',
            'type' => 'typography',
            'font-size' => false,
            'output' => array('.single_details h1, .single_details h2, .single_details h3, .single_details h4, .single_details h5, .single_details h6'),
            'default' => array(
                'font-family' => 'Hind Siliguri',
                'font-weight' => '700',
                'color' => '#333333'
            ),
            'subsets' => true,
            'google' => true,
        ),

        // Paragraph Typography for Single Post
        array(
            'title' => __('Single Post Paragraph Typography', 'newspulse'),
            'id' => 'single_post_paragraph_typo',
            'type' => 'typography',
            'output' => array('.single_details p'),
            'default' => array(
                'font-size' => '16px',
                'font-family' => 'Hind Siliguri',
                'font-weight' => '400',
                'color' => '#333333'
            ),
            'subsets' => true,
            'google' => true,
        ),

        // Repotar Roll Text Change Option
        array(
            'title' => __('Repotar Roll', 'newspulse'),
            'id' => 'repotar_roll_text',
            'type' => 'text',
            'default' => 'Repotar Roll',
            'desc' => __('Change the text for "Repotar Roll" in the reporter section.', 'newspulse')
        ),

        // Related News Text Change Option
        array(
            'title' => __('Related News Title', 'newspulse'),
            'id' => 'related_news_text',
            'type' => 'text',
            'default' => ' এ জাতীয় আরো খবর',
            'desc' => __('Change the text for "Related News".', 'newspulse')
        ),

        // Upload News Author Title Text Change Option
        array(
            'title' => __('Upload News Author Title', 'newspulse'),
            'id' => 'upload_news_author_title',
            'type' => 'text',
            'default' => 'নিউজটি আপডেট করেছেন : ',
            'desc' => __('Change the text for "Upload News Author Title".', 'newspulse')
        ),
    ),
));


Redux::set_section($opt_name, array(
    'title'  => __('Voice Button', 'newspulse'),
    'id'     => 'voice_button_settings',
    'desc'   => __('Settings for the voice playback button', 'newspulse'),
    'icon'   => 'el el-bullhorn',
    'fields' => array(
        array(
            'id'       => 'enable_voice_button',
            'type'     => 'switch',
            'title'    => __('Enable Voice Button', 'newspulse'),
            'subtitle' => __('Toggle to show or hide the voice playback button.', 'newspulse'),
            'default'  => true,
            'on'       => __('Enabled', 'newspulse'),
            'off'      => __('Disabled', 'newspulse'),
        ),
        array(
            'id'       => 'voice_button_text',
            'type'     => 'text',
            'title'    => __('Play Button Text', 'newspulse'),
            'subtitle' => __('Customize the text for the play button.', 'newspulse'),
            'default'  => __('Play', 'newspulse'),
        ),
    ),
));


Redux::set_section($opt_name, array(
    'title'  => __('Custom Code', 'newspulse'),
    'id'     => 'custom_code_section',
    'desc'   => __('Add custom CSS and JavaScript for your theme.', 'newspulse'),
    'icon'   => 'el el-css',
    'fields' => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __('Custom CSS', 'newspulse'),
            'subtitle' => __('Add your custom CSS here.', 'newspulse'),
            'mode'     => 'css',
            'theme'    => 'monokai',
            'default'  => '',
        ),
        array(
            'id'       => 'custom_js',
            'type'     => 'ace_editor',
            'title'    => __('Custom JavaScript', 'newspulse'),
            'subtitle' => __('Add your custom JavaScript here. Do not include <script> tags.', 'newspulse'),
            'mode'     => 'javascript',
            'theme'    => 'monokai',
            'default'  => '',
        ),
    ),
));
