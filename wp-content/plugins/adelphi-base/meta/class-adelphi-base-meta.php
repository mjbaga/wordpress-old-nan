<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CMS Settings for Adelphi_Base_Meta plugin
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Base_Meta {
  
  protected static $instance;
  private $meta_template_path;
  private $facebook_meta_template_path;
  private $twitter_meta_template_path;
  
  /**
   * Returns an instance of this class. An implementation of the singleton design pattern.
   *
   * @return   Adelphi_Base_Copyright    A reference to an instance of this class.
   * @since    0.1.0
   */
  public static function get_instance() {

    if( null == self::$instance ) {
      self::$instance = new Adelphi_Base_Meta();
    } // end if

    return self::$instance;
  }
  
  private function __construct() {
    $this->meta_template_path = dirname( __FILE__ ) . '/templates/meta.tpl.php';
    $this->facebook_meta_template_path = dirname( __FILE__ ) . '/templates/facebook_meta.tpl.php';
    $this->twitter_meta_template_path = dirname( __FILE__ ) . '/templates/twitter_meta.tpl.php';
    $this->init_head();
  }
  
  private function init_head() {
    add_action( 'wp_head', array( $this, 'add_all_meta' ) );
  }
  
  public function add_all_meta() {
    global $wp_query;
    
    $data = array();
    while( have_posts() ){
      the_post();
      $description = apply_filters( 'the_excerpt', get_the_excerpt() );
      $data['title'] = get_the_title();
      $data['description'] = strip_tags( $description );
      $data['image'] = get_the_post_thumbnail_url( 'null', 'full' );
    }
    $meta_data = $this->get_fallback_data( $data );

    $this->add_meta( $meta_data );
    $this->add_facebook_meta( $meta_data );
    $this->add_twitter_meta( $meta_data );
  }
  
  private function add_meta( $data ) {
    require_once $this->meta_template_path;
  }
  
  private function add_facebook_meta( $data ) {
    require_once $this->facebook_meta_template_path;
  }
  
  private function add_twitter_meta( $data ) {
    require_once $this->twitter_meta_template_path;
  }
  
  private function get_fallback_data( $data ) {
    if( empty( $data['title'] ) ) {
      $data['title'] = get_bloginfo( 'name' );
    }
    if( empty( $data['description'] ) ) {
      $data['description'] = get_bloginfo( 'description' );
    }
    $data['url'] = get_the_permalink();
    $data['site_name'] = get_bloginfo( 'name' );
    
    return $data;
  }
  
}
