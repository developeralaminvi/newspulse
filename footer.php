<!--=========WPBigPro================
     Footer-Area-Start
=============WPBigPro=============-->

<footer class="footer_area">

    <?php
    $footer_layout_id = get_option('newspulse_options')['footer_layout'] ?? null;

    if ($footer_layout_id) {
        $footer_query = new WP_Query(array(
            'post_type' => 'footer_element',
            'p' => $footer_layout_id,
        ));

        if ($footer_query->have_posts()) {
            while ($footer_query->have_posts()) {
                $footer_query->the_post();
                the_content(); // Display the content of the footer element
    
                // If using Elementor, load the Elementor template
                if (did_action('elementor/loaded')) {
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($footer_layout_id);
                }
            }
            wp_reset_postdata();
        }
    } else {
        echo __('No footer layout selected.', 'newspulse');

        // Show the button to create a footer layout only if the user is an admin
        if (current_user_can('administrator')) {
            echo '<div class="create-footer-button">';
            echo '<a href="' . esc_url(admin_url('post-new.php?post_type=footer_element')) . '" class="button button-primary">';
            echo __('Create Footer Layout', 'newspulse');
            echo '</a>';
            echo '</div>';
        }
    }
    ?>



</footer><!--End Footer-->


<!--=========WPBigPro================
         Footer-Area-End
=============WPBigPro=============-->




<?php wp_footer() ?>

</body>

</html>