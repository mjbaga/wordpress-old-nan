<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CMS Settings for Adelphi_Base_Copyright plugin
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Base_Copyright {
  
  protected static $instance;
  private $template_path;
  
  /**
   * Returns an instance of this class. An implementation of the singleton design pattern.
   *
   * @return   Adelphi_Base_Copyright    A reference to an instance of this class.
   * @since    0.1.0
   */
  public static function get_instance() {

    if( null == self::$instance ) {
      self::$instance = new Adelphi_Base_Copyright();
    } // end if

    return self::$instance;
  }
  
  private function __construct() {
    $this->template_path = AD_BASE_PLUGIN_DIR . '/copyright/templates';
    $this->template_name = 'copyright_settings.tpl.php';
    $this->init_widgets();
  }
  
  private function init_widgets() {
    add_action( 'widgets_init', array( $this, 'register_widgets' ) );
  }
  
  public function register_widgets() {
    register_widget( 'Adelphi_Base_Copyright_Widget' );
  }
}
