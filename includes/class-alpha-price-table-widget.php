<?php

namespace Elementor_Alpha_Price_Table_Addon;

if (!defined('ABSPATH')) {
    exit; // If this file is called directly, abort.
}

/**
 * Alpha Price Table Widget.
 *
 *  */

// Elementor Classes.

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;


/**
 * Class Alpha_Price_Table_Widget
 *
 * @package Elementor
 */
class Alpha_Price_Table_Widget extends Widget_Base
{
    /**
     * Id of the widget.
     *
     * @return string
     */
    public function get_name()
    {
        return 'alpha-price-table';
    }

    /**
     * Widget title.
     *
     * @return string|void
     */
    public function get_title()
    {
        return esc_html__('Alpha Price Table', 'alpha-price-table-for-elementor');
    }

    /**
     * Widget Icon.
     *
     * @return string
     */
    public function get_icon()
    {
        return 'eicon-price-table';
    }

    /**
     * Widget keywords.
     *
     * @return array
     */
    public function get_keywords()
    {
        return array('pricing', 'table', 'product', 'image', 'plan', 'button');
    }

    /**
     * Register widget controls.
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__('Header', 'alpha-price-table-for-elementor'),
            ]
        );

        $this->add_control(
            'check_demo',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(
                    /* translators: 1: Demo link open tag, 2: Link close tag. */
                    esc_html__('Check this widget demo %1$shere%2$s.', 'alpha-price-table-for-elementor'),
                    '<a href="https://ali-ali.org/project/alpha-price-table-for-elementor/" target="_blank">',
                    '</a>'
                ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__('Title', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Enter your title', 'alpha-price-table-for-elementor'),
            ]
        );

        $this->add_control(
            'heading_alignment',
            [
                'label' => esc_html__('Alignment', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'alpha-price-table-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'alpha-price-table-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'alpha-price-table-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => esc_html__('Description', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Enter your description', 'alpha-price-table-for-elementor'),
            ]
        );

        $this->add_control(
            'heading_tag',
            [
                'label' => esc_html__('Heading Tag', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'default' => 'h3',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features',
            [
                'label' => esc_html__('Features', 'alpha-price-table-for-elementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' => esc_html__('Text', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('List Item', 'alpha-price-table-for-elementor'),
            ]
        );

        $default_icon = [
            'value' => 'far fa-check-circle',
            'library' => 'fa-regular',
        ];

        $repeater->add_control(
            'selected_item_icon',
            [
                'label' => esc_html__('Icon', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'item_icon',
                'default' => $default_icon,
            ]
        );

        $repeater->add_control(
            'item_icon_color',
            [
                'label' => esc_html__('Icon Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
                ],
                'default' => '#4BD700',
            ]
        );

        $repeater->add_control(
            'item_icon_position',
            [
                'label' => esc_html__('Icon Position', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__('Before', 'alpha-price-table-for-elementor'),
                    'after' => esc_html__('After', 'alpha-price-table-for-elementor'),
                ],
                'condition' => [
                    'selected_item_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_text' => esc_html__('List Item #1', 'alpha-price-table-for-elementor'),
                        'selected_item_icon' => $default_icon,
                        'item_icon_position' => 'before',
                    ],
                    [
                        'item_text' => esc_html__('List Item #2', 'alpha-price-table-for-elementor'),
                        'selected_item_icon' => $default_icon,
                        'item_icon_position' => 'before',
                    ],
                    [
                        'item_text' => esc_html__('List Item #3', 'alpha-price-table-for-elementor'),
                        'selected_item_icon' => $default_icon,
                        'item_icon_position' => 'before',
                    ],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer',
            [
                'label' => esc_html__('Footer', 'alpha-price-table-for-elementor'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'alpha-price-table-for-elementor'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'alpha-price-table-for-elementor'),
                'default' => [
                    'url' => '#',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_header_style',
            [
                'label' => esc_html__('Header', 'alpha-price-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'header_bg_color',
            [
                'label' => esc_html__('Background Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'background-color: {{VALUE}}',
                ],
                'default' => '#121212',
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => esc_html__('Padding', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_heading_style',
            [
                'label' => esc_html__('Title', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__heading',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'heading_sub_heading_style',
            [
                'label' => esc_html__('Sub Title', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => esc_html__('Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__subheading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__subheading',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features_list_style',
            [
                'label' => esc_html__('Features', 'alpha-price-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'features_list_bg_color',
            [
                'label' => esc_html__('Background Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_padding',
            [
                'label' => esc_html__('Padding', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 25,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'placeholder' => [
                    'top' => 25,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                ],
            ]
        );

        $this->add_control(
            'features_list_color',
            [
                'label' => esc_html__('Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__features-list li',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label' => esc_html__('Width', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 25,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__feature-inner' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer_style',
            [
                'label' => esc_html__('Footer', 'alpha-price-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'footer_bg_color',
            [
                'label' => esc_html__('Background Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'footer_padding',
            [
                'label' => esc_html__('Padding', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_footer_button',
            [
                'label' => esc_html__('Button', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_size',
            [
                'label' => esc_html__('Size', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'xs' => esc_html__('Extra Small', 'alpha-price-table-for-elementor'),
                    'sm' => esc_html__('Small', 'alpha-price-table-for-elementor'),
                    'md' => esc_html__('Medium', 'alpha-price-table-for-elementor'),
                    'lg' => esc_html__('Large', 'alpha-price-table-for-elementor'),
                    'xl' => esc_html__('Extra Large', 'alpha-price-table-for-elementor'),
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'alpha-price-table-for-elementor'),
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'scheme' => Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .elementor-price-table__button',
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__('Background Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
                'default' => '#121212',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .elementor-price-table__button',
                'condition' => [
                    'button_text!' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_text_padding',
            [
                'label' => esc_html__('Text Padding', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'alpha-price-table-for-elementor'),
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Text Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => esc_html__('Background Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => esc_html__('Animation', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'alpha_pricetable',
            [
                'label' => esc_html__('Table', 'alpha-price-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_border',
                'selector' => '{{WRAPPER}} .elementor-price-table',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'pricetable_border_radius',
            [
                'label' => esc_html__('Border Radius', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alpha_pricetable_overflow',
            [
                'label' => esc_html__('Overflow', 'alpha-price-table-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'Hidden',
                'options' => [
                    'hidden' => esc_html__('Hidden', 'alpha-price-table-for-elementor'),
                    'visible' => esc_html__('Visible', 'alpha-price-table-for-elementor'),
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget on the frontend.
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Escape button size
        $button_size = isset($settings['button_size']) ? esc_attr($settings['button_size']) : 'md';

        $this->add_render_attribute('button_text', 'class', [
            'elementor-price-table__button',
            'elementor-button',
            'cta-bt',
            'elementor-size-' . $button_size,
        ]);

        if (! empty($settings['link']['url'])) {
            $this->add_link_attributes('button_text', $settings['link']);
        }

        if (! empty($settings['button_hover_animation'])) {
            $this->add_render_attribute('button_text', 'class', 'elementor-animation-' . esc_attr($settings['button_hover_animation']));
        }

        $this->add_render_attribute('heading', 'class', 'elementor-price-table__heading');
        $this->add_render_attribute('sub_heading', 'class', 'elementor-price-table__subheading');
        $this->add_render_attribute('footer_additional_info', 'class', 'elementor-price-table__additional_info');

        $this->add_inline_editing_attributes('heading', 'none');
        $this->add_inline_editing_attributes('sub_heading', 'none');
        $this->add_inline_editing_attributes('footer_additional_info');
        $this->add_inline_editing_attributes('button_text');

        $migration_allowed = Icons_Manager::is_migration_allowed();
?>

        <div class="elementor-price-table">
            <?php if ($settings['heading'] || $settings['sub_heading']) : ?>
                <div class="elementor-price-table__header">
                    <?php if (! empty($settings['heading'])) : ?>
                        <<?php echo esc_attr($settings['heading_tag']); ?> <?php echo wp_kses_post($this->get_render_attribute_string('heading')); ?>>
                            <?php echo wp_kses_post($settings['heading']); ?>
                        </<?php echo esc_attr($settings['heading_tag']); ?>>
                    <?php endif; ?>

                    <?php if (! empty($settings['sub_heading'])) : ?>
                        <span <?php echo wp_kses_post($this->get_render_attribute_string('sub_heading')); ?>>
                            <?php echo wp_kses_post($settings['sub_heading']); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (! empty($settings['features_list'])) : ?>
                <ul class="elementor-price-table__features-list">
                    <?php
                    foreach ($settings['features_list'] as $index => $item) :
                        $repeater_setting_key = $this->get_repeater_setting_key('item_text', 'features_list', $index);
                        $this->add_inline_editing_attributes($repeater_setting_key);

                        $migrated = isset($item['__fa4_migrated']['selected_item_icon']);
                        // Add old default
                        if (! isset($item['item_icon']) && ! $migration_allowed) {
                            $item['item_icon'] = 'fa fa-check-circle';
                        }
                        $is_new = ! isset($item['item_icon']) && $migration_allowed;

                        // Sanitize the item ID for class attribute
                        $item_id = isset($item['_id']) ? sanitize_html_class($item['_id']) : '';
                    ?>
                        <li class="elementor-repeater-item-<?php echo esc_attr($item_id); ?>">
                            <div class="elementor-price-table__feature-inner">
                                <?php
                                $item_icon_position = $item['item_icon_position'];
                                $location_setting = ! empty($item_icon_position) ? $item_icon_position : 'before';
                                if ((! empty($item['item_icon']) || ! empty($item['selected_item_icon'])) && $location_setting == 'before') :
                                    if ($is_new || $migrated) :
                                        Icons_Manager::render_icon($item['selected_item_icon'], ['aria-hidden' => 'true']);
                                    else : ?>
                                        <i class="<?php echo esc_attr($item['item_icon']); ?>" aria-hidden="true"></i>
                                    <?php
                                    endif;
                                endif;
                                if (! empty($item['item_text'])) : ?>
                                    <span <?php echo wp_kses_post($this->get_render_attribute_string($repeater_setting_key)); ?>>
                                        <?php echo esc_html($item['item_text']); ?>
                                    </span>
                                    <?php
                                else :
                                    echo '&nbsp;';
                                endif;
                                if ((! empty($item['item_icon']) || ! empty($item['selected_item_icon'])) && $location_setting == 'after') :
                                    if ($is_new || $migrated) :
                                        Icons_Manager::render_icon($item['selected_item_icon'], ['aria-hidden' => 'true']);
                                    else : ?>
                                        <i class="<?php echo esc_attr($item['item_icon']); ?>" aria-hidden="true"></i>
                                <?php
                                    endif;
                                endif;
                                ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (! empty($settings['button_text']) || ! empty($settings['footer_additional_info'])) : ?>
                <div class="elementor-price-table__footer">
                    <?php if (! empty($settings['button_text'])) : ?>
                        <a <?php echo wp_kses_post($this->get_render_attribute_string('button_text')); ?>>
                            <?php echo esc_html($settings['button_text']); ?>
                        </a>
                    <?php endif; ?>

                    <?php if (! empty($settings['footer_additional_info'])) : ?>
                        <div <?php echo wp_kses_post($this->get_render_attribute_string('footer_additional_info')); ?>>
                            <?php echo wp_kses_post($settings['footer_additional_info']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

<?php
    }
}
