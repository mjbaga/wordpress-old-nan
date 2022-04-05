<?php

namespace NaNTips;

use NaNTips\Post\Post;
use NaNTips\Admin\Admin;
use NaNTips\Page\Listing;

class Tips
{
	public $settings;

	protected static $instance;

	/**
	 * Returns an instance of this class. An implementation of the singleton design pattern.
	 *
	 * @return   Tips    A reference to an instance of this class.
	 * @since    0.1.0
	 */
	public static function get_instance() 
	{
		if( null == self::$instance ) {
			self::$instance = new Tips();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->init_custom_posts();
		$this->init_tips_api();
		$this->init_widgets();
		$this->init_custom_admin_settings();
		$this->init_page_templates();
	}

	function init_custom_posts() 
	{
    	$Tips = Post::get_instance();
    }

    function init_page_templates() 
    {
		$page_templates = Listing::get_instance();
    }

    private function init_widgets() 
    {
    	add_action( 'widgets_init', array( $this, 'register_widgets' ) );
    }

    function register_widgets() 
    {
    	register_widget( 'NaNTips\\Widget\\Widget' );
    	add_action( 'init', array( '\\NaNTips\\Widget\\Widget', 'register_fields' ) );
    }

    function init_custom_admin_settings() 
    {
		$admin_settings = Admin::get_instance();
    }

	function init_tips_api()
    {
    	add_action( 'rest_api_init', function () {

    	    register_rest_route( 'tip', 'today',array(
    	        'methods'  => array('GET'),
    	        'callback' => array('\\NaNTips\\Api\\Api', 'get_todays_tip')
    	    ));

    	});

    	add_action( 'rest_api_init', function () {

    	    register_rest_route( 'tips', 'last_month',array(
    	        'methods'  => array('GET'),
    	        'callback' => array('\\NaNTips\\Api\\Query', 'get_prevmonth_tips')
    	    ));

    	});
    }

}