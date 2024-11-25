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

class Newspulse_Posts_list_3_Widget extends Widget_Base
{

    // Define widget name
    public function get_name()
    {
        return 'newspulse_posts_list_3_widget';
    }

    // Define widget title
    public function get_title()
    {
        return __('Posts List 3', 'newspulse');
    }

    // Define widget icon
    public function get_icon()
    {
        return 'eicon-posts-group';
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
                'default' => 8,
            ]
        );

        $this->add_control(
            'post_list_button',
            [
                'label' => esc_html__('Button Title', 'newspulse'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('আরো খবর', 'newspulse'),
                'placeholder' => esc_html__('Type your Section Title here', 'newspulse'),
            ]
        );

        $this->add_control(
            'post_list_button_link',
            [
                'label' => esc_html__('Button Link', 'newspulse'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'hiro_post_style_section',
            [
                'label' => __('Grid Post', 'newspulse'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Styling

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hiro_post_title_typography',
                'label' => __('Title Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .secTwo_title a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hiro_post_date_typography',
                'label' => __('Date Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_time3',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hiro_post_content_typography',
                'label' => __('Content Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .content_details',
                'separator' => 'after'
            ]
        );

        $this->start_controls_tabs(
            'hiro_post_style_tabs'
        );

        $this->start_controls_tab(
            'hiro_post_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'newspulse'),
            ]
        );

        $this->add_control(
            'hiro_post_title_color',
            [
                'label' => __('Title Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .secTwo_title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hiro_post_date_color',
            [
                'label' => __('Date Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_time3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hiro_post_content_color',
            [
                'label' => __('Content Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .content_details' => 'color: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hiro_post_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'newspulse'),
            ]
        );

        $this->add_control(
            'hiro_post_title_hover_color',
            [
                'label' => __('Title Hover Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .secTwo_title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'hiro_post_image_width',
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
                    '{{WRAPPER}} .secTwo_image a img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hiro_post_image_height',
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
                    'size' => 210,
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .secTwo_image a img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );

        $this->end_controls_section();

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
                'selector' => '{{WRAPPER}} .secTwo_title2 a, {{WRAPPER}} .latest_title a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_cat_typography',
                'label' => __('Category Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_mate3 ul li a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_date_typography',
                'label' => __('Date Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_time4, {{WRAPPER}} .cat_time2',
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
                    '{{WRAPPER}} .secTwo_title2 a,{{WRAPPER}} .latest_title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_date_color',
            [
                'label' => __('Date Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_time4, {{WRAPPER}} .cat_time2' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'post_list_cat_color',
            [
                'label' => __('Category Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_mate3 ul li a' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .secTwo_title2 a:hover,{{WRAPPER}} .latest_title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'post_list_cat_hover_color',
            [
                'label' => __('Category Hover Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_mate3 ul li a:hover' => 'color: {{VALUE}};',
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
                    'default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .secTwo_image2 img,{{WRAPPER}} .latest_image img' => 'width: {{SIZE}}{{UNIT}};',
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
                    'size' => 111,
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .secTwo_image2 img,{{WRAPPER}} .latest_image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],

                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_content_button_typography',
                'label' => __('Button Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .lates_more a',
            ]
        );

        $this->add_control(
            'post_list_content_button_color',
            [
                'label' => __('Button Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lates_more a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_content_button_hover_color',
            [
                'label' => __('Button Hover Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lates_more a:hover' => 'color: {{VALUE}};',
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
            echo '<div class="newspulse-posts-widget row">';

            // Left Side (1st part + 2nd part)
            echo '<div class="col-lg-6 col-md-6">';

            $np_post_count = 0;

            // First Part: Display the first post
            while ($query->have_posts()) {
                $query->the_post();
                $np_post_count++;

                if ($np_post_count === 1) {
                    ?>
                    <div class="secTwo_wrpp">
                        <div class="secTwo_image">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                                        title="<?php the_title(); ?>">
                                </a>
                            <?php else: ?>
                                <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image"
                                    title="No image available">
                            <?php endif; ?>
                        </div><!--End secTwo Image-->
                        <div class="secTwo_content">
                            <div class="cat_time3">
                                <?php echo newsplus_bangla_en_translate(); ?>
                            </div>
                            <h3 class="secTwo_title">
                                <a href="<?php the_permalink(); ?>"
                                    rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                            </h3>
                            <div class="content_details">
                                <?php echo wp_trim_words(get_the_content(), 10, '...'); ?>
                            </div>
                        </div><!--End secTwo_content-->
                    </div>
                    <?php
                }
            }

            // Second Part: Display the next two posts
            $query->rewind_posts();
            $np_post_count = 0;

            while ($query->have_posts()) {
                $query->the_post();
                $np_post_count++;

                if ($np_post_count > 1 && $np_post_count <= 3) {
                    ?>
                    <div class="secTwo_wrpp2">
                        <div class="secTwo_image2">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                                        title="<?php the_title(); ?>">
                                </a>
                            <?php else: ?>
                                <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image"
                                    title="No image available">
                            <?php endif; ?>

                            <div class="cat_time4">
                                <?php echo newsplus_bangla_en_translate(); ?>
                            </div>
                        </div><!--End secOne Image-->

                        <div class="secTwo_content2">
                            <div class="cat_mate3">
                                <ul>
                                    <li> <?php the_category(' , ') ?></li>
                                </ul>
                            </div>

                            <h2 class="secTwo_title2">
                                <a href="<?php the_permalink(); ?>"
                                    rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                            </h2>
                        </div><!--End secOne content-->
                    </div>

                    <?php
                }
            }

            echo '</div>'; // End left column

            // Right Side (3rd part)
            echo '<div class="col-lg-6 col-md-6">';
            echo '<div class="latest_wrpp">';

            $query->rewind_posts();
            $np_post_count = 0;

            if (!empty($settings['post_list_button_link']['url'])) {
                $this->add_link_attributes('post_list_button_link', $settings['post_list_button_link']);
            }

            while ($query->have_posts()) {
                $query->the_post();
                $np_post_count++;

                if ($np_post_count > 3) {
                    ?>

                    <div class="latest_item">
                        <div class="latest_image">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                                        title="<?php the_title(); ?>">
                                </a>
                            <?php else: ?>
                                <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image"
                                    title="No image available">
                            <?php endif; ?>
                        </div><!--End secOne Image-->

                        <div class="latest_content">
                            <h2 class="latest_title">
                                <a href="<?php the_permalink(); ?>"
                                    rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                            </h2>

                            <div class="cat_time2">
                                <?php echo newsplus_bangla_en_translate(); ?>
                            </div>
                        </div><!--End secOne content-->
                    </div>
                    <?php
                }
            }
            ?>
            <h4 class="lates_more">
               <a <?php $this->print_render_attribute_string('post_list_button_link'); ?>>
                <?php echo $settings['post_list_button']; ?></a>
            </h4>
            <?php

            echo '</div>'; // latest_wrpp column
            echo '</div>'; // End right column
            echo '</div>'; // End posts-widget container
        } else {
            echo '<p>' . __('No posts found.', 'newspulse') . '</p>';
        }




        // Reset the query
        wp_reset_postdata();
    }

}