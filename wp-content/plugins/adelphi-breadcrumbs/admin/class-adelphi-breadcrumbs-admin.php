<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CMS Settings for Adelphi_Breadcrumbs plugin
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Breadcrumbs_Admin {
  
  protected static $instance;
  private $template_path;
  
  /**
   * Returns an instance of this class. An implementation of the singleton design pattern.
   *
   * @return   Adelphi_Breadcrumbs_Admin    A reference to an instance of this class.
   * @since    0.1.0
   */
  public static function get_instance() {

    if( null == self::$instance ) {
      self::$instance = new Adelphi_Breadcrumbs_Admin();
    } // end if

    return self::$instance;
  }
  
  private function __construct() {
    $this->template_path = LP_BREADCRUMBS_PLUGIN_DIR . '/admin/templates';
    $this->template_name = 'breadcrumbs_settings.tpl.php';
    $this->settings = array(
        'page_title' => __( 'Breadcrumbs Plugin Settings' ),
        'menu_title' => __( 'Breadcrumbs settings' ),
        'menu_slug' => 'ad-breadcrumbs-setting-admin',
        'option_group' => 'ad_breadcrumbs_option_group',
        'option_name' => LP_BREADCRUMBS_OPTIONS_NAME,
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

    //Breadcrumbs Section
    add_settings_section(
            'ad_breadcrumbs_custom_posts_section', // ID
            __( 'Breadcrumbs Custom Posts Section' ), // Title
            array( $this, 'custom_posts_section_callback' ), // Callback
            $this->settings['menu_slug'] // Page
    );

    $custom_posts = get_post_types( array( 'public' => true ) );

    foreach( $custom_posts as $type ) {
      //Add Fields
      add_settings_field(
              'ad_breadcrumbs_' . $type . '_parent_id', // ID
              $type . __( ' Parent Page' ), // Title
              array( $this, '_adelphi_breadcrumbs_custom_posts_page_id_callback' ), // Callback
              $this->settings['menu_slug'], // Page
              'ad_breadcrumbs_custom_posts_section', // Section,
              array( 'post_type' => $type ) //Arguements
      );
    }
  }
  
  /**
   * Sanitize the data submitted by user
   * 
   * @param type $input
   * @return array
   */
  public function sanitize( $input ) {
    /*$new_input = array();
    if( isset( $input['ad_breadcrumbs_calendar_page'] ) ) {
      $new_input['ad_breadcrumbs_calendar_page'] = absint( $input['ad_breadcrumbs_calendar_page'] );
    }*/

    return $input;
  }
  
  /**
   * Callback function for settings field for options page
   */
  public function _adelphi_breadcrumbs_custom_posts_page_id_callback( $args ) {
    $post_type = $args['post_type'];
    $selected = Adelphi_Breadcrumbs_Api::get_post_parent( $post_type );
    $args = array(
        'name' => $this->settings['option_name'] . '[ad_breadcrumbs_' . $post_type . '_parent_id]',
        'id' => 'ad_breadcrumbs_' . $post_type . '_parent_id',
        'selected' => $selected
    );
    wp_dropdown_pages( $args );
  }
  
  /**
   * callback function for breadcrumbs calendar section
   */
  public function custom_posts_section_callback() {
    _e( 'Set Parent Pages for all custom post types:' );
  }
  
}
