<?php
namespace NPWidgetsElementor\Widgets;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Newspulse_Latest_post_Widget extends Widget_Base
{

    // Define widget name
    public function get_name()
    {
        return 'newspulse_posts_grid_2_widget';
    }

    // Define widget title
    public function get_title()
    {
        return __('Latest Post', 'newspulse');
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

        $this->start_controls_section(
            'post_list_style_section',
            [
                'label' => __('Post List', 'newspulse'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

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
                    '{{WRAPPER}} .related_image a img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .related_image a img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],

                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_title_typography',
                'label' => __('Title Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .related_title a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_date_typography',
                'label' => __('Date Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_time3',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_date_typography',
                'label' => __('Date Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_time3',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_list_content_typography',
                'label' => __('Content Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .post-excerpt',
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'post_list_title_color',
            [
                'label' => __('Title Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .related_title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_title_hover_color',
            [
                'label' => __('Title Hover Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .related_title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_content_color',
            [
                'label' => __('Content Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_date_color',
            [
                'label' => __('Date Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_time3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Render the widget output on the front end
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $posts_per_page = $settings['posts_per_page'];

        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="related_news">
                    <div class="row">
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = [
                            'posts_per_page' => $posts_per_page,
                            'paged' => $paged,
                        ];
                        $query = new \WP_Query($args);

                        if ($query->have_posts()):
                            while ($query->have_posts()):
                                $query->the_post();
                                ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="related_wrpp">
                                        <div class="related_image">
                                            <?php if (has_post_thumbnail()): ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <img class="lazyload" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                                        alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                                                </a>
                                            <?php else: ?>
                                                <img class="lazyload" src="<?php echo blog_default_image('thumbnail'); ?>" alt="No image"
                                                    title="No image available">
                                            <?php endif; ?>
                                        </div>
                                        <div class="related_content">
                                            <div class="cat_time3">
                                                <?php echo newsplus_bangla_en_translate(); ?>
                                            </div>
                                            <h3 class="related_title">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php echo wp_trim_words(get_the_title(), 5, '...'); ?>
                                                </a>
                                            </h3>
                                            <div class="post-excerpt">
                                                <?php echo wp_trim_words(get_the_content(), 10, '...'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                        else:
                            echo '<p>' . __('No posts found.', 'newspulse') . '</p>';
                        endif;

                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
