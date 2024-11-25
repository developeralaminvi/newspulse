<?php

function newspulse_custom_styles()
{
    global $newspulse_options;
    $header_content_color = get_option('newspulse_options')['header_content_color'];  // Retrieve the color from Redux options
    $header_content_color = !empty($header_content_color) ? $header_content_color : '#6B7280';  // Fallback to default if empty
    $primary_typography = $newspulse_options['primary_typography'];
    $secondary_typography = $newspulse_options['secondary_typography'];
    $primary_color = get_option('newspulse_options')['primary_color'] ?? '#bb1c1c';
    $active_color = get_option('newspulse_options')['active_color'] ?? '#dc2626';
    $side_menu_active_color = get_option('newspulse_options')['side_menu_active_color'] ?? '#dc2626';
    $link_hover_color = get_option('newspulse_options')['link_hover_color'] ?? '#dc2626';
    $gradient_from_color = get_option('newspulse_options')['gradient_from_color'] ?? '#811d1d';
    $gradient_to_color = get_option('newspulse_options')['gradient_to_color'] ?? '#da1f1f';
    $gradient_angle = get_option('newspulse_options')['gradient_angle'] ?? '90deg';
    $gradient_three_color = get_option('newspulse_options')['gradient_three_color'] ?? 'rgb(205, 31, 31)';


    ?>
    <style type="text/css">
        .date {
            color:
                <?php echo esc_attr($header_content_color); ?>
            ;
        }
        .header_click ul li {
            color:
                <?php echo esc_attr($header_content_color); ?>
            ;
        }

        /* Primary Typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: <?php echo esc_attr($primary_typography['font-family']); ?>;
            font-size: <?php echo esc_attr($primary_typography['font-size']); ?>;
            font-weight: <?php echo esc_attr($primary_typography['font-weight']); ?>;
        }
        
        /* Secondary Typography */
        body, p{
            font-family: <?php echo esc_attr($secondary_typography['font-family']); ?>;
            font-size: <?php echo esc_attr($secondary_typography['font-size']); ?>;
            font-weight: <?php echo esc_attr($secondary_typography['font-weight']); ?>;
        }
        
        .menu-section,.stellarnav.dark ul ul,.searchBar button,.remove, #playContent{
            background-color: <?php echo esc_attr($primary_color); ?>;
        }

        .searchBar input[type="text"],.remove,.rachive-info-cats, .close-icons i,.related_cat{
             border-color: <?php echo esc_attr($primary_color); ?>;
        }
        
        .single_details ul li::before{
             color: <?php echo esc_attr($primary_color); ?>;
        }

        .stellarnav.dark .current-menu-item, .page-item.active .page-link,.header_click ul li a {
             background-color: <?php echo esc_attr($active_color); ?>;
        }
        .page-item.active .page-link {
             border-color: <?php echo esc_attr($active_color); ?>;
        }

        #menu-main-menu .current_page_item a {
             color: <?php echo esc_attr($side_menu_active_color);?> !important;
        }

       #playContent:hover  {
             background-color: <?php echo esc_attr($link_hover_color); ?>;
        }

        .gredent_bg {
        background: linear-gradient(
            <?php echo esc_attr($gradient_angle); ?>,
            <?php echo esc_attr($gradient_from_color); ?>,
            <?php echo esc_attr($gradient_to_color); ?>
        
         )
        }

        .single_Page_image::before{
            background: linear-gradient(to right, rgba(0, 0, 0, 0) 0, <?php echo esc_attr($gradient_three_color); ?> 30%, rgb(208 31 31 / 8%) 100%);
        }


    </style>
    <?php
}
add_action('wp_head', 'newspulse_custom_styles');
