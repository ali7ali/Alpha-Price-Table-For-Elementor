<?php
/**
 * Alpha Price Table Widget.
 *
 * @package    AlphaPriceTable
 *  */

namespace Elementor_Alpha_Price_Table_Addon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access.
}

// Elementor Classes.
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;


/**
 * Class Alpha_Price_Table_Widget
 *
 * Defines the Alpha Price Table widget for Elementor.
 */
class Alpha_Price_Table_Widget extends Widget_Base {

	/**
	 * Retrieve widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'alpha-price-table';
	}

	/**
	 * Retrieve widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Alpha Price Table', 'alpha-price-table-for-elementor' );
	}

	/**
	 * Retrieve widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Retrieve widget keywords.
	 *
	 * @return array
	 */
	public function get_keywords() {
		return array( 'pricing', 'table', 'plan', 'button' );
	}

	/**
	 * Retrieve widget styles dependencies.
	 *
	 * Ensures CSS is loaded only when the widget renders.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'alpha-pricetable-widget' );
	}

	/**
	 * Register widget controls.
	 *
	 * @return void
	 */
	protected function register_controls() {
		// Header Section.
		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'Header', 'alpha-price-table-for-elementor' ),
			)
		);

		$this->add_control(
			'check_demo',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					/* translators: 1: Demo link open tag, 2: Link close tag. */
					esc_html__( 'Check this widget demo %1$shere%2$s.', 'alpha-price-table-for-elementor' ),
					'<a href="https://ali-ali.org/project/alpha-price-table-for-elementor/" target="_blank">',
					'</a>'
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Title', 'alpha-price-table-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your title', 'alpha-price-table-for-elementor' ),
			)
		);

		$this->add_control(
			'heading_alignment',
			array(
				'label'       => esc_html__( 'Alignment', 'alpha-price-table-for-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'alpha-price-table-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'alpha-price-table-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'alpha-price-table-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .elementor-price-table__header' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'sub_heading',
			array(
				'label'   => esc_html__( 'Description', 'alpha-price-table-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your description', 'alpha-price-table-for-elementor' ),
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => esc_html__( 'Heading Tag', 'alpha-price-table-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
				'default' => 'h3',
			)
		);

		$this->end_controls_section();

		// Features Section.
		$this->start_controls_section(
			'section_features',
			array(
				'label' => esc_html__( 'Features', 'alpha-price-table-for-elementor' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_text',
			array(
				'label'   => esc_html__( 'Text', 'alpha-price-table-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Item', 'alpha-price-table-for-elementor' ),
			)
		);

		$default_icon = array(
			'value'   => 'far fa-check-circle',
			'library' => 'fa-regular',
		);

		$repeater->add_control(
			'selected_item_icon',
			array(
				'label'            => esc_html__( 'Icon', 'alpha-price-table-for-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'item_icon',
				'default'          => $default_icon,
			)
		);

		$repeater->add_control(
			'item_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
				),
				'default'   => '#4BD700',
			)
		);

		$repeater->add_control(
			'item_icon_position',
			array(
				'label'     => esc_html__( 'Icon Position', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'before',
				'options'   => array(
					'before' => esc_html__( 'Before', 'alpha-price-table-for-elementor' ),
					'after'  => esc_html__( 'After', 'alpha-price-table-for-elementor' ),
				),
				'condition' => array(
					'selected_item_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'features_list',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'item_text'          => esc_html__( 'List Item #1', 'alpha-price-table-for-elementor' ),
						'selected_item_icon' => $default_icon,
						'item_icon_position' => 'before',
					),
					array(
						'item_text'          => esc_html__( 'List Item #2', 'alpha-price-table-for-elementor' ),
						'selected_item_icon' => $default_icon,
						'item_icon_position' => 'before',
					),
					array(
						'item_text'          => esc_html__( 'List Item #3', 'alpha-price-table-for-elementor' ),
						'selected_item_icon' => $default_icon,
						'item_icon_position' => 'before',
					),
				),
				'title_field' => '{{{ item_text }}}',
			)
		);

		$this->end_controls_section();

		// Footer Section.
		$this->start_controls_section(
			'section_footer',
			array(
				'label' => esc_html__( 'Footer', 'alpha-price-table-for-elementor' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'alpha-price-table-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here', 'alpha-price-table-for-elementor' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'alpha-price-table-for-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'alpha-price-table-for-elementor' ),
				'default'     => array(
					'url' => '#',
				),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_header_style',
			array(
				'label'      => esc_html__( 'Header', 'alpha-price-table-for-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'header_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_SECONDARY,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__header' => 'background-color: {{VALUE}}',
				),
				'default'   => '#121212',
			)
		);

		$this->add_responsive_control(
			'header_padding',
			array(
				'label'      => esc_html__( 'Padding', 'alpha-price-table-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_heading_style',
			array(
				'label'     => esc_html__( 'Title', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => esc_html__( 'Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__heading' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .elementor-price-table__heading',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
			)
		);

		$this->add_control(
			'heading_sub_heading_style',
			array(
				'label'     => esc_html__( 'Sub Title', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'sub_heading_color',
			array(
				'label'     => esc_html__( 'Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__subheading' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_heading_typography',
				'selector' => '{{WRAPPER}} .elementor-price-table__subheading',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features_list_style',
			array(
				'label'      => esc_html__( 'Features', 'alpha-price-table-for-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'features_list_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__features-list' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'features_list_padding',
			array(
				'label'       => esc_html__( 'Padding', 'alpha-price-table-for-elementor' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%', 'em' ),
				'selectors'   => array(
					'{{WRAPPER}} .elementor-price-table__features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'     => array(
					'top'      => 25,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => false,
				),
				'placeholder' => array(
					'top'    => 25,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
			)
		);

		$this->add_control(
			'features_list_color',
			array(
				'label'     => esc_html__( 'Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_TEXT,
				),
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__features-list' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_list_typography',
				'selector' => '{{WRAPPER}} .elementor-price-table__features-list li',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_responsive_control(
			'item_width',
			array(
				'label'     => esc_html__( 'Width', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'%' => array(
						'min' => 25,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__feature-inner' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer_style',
			array(
				'label'      => esc_html__( 'Footer', 'alpha-price-table-for-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'footer_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__footer' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'footer_padding',
			array(
				'label'      => esc_html__( 'Padding', 'alpha-price-table-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-price-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_footer_button',
			array(
				'label'     => esc_html__( 'Button', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_size',
			array(
				'label'     => esc_html__( 'Size', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'md',
				'options'   => array(
					'xs' => esc_html__( 'Extra Small', 'alpha-price-table-for-elementor' ),
					'sm' => esc_html__( 'Small', 'alpha-price-table-for-elementor' ),
					'md' => esc_html__( 'Medium', 'alpha-price-table-for-elementor' ),
					'lg' => esc_html__( 'Large', 'alpha-price-table-for-elementor' ),
					'xl' => esc_html__( 'Extra Large', 'alpha-price-table-for-elementor' ),
				),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label'     => esc_html__( 'Normal', 'alpha-price-table-for-elementor' ),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__button' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector'  => '{{WRAPPER}} .elementor-price-table__button',
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_ACCENT,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__button' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'button_text!' => '',
				),
				'default'   => '#121212',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'button_border',
				'selector'  => '{{WRAPPER}} .elementor-price-table__button',
				'condition' => array(
					'button_text!' => '',
				),
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'alpha-price-table-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-price-table__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_text_padding',
			array(
				'label'      => esc_html__( 'Text Padding', 'alpha-price-table-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-price-table__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_text!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => esc_html__( 'Hover', 'alpha-price-table-for-elementor' ),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__button:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_background_hover_color',
			array(
				'label'     => esc_html__( 'Background Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__button:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-price-table__button:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_hover_animation',
			array(
				'label'     => esc_html__( 'Animation', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'alpha_pricetable',
			array(
				'label'      => esc_html__( 'Table', 'alpha-price-table-for-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'product_border',
				'selector'  => '{{WRAPPER}} .elementor-price-table',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'pricetable_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'alpha-price-table-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => 'true',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-price-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'alpha_pricetable_overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'alpha-price-table-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'Hidden',
				'options'   => array(
					'hidden'  => esc_html__( 'Hidden', 'alpha-price-table-for-elementor' ),
					'visible' => esc_html__( 'Visible', 'alpha-price-table-for-elementor' ),
				),
				'selectors' => array(
					'{{WRAPPER}}' => 'overflow: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Escape button size.
		$button_size = isset( $settings['button_size'] ) ? esc_attr( $settings['button_size'] ) : 'md';

		$this->add_render_attribute(
			'button_text',
			'class',
			array(
				'elementor-price-table__button',
				'elementor-button',
				'cta-bt',
				'elementor-size-' . $button_size,
			)
		);

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button_text', $settings['link'] );

			// Harden external links for security.
			if ( ! empty( $settings['link']['is_external'] ) ) {
				$this->add_render_attribute( 'button_text', 'rel', 'noopener noreferrer' );
			}
		}

		if ( ! empty( $settings['button_hover_animation'] ) ) {
			$this->add_render_attribute( 'button_text', 'class', 'elementor-animation-' . esc_attr( $settings['button_hover_animation'] ) );
		}

		$this->add_render_attribute( 'heading', 'class', 'elementor-price-table__heading' );
		$this->add_render_attribute( 'sub_heading', 'class', 'elementor-price-table__subheading' );
		$this->add_render_attribute( 'footer_additional_info', 'class', 'elementor-price-table__additional_info' );

		$this->add_inline_editing_attributes( 'heading', 'none' );
		$this->add_inline_editing_attributes( 'sub_heading', 'none' );
		$this->add_inline_editing_attributes( 'footer_additional_info' );
		$this->add_inline_editing_attributes( 'button_text' );

		$migration_allowed = Icons_Manager::is_migration_allowed();
		?>

		<div class="elementor-price-table">
			<?php if ( $settings['heading'] || $settings['sub_heading'] ) : ?>
				<div class="elementor-price-table__header">
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<<?php echo esc_attr( $settings['heading_tag'] ); ?> <?php echo wp_kses_post( $this->get_render_attribute_string( 'heading' ) ); ?>>
							<?php echo wp_kses_post( $settings['heading'] ); ?>
						</<?php echo esc_attr( $settings['heading_tag'] ); ?>>
					<?php endif; ?>

					<?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
						<span <?php echo wp_kses_post( $this->get_render_attribute_string( 'sub_heading' ) ); ?>>
							<?php echo wp_kses_post( $settings['sub_heading'] ); ?>
						</span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $settings['features_list'] ) ) : ?>
				<ul class="elementor-price-table__features-list">
					<?php
					foreach ( $settings['features_list'] as $index => $item ) :
						$repeater_setting_key = $this->get_repeater_setting_key( 'item_text', 'features_list', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );

						$migrated = isset( $item['__fa4_migrated']['selected_item_icon'] );
						// Add old default.
						if ( ! isset( $item['item_icon'] ) && ! $migration_allowed ) {
							$item['item_icon'] = 'fa fa-check-circle';
						}
						$is_new = ! isset( $item['item_icon'] ) && $migration_allowed;

						// Sanitize the item ID for class attribute.
						$item_id = isset( $item['_id'] ) ? sanitize_html_class( $item['_id'] ) : '';
						?>
						<li class="elementor-repeater-item-<?php echo esc_attr( $item_id ); ?>">
							<div class="elementor-price-table__feature-inner">
								<?php
								$item_icon_position = $item['item_icon_position'];
								$location_setting   = ! empty( $item_icon_position ) ? $item_icon_position : 'before';
								if ( ( ! empty( $item['item_icon'] ) || ! empty( $item['selected_item_icon'] ) ) && 'before' === $location_setting ) :
									if ( $is_new || $migrated ) :
										Icons_Manager::render_icon( $item['selected_item_icon'], array( 'aria-hidden' => 'true' ) );
									else :
										?>
										<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
										<?php
									endif;
								endif;
								if ( ! empty( $item['item_text'] ) ) :
									?>
									<span <?php echo wp_kses_post( $this->get_render_attribute_string( $repeater_setting_key ) ); ?>>
										<?php echo esc_html( $item['item_text'] ); ?>
									</span>
									<?php
								else :
									echo '&nbsp;';
								endif;
								if ( ( ! empty( $item['item_icon'] ) || ! empty( $item['selected_item_icon'] ) ) && 'after' === $location_setting ) :
									if ( $is_new || $migrated ) :
										Icons_Manager::render_icon( $item['selected_item_icon'], array( 'aria-hidden' => 'true' ) );
									else :
										?>
										<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
										<?php
									endif;
								endif;
								?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ( ! empty( $settings['button_text'] ) || ! empty( $settings['footer_additional_info'] ) ) : ?>
				<div class="elementor-price-table__footer">
					<?php if ( ! empty( $settings['button_text'] ) ) : ?>
						<a <?php echo wp_kses_post( $this->get_render_attribute_string( 'button_text' ) ); ?>>
							<?php echo esc_html( $settings['button_text'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $settings['footer_additional_info'] ) ) : ?>
						<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'footer_additional_info' ) ); ?>>
							<?php echo wp_kses_post( $settings['footer_additional_info'] ); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
	}
}
