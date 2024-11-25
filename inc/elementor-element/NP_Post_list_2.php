<?php
namespace NPWidgetsElementor\Widgets;
/**
 * Class for custom Elementor Widget.
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Newspulse_Posts_list_2_Widget extends Widget_Base
{

    // Define widget name
    public function get_name()
    {
        return 'newspulse_posts_list_2_widget';
    }

    // Define widget title
    public function get_title()
    {
        return __('Posts List 2', 'newspulse');
    }

    // Define widget icon
    public function get_icon()
    {
        return 'eicon-post-list';
    }

    // Define widget categories
    public function get_categories()
    {
        return ['newspulse_category'];
    }

    // Register widget controls
    protected function _register_controls()
    {

        // Section for content
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Layout', 'newspulse'),
            ]
        );

        // Category select
        $this->add_control(
            'category',
            [
                'label' => __('Select Category', 'newspulse'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_post_categories(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        // Order by select (Date or Title)
        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'newspulse'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => __('Date', 'newspulse'),
                    'title' => __('Title', 'newspulse'),
                ],
                'default' => 'date',
            ]
        );

        // Order select (ASC or DESC)
        $this->add_control(
            'order',
            [
                'label' => __('Order', 'newspulse'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __('Ascending', 'newspulse'),
                    'DESC' => __('Descending', 'newspulse'),
                ],
                'default' => 'DESC',
            ]
        );

        // Number of posts per page
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'newspulse'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 30,
                'default' => 6,
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'post_list_style_section',
            [
                'label' => __('Post List', 'newspulse'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_title_typography',
                'label' => __('Title Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .secOne_title a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_date_typography',
                'label' => __('Date Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_time',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_cat_typography',
                'label' => __('Category Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_mate2 ul li a',
                'separator' => 'after'
            ]
        );

        $this->start_controls_tabs(
            'post_list_style_tabs'
        );

        $this->start_controls_tab(
            'post_list_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'newspulse'),
            ]
        );

        $this->add_control(
            'post_list_title_color',
            [
                'label' => __('Title Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .secOne_title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_date_color',
            [
                'label' => __('Date Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_time' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_cat_color',
            [
                'label' => __('Category Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_mate2 ul li a' => 'color: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_tab();


        $this->start_controls_tab(
            'post_list_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'newspulse'),
            ]
        );

        $this->add_control(
            'post_list_title_hover_color',
            [
                'label' => __('Title Hover Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .secOne_title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_cat_hover_color',
            [
                'label' => __('Category Hover Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_mate2 ul li a:hover' => 'color: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'post_list_image_width',
            [
                'label' => __('Image Width', 'newspulse'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .secOne_image a img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_list_image_height',
            [
                'label' => __('Image Height', 'newspulse'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 88,
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .secOne_image a img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Helper function to get categories
    private function get_post_categories()
    {
        $categories = get_categories([
            'orderby' => 'name',
            'order' => 'ASC',
        ]);

        $category_options = [];

        foreach ($categories as $category) {
            $category_options[$category->term_id] = $category->name;
        }

        return $category_options;
    }

    // Render widget output in the frontend
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['post_list_button_link']['url'])) {
            $this->add_link_attributes('post_list_button_link', $settings['post_list_button_link']);
        }

        // Fetch the current page number
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Query arguments based on user settings
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'paged' => $paged, // Current page number
        ];

        if (!empty($settings['category'])) {
            $args['cat'] = $settings['category'];  // Filter by selected category
        }

        // Execute the query (using the global WP_Query class)
        $query = new \WP_Query($args); // Correct usage of WP_Query



        if ($query->have_posts()) {
            echo '<div class="newspulse-posts-list-2-widget">';
            ?>
            <?php

            while ($query->have_posts()) {
                $query->the_post();

                ?>
                <div class="secOne_wrpp">
                    <div class="secOne_image">

                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>">
                                <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                                    title="<?php the_title(); ?>">
                            <?php else: ?>
                                <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image"
                                    title="No image available">
                            <?php endif; ?>
                        </a>

                        <div class="cat_time">
                            <?php echo newsplus_bangla_en_translate(); ?>
                        </div>
                    </div><!--End secOne Image-->

                    <div class="secOne_content">
                        <div class="cat_mate2">
                            <ul>
                              <li> <?php the_category(' , ') ?></li>
                            </ul>
                        </div>

                        <h2 class="secOne_title">
                            <a href="<?php the_permalink(); ?>"
                                rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                        </h2>
                    </div><!--End secOne content-->

                </div><!--End wrpp-->

                <?php

            }
            ?>
            <?php
            echo '</div>'; // End the posts-widget container
        } else {
            echo '<p>' . __('No posts found.', 'newspulse') . '</p>';
        }



        // Reset the query
        wp_reset_postdata();
    }

}