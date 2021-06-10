<?php
namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;


class Alpha_Price_Table extends Widget_Base {

	public function get_name() {
		return 'alpha-price-table';
	}

	public function get_title() {
		return __( 'Alpha Price Table', 'alpha-price-table-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_keywords() {
		return [ 'pricing', 'table', 'product', 'image', 'plan', 'button' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_header',
			[
				'label' => __( 'Header', 'alpha-price-table-for-elementor' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => __( 'Title', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Enter your title', 'alpha-price-table-for-elementor' ),
			]
		);

		$this->add_control(
			'heading_alignment',
			[
				'label' => __( 'Alignment', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'alpha-price-table-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'alpha-price-table-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Description', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Enter your description', 'alpha-price-table-for-elementor' ),
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label' => __( 'Heading Tag', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Features', 'alpha-price-table-for-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_text',
			[
				'label' => __( 'Text', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'List Item', 'alpha-price-table-for-elementor' ),
			]
		);

		$default_icon = [
			'value' => 'far fa-check-circle',
			'library' => 'fa-regular',
		];

		$repeater->add_control(
			'selected_item_icon',
			[
				'label' => __( 'Icon', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'item_icon',
				'default' => $default_icon,
			]
		);

		$repeater->add_control(
			'item_icon_color',
			[
				'label' => __( 'Icon Color', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'item_icon_position',
			[
				'label' => __( 'Icon Position', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before' => __( 'Before', 'alpha-price-table-for-elementor' ),
					'after' => __( 'After', 'alpha-price-table-for-elementor' ),
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
						'item_text' => __( 'List Item #1', 'alpha-price-table-for-elementor' ),
						'selected_item_icon' => $default_icon,
						'item_icon_position' => 'before',
					],
					[
						'item_text' => __( 'List Item #2', 'alpha-price-table-for-elementor' ),
						'selected_item_icon' => $default_icon,
						'item_icon_position' => 'before',
					],
					[
						'item_text' => __( 'List Item #3', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Footer', 'alpha-price-table-for-elementor' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'alpha-price-table-for-elementor' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Header', 'alpha-price-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'header_bg_color',
			[
				'label' => __( 'Background Color', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label' => __( 'Padding', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_heading_style',
			[
				'label' => __( 'Title', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Color', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Sub Title', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label' => __( 'Color', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Features', 'alpha-price-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'features_list_bg_color',
			[
				'label' => __( 'Background Color', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Padding', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_list_color',
			[
				'label' => __( 'Color', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Width', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Footer', 'alpha-price-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'footer_bg_color',
			[
				'label' => __( 'Background Color', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__footer' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'footer_padding',
			[
				'label' => __( 'Padding', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_footer_button',
			[
				'label' => __( 'Button', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Size', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'xs' => __( 'Extra Small', 'alpha-price-table-for-elementor' ),
					'sm' => __( 'Small', 'alpha-price-table-for-elementor' ),
					'md' => __( 'Medium', 'alpha-price-table-for-elementor' ),
					'lg' => __( 'Large', 'alpha-price-table-for-elementor' ),
					'xl' => __( 'Extra Large', 'alpha-price-table-for-elementor' ),
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'alpha-price-table-for-elementor' ),
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Background Color', 'alpha-price-table-for-elementor' ),
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
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
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
				'label' => __( 'Border Radius', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
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
				'label' => __( 'Text Padding', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
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
				'label' => __( 'Hover', 'alpha-price-table-for-elementor' ),
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Background Color', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Border Color', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Animation', 'alpha-price-table-for-elementor' ),
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
				'label' => __( 'Table', 'alpha-price-table-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'alpha_pricetable_overflow',
			[
				'label' => __( 'Overflow', 'alpha-price-table-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'hidden',
				'options' => [
					'hidden' => __( 'Hidden', 'alpha-price-table-for-elementor' ),
					'visible' => __( 'Visible', 'alpha-price-table-for-elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}}' => 'overflow: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'button_text', 'class', [
			'elementor-price-table__button',
			'elementor-button',
			'cta-bt',
			'elementor-size-' . $settings['button_size'],
		] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button_text', 'href', $settings['link']['url'] );

			if ( ! empty( $settings['link']['is_external'] ) ) {
				$this->add_render_attribute( 'button_text', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button_text', 'rel', 'nofollow' );
			}
		}

		if ( ! empty( $settings['button_hover_animation'] ) ) {
			$this->add_render_attribute( 'button_text', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}

		$this->add_render_attribute( 'heading', 'class', 'elementor-price-table__heading' );
		$this->add_render_attribute( 'sub_heading', 'class', 'elementor-price-table__subheading' );
		$this->add_render_attribute( 'footer_additional_info', 'class', 'elementor-price-table__additional_info' );


		$this->add_inline_editing_attributes( 'heading', 'none' );
		$this->add_inline_editing_attributes( 'sub_heading', 'none' );
		$this->add_inline_editing_attributes( 'footer_additional_info' );
		$this->add_inline_editing_attributes( 'button_text' );

		$heading_tag = $settings['heading_tag'];

		$migration_allowed = Icons_Manager::is_migration_allowed();
		?>

		<div class="elementor-price-table">
			<?php if ( $settings['heading'] || $settings['sub_heading'] ) : ?>
				<div class="elementor-price-table__header">
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<<?php echo $heading_tag . ' ' . $this->get_render_attribute_string( 'heading' ); ?>><?php echo $settings['heading'] . '</' . $heading_tag; ?>>
					<?php endif; ?>

					<?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
						<span <?php echo $this->get_render_attribute_string( 'sub_heading' ); ?>><?php echo $settings['sub_heading']; ?></span>
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
						// add old default
						if ( ! isset( $item['item_icon'] ) && ! $migration_allowed ) {
							$item['item_icon'] = 'fa fa-check-circle';
						}
						$is_new = ! isset( $item['item_icon'] ) && $migration_allowed;
						?>
						<li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
							<div class="elementor-price-table__feature-inner">
								<?php 
								$item_icon_position = $item['item_icon_position'];
								$location_setting = ! empty( $item_icon_position ) ? $item_icon_position : 'before';
								if ( ! empty( $item['item_icon'] ) || ! empty( $item['selected_item_icon'] ) && $location_setting == 'before' ) :
									if ( $is_new || $migrated ) :
										Icons_Manager::render_icon( $item['selected_item_icon'], [ 'aria-hidden' => 'true' ] );
									else : ?>
										<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
										<?php
									endif;
								endif; ?>
								<?php if ( ! empty( $item['item_text'] ) ) : ?>
									<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>>
										<?php echo $item['item_text']; ?>
									</span>
									<?php
								else :
									echo '&nbsp;';
								endif;
								if ( ! empty( $item['item_icon'] ) || ! empty( $item['selected_item_icon'] ) && $location_setting == 'after' ) :
									if ( $is_new || $migrated ) :
										Icons_Manager::render_icon( $item['selected_item_icon'], [ 'aria-hidden' => 'true' ] );
									else : ?>
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
						<a <?php echo $this->get_render_attribute_string( 'button_text' ); ?>><?php echo $settings['button_text']; ?></a>
					<?php endif; ?>

					<?php if ( ! empty( $settings['footer_additional_info'] ) ) : ?>
						<div <?php echo $this->get_render_attribute_string( 'footer_additional_info' ); ?>><?php echo $settings['footer_additional_info']; ?></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
	}

	protected function _content_template() {
		?>
		<#
		var iconsHTML = {};
		var buttonClasses = 'elementor-price-table__button elementor-button cta-bt elementor-size-' + settings.button_size;

		if ( settings.button_hover_animation ) {
			buttonClasses += ' elementor-animation-' + settings.button_hover_animation;
		}

		view.addRenderAttribute( 'heading', 'class', 'elementor-price-table__heading' );
		view.addRenderAttribute( 'sub_heading', 'class', 'elementor-price-table__subheading' );	
		view.addRenderAttribute( 'footer_additional_info', 'class', 'elementor-price-table__additional_info'  );
		view.addRenderAttribute( 'button_text', 'class', buttonClasses  );

		view.addInlineEditingAttributes( 'heading', 'none' );
		view.addInlineEditingAttributes( 'sub_heading', 'none' );
		view.addInlineEditingAttributes( 'footer_additional_info' );
		view.addInlineEditingAttributes( 'button_text' );

		#>
		<div class="elementor-price-table">
			<# if ( settings.heading || settings.sub_heading ) { #>
				<div class="elementor-price-table__header">
					<# if ( settings.heading ) { #>
						<{{ settings.heading_tag }} {{{ view.getRenderAttributeString( 'heading' ) }}}>{{{ settings.heading }}}</{{ settings.heading_tag }}>
					<# } #>
					<# if ( settings.sub_heading ) { #>
						<span {{{ view.getRenderAttributeString( 'sub_heading' ) }}}>{{{ settings.sub_heading }}}</span>
					<# } #>
				</div>
			<# } #>

			<# if ( settings.features_list ) { #>
				<ul class="elementor-price-table__features-list">
				<# _.each( settings.features_list, function( item, index ) {

					var featureKey = view.getRepeaterSettingKey( 'item_text', 'features_list', index ),
						migrated = elementor.helpers.isIconMigrated( item, 'selected_item_icon' );

					view.addInlineEditingAttributes( featureKey ); #>

						<li class="elementor-repeater-item-{{ item._id }}">
							<div class="elementor-price-table__feature-inner">
								<# if ( item.item_icon  || item.selected_item_icon && item.item_icon_position == 'before' ) {
									iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.selected_item_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
									if ( ( ! item.item_icon || migrated ) && iconsHTML[ index ] && iconsHTML[ index ].rendered ) { #>
										{{{ iconsHTML[ index ].value }}}
									<# } else { #>
										<i class="{{ item.item_icon }}" aria-hidden="true"></i>
									<# }
								} #>
								<# if ( ! _.isEmpty( item.item_text.trim() ) ) { #>
									<span {{{ view.getRenderAttributeString( featureKey ) }}}>{{{ item.item_text }}}</span>
								<# } else { #>
									&nbsp;
								<# } #>
								<# if ( item.item_icon  || item.selected_item_icon && item.item_icon_position == 'after' ) {
									iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.selected_item_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
									if ( ( ! item.item_icon || migrated ) && iconsHTML[ index ] && iconsHTML[ index ].rendered ) { #>
										{{{ iconsHTML[ index ].value }}}
									<# } else { #>
										<i class="{{ item.item_icon }}" aria-hidden="true"></i>
									<# }
								} #>
							</div>
						</li>
					<# } ); #>
				</ul>
			<# } #>

			<# if ( settings.button_text || settings.footer_additional_info ) { #>
				<div class="elementor-price-table__footer">
					<# if ( settings.button_text ) { #>
						<a href="#" {{{ view.getRenderAttributeString( 'button_text' ) }}}>{{{ settings.button_text }}}</a>
					<# } #>
					<# if ( settings.footer_additional_info ) { #>
						<p {{{ view.getRenderAttributeString( 'footer_additional_info' ) }}}>{{{ settings.footer_additional_info }}}</p>
					<# } #>
				</div>
			<# } #>
		</div>

		<?php
	}
}
