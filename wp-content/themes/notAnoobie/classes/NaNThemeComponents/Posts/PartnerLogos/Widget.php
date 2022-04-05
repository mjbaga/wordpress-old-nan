<?php

namespace NaNThemeComponents\Posts\PartnerLogos;

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
		$this->widget_slug = 'partner_logo_widget';
		$this->widget_template_path = THEME_ABSOLUTE_PATH . '/templates/footer-logo.tpl.php';

		parent::__construct(
				$this->widget_slug, // Base ID
				__( 'Partner Logo Widget', $this->widget_slug ), // Name
				array( 'description' => __( 'A widget to display partner logos at footer.', $this->widget_slug ), ) // Args
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
		$label = get_field( 'label', 'widget_' . $this->id );
		$logos = get_field( 'logo_ids', 'widget_' . $this->id );

		if( $logos === '' ) {
			return '';
		}

		$partner_logos_array = explode( ',', $logos );

		global $post;

		$data = array();

		foreach( $partner_logos_array as $logo_id ) {
			$post = get_post( $logo_id );
			setup_postdata( $post );

			$partner = array();
			$partner['alt'] = get_the_title();
			$partner['image'] = get_the_post_thumbnail_url( null , 'full' );
			$partner['link'] = get_field('link');

			$data[] = $partner;
		}

		wp_reset_postdata();

		ob_start();
		require $this->widget_template_path;
		$html = ob_get_clean();

		return $html;
	}
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

	}

	public static function register_fields() {
		
		if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5a25fee4bed13',
			'title' => 'Partner Logos Widget',
			'fields' => array(
				array(
					'key' => 'field_5a7d070729047',
					'label' => 'Label',
					'name' => 'label',
					'type' => 'text',
					'instructions' => 'Shows up before the logos',
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
					'key' => 'field_5a25ff63ecf1a',
					'label' => 'Logo IDs',
					'name' => 'logo_ids',
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
			),
			'location' => array(
				array(
					array(
						'param' => 'widget',
						'operator' => '==',
						'value' => 'partner_logo_widget',
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
