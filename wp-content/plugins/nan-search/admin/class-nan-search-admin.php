<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CMS Settings for NaN_Search plugin
 *
 * @author mjdbaga@gmail.com
 */
class NaN_Search_Admin {
	
	protected static $instance;
	private $template_path;
	
	/**
	 * Returns an instance of this class. An implementation of the singleton design pattern.
	 *
	 * @return   NaN_Search_Admin    A reference to an instance of this class.
	 * @since    0.1.0
	 */
	public static function get_instance() {

		if( null == self::$instance ) {
			self::$instance = new NaN_Search_Admin();
		} // end if

		return self::$instance;
	}
	
	private function __construct() {
		$this->template_path = NAN_SEARCH_PLUGIN_DIR . '/admin/templates';
		$this->template_name = 'search_settings.tpl.php';
		$this->settings = array(
				'page_title' => __( 'notAnoobie Search Plugin Settings' ),
				'menu_title' => __( 'notAnoobie Search settings' ),
				'menu_slug' => 'nan-search-setting-admin',
				'option_group' => 'nan_search_option_group',
				'option_name' => NAN_SEARCH_OPTIONS_NAME,
		);
		$this->register_menu();
	}
	
	private function register_menu() {
		add_action( 'admin_menu', array( $this, 'add_plugin_menu' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}
	
	/**
	 * Add options page
	 */
	public function add_plugin_menu() {
		// This page will be under "Settings"
		add_options_page(
						$this->settings['page_title'], $this->settings['menu_title'], 'manage_options', $this->settings['menu_slug'], array( $this, 'create_admin_page' )
		);
	}
	
	/**
	 * Options page callback
	 */
	public function create_admin_page() {
		ob_start();
		settings_fields( $this->settings['option_group'] );
		do_settings_sections( $this->settings['menu_slug'] );
		submit_button();
		$settings = ob_get_clean();
		require_once( $this->template_path . DIRECTORY_SEPARATOR .$this->template_name );
	}
	
	/**
	 * Register and add settings
	 */
	public function page_init() {
		register_setting(
						$this->settings['option_group'], // Option group
						$this->settings['option_name'], // Option name
						array( $this, 'sanitize' )
		);

		//Events Section
		add_settings_section(
						'nan_search_settings_section', // ID
						__( 'notAnoobie Search Settings Section' ), // Title
						array( $this, 'search_section_callback' ), // Callback
						$this->settings['menu_slug'] // Page
		);


		//Add Fields
		add_settings_field(
						'nan_search_page', // ID
						__( 'notAnoobie Search Page' ), // Title
						array( $this, '_nan_search_page_id_callback' ), // Callback
						$this->settings['menu_slug'], // Page
						'nan_search_settings_section' // Section
		);
		
		add_settings_field(
						'nan_search_cx_id', // ID
						__( 'notAnoobie Search Cx Id' ), // Title
						array( $this, '_nan_search_cx_id_callback' ), // Callback
						$this->settings['menu_slug'], // Page
						'nan_search_settings_section' // Section
		);
	}
	
	/**
	 * Sanitize the data submitted by user
	 * 
	 * @param type $input
	 * @return array
	 */
	public function sanitize( $input ) {
		$new_input = array();
		if( isset( $input['nan_search_page'] ) ) {
			$new_input['nan_search_page'] = absint( $input['nan_search_page'] );
		}
		if( isset( $input['nan_search_cx_id'] ) ) {
			$new_input['nan_search_cx_id'] = sanitize_text_field( $input['nan_search_cx_id'] );
		}

		return $new_input;
	}
	
	/**
	 * Callback function for settings field for options page
	 */
	public function _nan_search_page_id_callback() {
		$selected = NaN_Search_Api::get_search_page();
		$args = array(
				'name' => $this->settings['option_name'] . '[nan_search_page]',
				'id' => 'nan_search_page_id',
				'selected' => $selected
		);
		wp_dropdown_pages( $args );
	}
	
	/**
	 * Callback function for settings field for options page
	 */
	public function _nan_search_cx_id_callback() {
		$cx_id = NaN_Search_Api::get_search_cx_id();
		$cx_id_name = $this->settings['option_name'] . '[nan_search_cx_id]';

		require_once dirname( __FILE__ ) . '/templates/input-cx-id.tpl.php';
	}
	
	/**
	 * callback function for event calendar section
	 */
	public function search_section_callback() {
		_e( 'Modify all Search Settings:' );
	}
	
}
