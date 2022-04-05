<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CMS Settings for Adelphi_Base_Addthis plugin
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Base_Addthis {
  
  protected static $instance;
  private $template_path;
  
  /**
   * Returns an instance of this class. An implementation of the singleton design pattern.
   *
   * @return   Adelphi_Base_Addthis    A reference to an instance of this class.
   * @since    0.1.0
   */
  public static function get_instance() {

    if( null == self::$instance ) {
      self::$instance = new Adelphi_Base_Addthis();
    } // end if

    return self::$instance;
  }
  
  private function __construct() {
    $this->template_path = AD_BASE_PLUGIN_DIR . '/addthis/templates';
    $this->template_name = 'addthis_settings.tpl.php';
    $this->settings = array(
        'page_title' => __( 'Addthis Plugin Settings' ),
        'menu_title' => __( 'Addthis settings' ),
        'menu_slug' => 'ad-base-addthis-setting-admin',
        'option_group' => 'ad_base_addthis_option_group',
        'option_name' => AD_BASE_ADDTHIS_OPTIONS_NAME,
    );
    $this->register_menu();
    $this->init_head();
  }
  
  private function register_menu() {
    add_action( 'admin_menu', array( $this, 'add_plugin_menu' ) );
    add_action( 'admin_init', array( $this, 'page_init' ) );
  }
  
  private function init_head() {
    add_action( 'wp_footer', array( $this, 'ad_add_addthis' ) );
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
            'ad_base_addthis_section', // ID
            __( 'Addthis Section' ), // Title
            array( $this, 'addthis_section_callback' ), // Callback
            $this->settings['menu_slug'] // Page
    );


    //Add Fields
    add_settings_field(
            'ad_base_addthis_id', // ID
            __( 'Addthis Id' ), // Title
            array( $this, '_adelphi_base_addthis_page_id_callback' ), // Callback
            $this->settings['menu_slug'], // Page
            'ad_base_addthis_section' // Section
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
    if( isset( $input['ad_base_addthis_id'] ) ) {
      $new_input['ad_base_addthis_id'] = sanitize_text_field( $input['ad_base_addthis_id'] );
    }

    return $new_input;
  }
  
  /**
   * Callback function for settings field for options page
   */
  public function _adelphi_base_addthis_page_id_callback() {
    $addthis = Adelphi_Base_Api::get_addthis_id();    
    require_once AD_BASE_PLUGIN_DIR . '/addthis/templates/field_addthis.tpl.php';
  }
  
  /**
   * callback function for Addthis section
   */
  public function addthis_section_callback() {
    _e( 'Modify Addthis Settings:' );
  }
  
  public function ad_add_addthis() {
    $addthis_id = Adelphi_Base_Api::get_addthis_id();
    require_once AD_BASE_PLUGIN_DIR . '/addthis/templates/addthis.tpl.php';
  }
}
