<?php

namespace NaNStories;

use NaNStories\Post\Post;

class Story
{
	public $settings;

	protected static $instance;

	/**
	 * Returns an instance of this class. An implementation of the singleton design pattern.
	 *
	 * @return   Story    A reference to an instance of this class.
	 * @since    0.1.0
	 */
	public static function get_instance() 
	{
		if( null == self::$instance ) {
			self::$instance = new Story();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->init_custom_posts();
	}

	function init_custom_posts() 
	{
    	$story = Post::get_instance();
    }

}