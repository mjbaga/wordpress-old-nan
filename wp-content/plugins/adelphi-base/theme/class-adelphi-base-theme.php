<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adelphi_Base_Theme
 *
 * @author mjdbaga@gmail.com
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Adelphi_Base_Theme {

  protected static $instance;

  /**
   * Returns an instance of this class. An implementation of the singleton design pattern.
   *
   * @return   Adelphi_Base_Theme    A reference to an instance of this class.
   * @since    0.1.0
   */
  public static function get_instance() {

    if( null == self::$instance ) {
      self::$instance = new Adelphi_Base_Theme();
    } // end if

    return self::$instance;
  }

  private function __construct() {
    $this->call_theme_setup_functions();
  }

  /**
   * enable all the theme related functionalities
   */
  private function call_theme_setup_functions() {
    add_action( 'after_setup_theme', array( $this, 'register_thumbnail' ) );
    add_action( 'after_setup_theme', array( $this, 'add_excerpt_support_for_pages' ) );
    add_action( 'after_setup_theme', array( $this, 'adelphi_image_sizes' ) );
    add_action( 'after_setup_theme', array( $this, 'add_theme_logo' ) );
    add_action( 'after_setup_theme', array( $this, 'add_title_support' ) );
    //add_action( 'after_setup_theme', array( $this, 'remove_excerpt_trim_filter' ) );
    add_filter( 'smilies_src', array( $this, 'adelphi_smilies_src') , 1, 10 );
  }

  /**
   * enable featured images support in theme if not enabled.
   */
  public function register_thumbnail() {
    add_theme_support( 'post-thumbnails' );
  }

  /**
   * Enables the Excerpt meta box in Page edit screen.
   */
  public function add_excerpt_support_for_pages() {
    add_post_type_support( 'page', 'excerpt' );
  }
  
  /**
   * Add title support
   */
  public function add_title_support() {
    add_theme_support( 'title-tag' );
  }
  
  /*
    * Enable support for custom logo.
    *
    * @since Twenty Fifteen 1.5
    */
  public function add_theme_logo() {
	add_theme_support( 'custom-logo', array(
		'height'      => 122,
		'width'       => 375,
		'flex-height' => true,
	) );
  }

  /*function remove_excerpt_trim_filter() {
    remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
  }*/

  function get_smiles_url( $img_src, $img ) {
    $s3 = get_option( 'tantan_wordpress_s3' );

    if( !is_array( $s3 ) || !isset( $s3['bucket'] ) || !isset( $s3['region'] ) ) {
      return $img_src;
    }

    $bucket = $s3['bucket'];
    $region = $s3['region'];

    $smiles_url = 'https://s3-' . $region . '.amazonaws.com/' . $bucket  . '/assets/adelphi/images/smilies/' . $img;
    return $smiles_url;
  }

  function adelphi_smilies_src( $img_src, $img, $siteurl ) {
    $smiles_url = $this->get_smiles_url( $img_src, $img );
    return $smiles_url;
  }
  
  function adelphi_image_sizes() {
    add_image_size( 'banner-image', 1350 );
  }

}
