<?php

namespace NaNTips\Widget;

use NaNTips\Tips;
use NaNTips\Api\Api;

class Widget extends \WP_Widget
{
	public function __construct()
	{
		$this->widget_slug = 'nan_tips_widget';
		$this->widget_template_slug = 'widget';
		$this->widget_template = 'tips.tpl.php';

		parent::__construct(
	        $this->widget_slug, // Base ID
	        __( 'Tips Widget', $this->widget_slug ), // Name
	        array( 'description' => __( 'A widget to display tip of the day on Homepage.', $this->widget_slug ), ) // Args
		);

		add_action( 'init', array( $this, 'register_fields' ) );
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
	 * @return String html for all the sideposts to be rendered. Returns from cache if cache exists.
	 */
	public function parse_widget( $instance )
	{
		$tip = Api::get_todays_tip();

		$data = array();
		$data['tip'] = !empty($tip) ? $tip['tip'] : 'No tip for today';
		$data['heading'] = get_field( 'heading', 'widget_' . $this->id );
		$data['subheading'] = get_field( 'subheading', 'widget_' . $this->id );
		$data['listing_link'] = get_field( 'listing_link', 'widget_' . $this->id );

		$html = Api::render( $this->widget_template, $data );
		return $html;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) 
	{

	}

	public static function register_fields() 
	{
		if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5a812779b7707',
			'title' => 'Tips Widget',
			'fields' => array(
				array(
					'key' => 'field_5a8127811e69b',
					'label' => 'Heading',
					'name' => 'heading',
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
					'key' => 'field_5a81279a1e69c',
					'label' => 'Subheading',
					'name' => 'subheading',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
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
					'key' => 'field_5a8127ae1e69d',
					'label' => 'Listing Link',
					'name' => 'listing_link',
					'type' => 'page_link',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'page',
					),
					'taxonomy' => array(
					),
					'allow_null' => 0,
					'allow_archives' => 1,
					'multiple' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'widget',
						'operator' => '==',
						'value' => 'nan_tips_widget',
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