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

class Newspulse_Posts_Grid_2_Widget extends Widget_Base
{

    // Define widget name
    public function get_name()
    {
        return 'newspulse_posts_drid_2_widget';
    }

    // Define widget title
    public function get_title()
    {
        return __('Posts Grid 2', 'newspulse');
    }

    // Define widget icon
    public function get_icon()
    {
        return 'eicon-table';
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

        // Number of columns option
        $this->add_control(
            'columns',
            [
                'label' => __('Number of Columns', 'newspulse'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __('1 Columns', 'newspulse'),
                    '2' => __('2 Columns', 'newspulse'),
                    '3' => __('3 Columns', 'newspulse'),
                    '4' => __('4 Columns', 'newspulse'),
                ],
                'default' => '4',
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
                'separator' => 'after'
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
                    '{{WRAPPER}} .secTwo_title a:hover ' => 'color: {{VALUE}};',
                ],

                'separator' => 'after'
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
                    'default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
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
                    'size' => 200,
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
                'selector' => '{{WRAPPER}} .secTwo_title2 a',
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
                'selector' => '{{WRAPPER}} .cat_time4',
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
                    '{{WRAPPER}} .secTwo_title2 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_date_color',
            [
                'label' => __('Date Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_time4' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .secTwo_title2 a:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .secTwo_image2 a img' => 'width: {{SIZE}}{{UNIT}};',
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
                    'size' => 100,
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .secTwo_image2 a img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
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
        $columns = !empty($settings['columns']) ? $settings['columns'] : 4; // Default to 4 columns

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
            echo '<div class="newspulse-posts-grid-list-widget">';

            $np_post_count = 0; // Track the post count

            // Start the first row for the grid layout
            echo '<div class="row grid-layout">';
            while ($query->have_posts()) {
                $query->the_post();
                $np_post_count++;
                // Dynamically apply column classes
                $col_class = 'col-lg-' . (12 / $columns) . ' col-md-6';

                // Display the first 4 posts in the grid layout
                if ($np_post_count <= $columns) {
                    ?>
                    <div class="<?php echo esc_attr($col_class); ?>">
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

                        </div><!--End wrpp-->
                    </div>
                    <?php
                }

             
            }
            echo '</div>'; // End grid-layout row
            // Start the list layout for remaining posts
            if ($np_post_count > $columns) {
                echo '<div class="row">';
                $query->rewind_posts(); // Reset post data for the remaining loop
                $np_post_count = 0; // Reset post count

                while ($query->have_posts()) {
                    $query->the_post();
                    $np_post_count++;

                    // Skip the first 4 posts (already displayed)
                    if ($np_post_count > $columns) {
                        ?>
                        <div class="<?php echo esc_attr($col_class); ?>">
                            <div class="secTwo_wrpp2">
                                <div class="secTwo_image2">
                                    <?php if (has_post_thumbnail()): ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                                                title="<?php the_title(); ?>">
                                        </a>
                                    <?php else: ?>
                                        <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image" title="No image available">
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
                                       <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                                    </h2>
                                </div><!--End secOne content-->
                            </div><!--End wrpp-->

                        </div>
                        <?php
                    }
                }
                echo '</div>'; // End list-layout
            }

            echo '</div>'; // End newspulse-posts-grid-list-widget
        } else {
            echo '<p>' . __('No posts found.', 'newspulse') . '</p>';
        }






        // Reset the query
        wp_reset_postdata();
    }

}