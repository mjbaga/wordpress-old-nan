<?php

namespace NaNArticles\Widget;

use NaNArticles\Api\Api;
use NaNArticles\Api\Query;

class ArticlesWidget extends \WP_Widget
{
	public function __construct()
	{
		$this->widget_slug = 'nan_articles_widget';
		$this->widget_template = 'articles.tpl.php';

		parent::__construct(
	        $this->widget_slug, // Base ID
	        __( 'Articles Widget', $this->widget_slug ), // Name
	        array( 'description' => __( 'A widget to display articles, stories or resources on the bottom of detail pages.', $this->widget_slug ), ) // Args
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
		global $post;

		$no_of_articles = get_field( 'no_of_articles', 'widget_' . $this->id );
		$post_type = get_post_type($post->ID);

		$data = array();
		$data['heading'] = get_field( 'heading', 'widget_' . $this->id );
		$latest_articles = Api::get_latest_articles($no_of_articles, $post_type);

		$articles = array();

		if(!empty($latest_articles)) {
			foreach( $latest_articles as $post ) {
				setup_postdata( $post );
				$articles[] = Query::get_thumbnail_details();
			}
		}

		$data['articles'] = $articles;
		
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
			'key' => 'group_5a83e8ed53f79',
			'title' => 'Articles Widget',
			'fields' => array(
				array(
					'key' => 'field_5a83e9a56074d',
					'label' => 'Heading',
					'name' => 'heading',
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
					'key' => 'field_5a83e9b66074e',
					'label' => 'No of Articles',
					'name' => 'no_of_articles',
					'type' => 'number',
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
					'min' => 0,
					'max' => 3,
					'step' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'widget',
						'operator' => '==',
						'value' => 'nan_articles_widget',
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