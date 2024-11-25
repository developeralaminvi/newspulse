<?php
namespace NPWidgetsElementor\Widgets;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Newspulse_Posts_list_4_Widget extends Widget_Base
{

    // Define widget name
    public function get_name()
    {
        return 'newspulse_posts_list_4_widget';
    }

    // Define widget title
    public function get_title()
    {
        return __('Posts List 4', 'newspulse');
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
                'label' => __('Content', 'newspulse'),
            ]
        );

        // Title for the "Latest News" section
        $this->add_control(
            'post_list_1_title',
            [
                'label' => esc_html__('Title 1 (Latest News)', 'newspulse'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('সর্বশেষ সংবাদ', 'newspulse'),
                'placeholder' => esc_html__('Type your title here', 'newspulse'),
            ]
        );

        // Title for the "Most Commented News" section
        $this->add_control(
            'post_list_2_title',
            [
                'label' => esc_html__('Title 2 (Most Commented)', 'newspulse'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('আলোচিত সংবাদ', 'newspulse'),
                'placeholder' => esc_html__('Type your title here', 'newspulse'),
            ]
        );

        // Max Height control for Archive News
        $this->add_control(
            'max_height',
            [
                'label' => __('Content Height', 'newspulse'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .archiveTab-sibearNews' => 'max-height: {{SIZE}}{{UNIT}}; overflow: hidden; overflow: scroll;',
                ],
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
                'name' => 'post_list_title_typography',
                'label' => __('Title Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .archiveTab_hadding a',
            ]
        );

        $this->add_control(
            'hiro_post_title_color',
            [
                'label' => __('Title Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .archiveTab_hadding a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_list_title_hover_color',
            [
                'label' => __('Title Hover Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .archiveTab_hadding a:hover' => 'color: {{VALUE}};',
                ],
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
                ],

                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],

                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .archiveTab-image a img' => 'width: {{SIZE}}{{UNIT}};',
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
                    'size' => 75,
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .archiveTab-image a img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Render the widget output on the front end
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Fetch the current page number
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Query arguments for the latest posts
        $latest_news_args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $paged, // Current page number
        );
        $latest_news_query = new \WP_Query($latest_news_args);

        // Query arguments for the most commented posts
        $most_commented_args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'orderby' => 'comment_count',
            'order' => 'DESC',
        );
        $most_commented_query = new \WP_Query($most_commented_args);

        // Check if there are posts available for Latest News
        if ($latest_news_query->have_posts()): ?>
            <div class="">
                <div class="sitebar-fixd" style="position: sticky; top: 0;">
                    <div class="archivePopular">
                        <ul class="nav nav-pills" id="archivePopular-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <div class="nav-link active" data-bs-toggle="pill" data-bs-target="#archiveTab_recent" role="tab"
                                    aria-controls="archiveRecent" aria-selected="true">
                                    <?php echo esc_html($settings['post_list_1_title']); ?>
                                </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <div class="nav-link" data-bs-toggle="pill" data-bs-target="#archiveTab_popular" role="tab"
                                    aria-controls="archivePopulars" aria-selected="false">
                                    <?php echo esc_html($settings['post_list_2_title']); ?>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContentarchive">
                        <!-- Latest News Tab Content -->
                        <div class="tab-pane active show fade" id="archiveTab_recent" role="tabpanel"
                            aria-labelledby="archiveRecent">
                            <div class="archiveTab-sibearNews">
                                <?php
                                $count = 1;
                                while ($latest_news_query->have_posts()):
                                    $latest_news_query->the_post(); ?>
                                    <div class="archive-tabWrpp archiveTab-border">
                                        <div class="archiveTab-image">
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
                                        <h4 class="archiveTab_hadding">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                                        </h4>
                                        <div class="archive-conut">
                                            <?php
                                            $selected_language = get_option('newspulse_options')['language_select'] ?? 'bn';
                                            if ($selected_language == 'bn') {
                                                echo convert_to_bangla($count);
                                            } else {
                                                echo $count;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php $count++; endwhile; ?>
                            </div>
                        </div>

                        <!-- Most Commented News Tab Content -->
                        <?php if ($most_commented_query->have_posts()): ?>
                            <div class="tab-pane fade" id="archiveTab_popular" role="tabpanel" aria-labelledby="archivePopulars">
                                <div class="archiveTab-sibearNews">
                                    <?php
                                    $count = 1;
                                    while ($most_commented_query->have_posts()):
                                        $most_commented_query->the_post(); ?>
                                        <div class="archive-tabWrpp archiveTab-border">
                                            <div class="archiveTab-image">
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
                                            <h4 class="archiveTab_hadding">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                                            </h4>
                                            <div class="archive-conut">
                                                <?php
                                                $selected_language = get_option('newspulse_options')['language_select'] ?? 'bn';
                                                if ($selected_language == 'bn') {
                                                    echo convert_to_bangla($count);
                                                } else {
                                                    echo $count;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php $count++; endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        // Reset post data
        wp_reset_postdata();
    }
}
