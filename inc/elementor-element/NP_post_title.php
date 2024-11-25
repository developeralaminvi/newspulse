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

class Newspulse_Post_Title_Widget extends Widget_Base
{

    // Define widget name
    public function get_name()
    {
        return 'newspulse_post_title_widget';
    }

    // Define widget title
    public function get_title()
    {
        return __('Posts Title', 'newspulse');
    }

    // Define widget icon
    public function get_icon()
    {
        return 'eicon-t-letter';
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
            'np_post_title_section_content',
            [
                'label' => __('Content', 'newspulse'),
            ]
        );

        $this->add_control(
            'np_post_title',
            [
                'label' => esc_html__('Title', 'newspulse'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('জাতীয়', 'newspulse'),
                'placeholder' => esc_html__('Type your Title here', 'newspulse'),
            ]
        );

        $this->add_control(
            'np_post_title_button',
            [
                'label' => esc_html__('Title Button', 'newspulse'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('আরো খবর <i class="las la-arrow-right"></i>', 'newspulse'),
                'placeholder' => esc_html__('type your button text here', 'newspulse'),
            ]
        );

        $this->add_control(
            'np_post_title_button_link',
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
            'np_post_title_style_section',
            [
                'label' => __('Style', 'newspulse'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'np_post_title_typography',
                'label' => __('Title Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_title span',
            ]
        );

        $this->add_control(
            'np_post_title_color',
            [
                'label' => __('Title Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_title span' => 'color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'np_post_title_buttom_typography',
                'label' => __('Buttom Typography', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_title span2 a',
            ]
        );


        $this->add_control(
            'np_post_buttom_color',
            [
                'label' => __('Buttom Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_title span2 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'np_post_buttom_hover_color',
            [
                'label' => __('Buttom Hover Color', 'newspulse'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_title span2 a:hover' => 'color: {{VALUE}};',
                ],
                'separator'=>'after',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'newspulse'),
                'selector' => '{{WRAPPER}} .cat_title',
                'default' => [
                    'border' => 'solid',
                    'width' => [
                        'top' => 1,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                    ],
                    'color' => '#dbd5d5',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['np_post_title_button_link']['url'])) {
            $this->add_link_attributes('np_post_title_button_link', $settings['np_post_title_button_link']);
        }
        ?>

        <h2 class="cat_title">
            <span> <?php echo $settings['np_post_title']; ?> </span>
            <span2> <a <?php $this->print_render_attribute_string('np_post_title_button_link'); ?> > <?php echo $settings['np_post_title_button']; ?> </a> </span2>
        </h2>

        <?php

    }

}