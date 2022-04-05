<?php

namespace NaNResources;

use NaNResources\Post\Post;

class Resource
{
	public $settings;

	protected static $instance;

	/**
	 * Returns an instance of this class. An implementation of the singleton design pattern.
	 *
	 * @return   Resource    A reference to an instance of this class.
	 * @since    0.1.0
	 */
	public static function get_instance() 
	{
		if( null == self::$instance ) {
			self::$instance = new Resource();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->init_custom_posts();
	}

	function init_custom_posts() 
	{
    	$resource = Post::get_instance();
    }

}