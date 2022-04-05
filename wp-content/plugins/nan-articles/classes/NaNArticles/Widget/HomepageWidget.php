<?php

namespace NaNArticles\Widget;

use NaNArticles\Api\Api;
use NaNArticles\Api\Query;

class HomepageWidget extends \WP_Widget
{
	public function __construct()
	{
		$this->widget_slug = 'nan_hp_articles_widget';
		$this->widget_template = 'hp-articles.tpl.php';

		parent::__construct(
	        $this->widget_slug, // Base ID
	        __( 'Articles HP Widget', $this->widget_slug ), // Name
	        array( 'description' => __( 'A widget to display articles on the Homepage.', $this->widget_slug ), ) // Args
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

		$post_type = get_post_type($post->ID);

		$no_of_articles = get_field( 'no_of_articles', 'widget_' . $this->id );

		$data = array();
		$data['most_read'] = Api::get_most_read_article();
		$data['most_read_label'] = get_field( 'most_read_label', 'widget_' . $this->id );
		$data['articles_label'] = get_field( 'articles_label', 'widget_' . $this->id );
		$data['view_all_link'] = get_field( 'view_all_link', 'widget_' . $this->id );
		$latest_articles = Api::get_latest_articles($no_of_articles, 'nan-articles');

		global $post;

		$articles = array();

		foreach( $latest_articles as $post ) {
			setup_postdata( $post );
			$articles[] = Query::get_article_details();
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
			'key' => 'group_5a83cd7e98df4',
			'title' => 'Homepage Articles Widget',
			'fields' => array(
				array(
					'key' => 'field_5a83cd855feaa',
					'label' => 'Most Read Label',
					'name' => 'most_read_label',
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
					'key' => 'field_5a83cf4b2b6d4',
					'label' => 'Articles Label',
					'name' => 'articles_label',
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
					'key' => 'field_5a83d5f7da5d1',
					'label' => 'No of articles',
					'name' => 'no_of_articles',
					'type' => 'number',
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
					'min' => 0,
					'max' => 5,
					'step' => '',
				),
				array(
					'key' => 'field_5a83cf912b6d5',
					'label' => 'View All Link',
					'name' => 'view_all_link',
					'type' => 'page_link',
					'instructions' => '',
					'required' => 1,
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
						'value' => 'nan_hp_articles_widget',
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