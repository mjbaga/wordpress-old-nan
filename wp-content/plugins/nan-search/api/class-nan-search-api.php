<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class exposes all the api functions for these modules. 
 * They will all refer to other functions in other classes which will have the 
 * actual implementation.
 *
 * @author mjdbaga@gmail.com
 */
class NaN_Search_Api {


  public static function get_search_page() {
    $page_id = 0;
    $options = get_option( NAN_SEARCH_OPTIONS_NAME );
    if( !empty( $options ) && isset( $options['nan_search_page'] ) ) {
      $page_id = absint( $options['nan_search_page'] );
    }
    return $page_id;
  }
  
  public static function get_search_cx_id() {
    $cx_id = '';
    $options = get_option( NAN_SEARCH_OPTIONS_NAME );
    if( !empty( $options ) && isset( $options['nan_search_cx_id'] ) ) {
      $cx_id = sanitize_text_field( $options['nan_search_cx_id'] );
    }
    return $cx_id;
  }

  /**
   * Prints data based on template or returns the template with data values in 
   * a string.
   * 
   * @param string $slug The slug name for the generic template.
   * @param string $name The name of the specialized template.
   * @param array $data
   * @param boolean $echo
   */
  public static function render( $slug, $name = null, $data = array(), $var_name = 'data', $echo = true ) {
    if( $echo !== true ) {
      return NaN_Search_Common::render( $slug, $name, $data, $var_name, $echo );
    }
    NaN_Search_Common::render( $slug, $name, $data, $var_name, $echo );
  }

  /**
   * 
   * @param type $path
   * @param type $data
   */
  public static function parse( $slug, $name = null, $data = array(), $var_name = 'data' ) {
    return NaN_Search_Common::render( $slug, $name, $data, $var_name, false );
  }

}
