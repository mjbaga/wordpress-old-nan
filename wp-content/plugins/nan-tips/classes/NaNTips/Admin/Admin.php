<?php

namespace NaNTips\Admin;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CMS Settings for Tips plugin
 *
 * @author mjdbaga@gmail.com
 */
class Admin
{
	protected static $instance;
	private $template_path;
	
	/**
	* Returns an instance of this class. An implementation of the singleton design pattern.
	*
	* @return   Admin    A reference to an instance of this class.
	* @since    0.1.0
	*/
	public static function get_instance() 
	{

	    if( null == self::$instance ) {
	        self::$instance = new Admin();
	    } // end if

	    return self::$instance;

	}

	private function __construct() 
	{
	    $this->settings = array(
	        'page_title' => __( 'Tips Plugin Settings' ),
	        'menu_title' => __( 'Tips settings' ),
	        'menu_slug' => 'nan-tips-setting-admin',
	        'option_group' => 'nan_tips_option_group',
	        'option_name' => 'nan_tips_options_name',
	        'parent_slug' => 'options-general.php',
	        'position' => false,
	        'icon_url' => false
	    );

	    if( function_exists('acf_add_options_page')) {
	    	acf_add_options_sub_page($this->settings);
	    }

	    add_action( 'init', array( $this, 'register_fields' ) );

	}

	function register_fields() 
	{
		if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5a8290ac73970',
			'title' => 'Tips Settings',
			'fields' => array(
				array(
					'key' => 'field_5a8290b41cd80',
					'label' => 'Push Notification Frequency',
					'name' => 'push_notification_frequency',
					'type' => 'time_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'g:i a',
					'return_format' => 'H:i:s',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'nan-tips-setting-admin',
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