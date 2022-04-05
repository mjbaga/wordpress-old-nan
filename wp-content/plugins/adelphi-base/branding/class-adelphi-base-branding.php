<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-adelphi-base-branding
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Base_Branding {

  protected static $instance;
  protected $branding_url;
  protected $branding_title;

  /**
   * Returns an instance of this class. An implementation of the singleton design pattern.
   *
   * @return   Adelphi_Base_Branding    A reference to an instance of this class.
   * @since    0.1.0
   */
  public static function get_instance() {

    if( null == self::$instance ) {
      self::$instance = new Adelphi_Base_Branding();
    } // end if

    return self::$instance;
  }

  function __construct() {
    $this->branding_url = 'http://adelphi.digital/';
    $this->branding_title = 'Adelphi Digital';
    // add_action( 'init', array( $this, 'register_branding_styles' ) );

    add_filter( 'login_headertitle', array( $this, 'get_branding_title' ) );
    add_filter( 'login_headerurl', array( $this, 'get_branding_url' ) );

    add_action( 'admin_bar_menu', array( $this, 'modify_admin_bar' ) );
  }

  function get_branding_url() {
    return $this->branding_url;
  }

  function get_branding_title() {
    return $this->branding_title;
  }

  function register_branding_styles() {
    $adelphi_base = Adelphi_Base_Api::adelphi_base();
    $settings = $adelphi_base->get_settings();
    wp_register_style( 'branding', $settings['dir'] . '/assets/css/branding.css' );
    wp_enqueue_style( 'branding' );
  }

  function modify_admin_bar( $wp_admin_bar ){
    $args = array(
        'id' => 'adelphi-logo',
        'title' => '<span class="adelphi about-icon"></span><span class="screen-reader-text">' . __( 'About Adelphi' ) . '</span>',
        'href'  => $this->branding_url,
        'meta' => array(
            'target' => '_blank'
        )
    );
    $wp_admin_bar->add_menu( $args );
  }

}
