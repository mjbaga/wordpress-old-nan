<?php

namespace NaNThemeComponents\Widgets\SocialIcons;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * FooterLogoWidget to display copyright information
 *
 * @author mjdbaga@gmail.com
 */
class Widget extends \WP_Widget 
{
	
	protected $widget_slug;
	protected $widget_template_path;
	protected $form_template_path;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() 
	{
		$this->widget_slug = 'social_icons_widget';
		$this->widget_template_path = THEME_ABSOLUTE_PATH . '/templates/social-icons.tpl.php';
		parent::__construct(
				$this->widget_slug, // Base ID
				__( 'Social Icons Widget', $this->widget_slug ), // Name
				array( 'description' => __( 'A widget to display social icons at the footer.', $this->widget_slug ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) 
	{
		echo $args['before_widget'];
		echo $this->parse_widget( $instance );
		echo $args['after_widget'];
	}

	/**
	 *
	 * @param type $instance instance of this widget specified in widget area.
	 * @return String html for all sponsors to be rendered in footer. Returns from cache if cache exists.
	 */
	public function parse_widget( $instance ) 
	{
		global $wp_query;

		$cache_key = $this->widget_slug . '_' . $this->id;
		$cache = get_transient( $cache_key );
		$cache_time = 1500;

		$icons = get_field( 'social_icons', 'widget_' . $this->id );

		if( empty($icons) ) {
			return '';
		}

		ob_start();
		require_once $this->widget_template_path;
		$html = ob_get_clean();

		return $html;
	}

	public function flush_widget_cache() 
	{
		$cache_key = $this->widget_slug . '_' . $this->id;
		delete_transient( $cache_key );
	}

	public static function register_fields() 
	{

		if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5a7d00f36bec2',
			'title' => 'Social Icons',
			'fields' => array(
				array(
					'key' => 'field_5a7d00f802bf2',
					'label' => 'Social Icons',
					'name' => 'social_icons',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'row',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5a7d01927c69d',
							'label' => 'Icon Name',
							'name' => 'icon_name',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5a7d01af7c69e',
							'label' => 'Icon',
							'name' => 'icon',
							'type' => 'select',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'icon-facebook' => 'Facebook',
							),
							'default_value' => array(
							),
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'ajax' => 0,
							'return_format' => 'value',
							'placeholder' => '',
						),
						array(
							'key' => 'field_5a7d02567c69f',
							'label' => 'Link',
							'name' => 'link',
							'type' => 'url',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'widget',
						'operator' => '==',
						'value' => 'social_icons_widget',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));

		endif;

	}
	
}
