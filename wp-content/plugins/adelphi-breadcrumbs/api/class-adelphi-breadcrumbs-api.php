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
class Adelphi_Breadcrumbs_Api {

  /**
   * This function returns all data belonging to the post with specified breadcrumbs_id
   * 
   * @param int $breadcrumbs_id
   * @return array
   */
  public static function get_all_breadcrumbs_in_date_range( $start_date, $end_date ) {
    try {
      $data = Adelphi_Breadcrumbs_Views_Breadcrumbs::get_all_breadcrumbs_in_date_range( $start_date, $end_date );
      return $data;
    } catch( Exception $ex ) {
      error_log( $ex->getMessage() );
      return array();
    }
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
      return Adelphi_Breadcrumbs_Common::render( $slug, $name, $data, $var_name, $echo );
    }
    Adelphi_Breadcrumbs_Common::render( $slug, $name, $data, $var_name, $echo );
  }

  /**
   * 
   * @param type $path
   * @param type $data
   */
  public static function parse( $slug, $name = null, $data = array(), $var_name = 'data' ) {
    return Adelphi_Breadcrumbs_Common::render( $slug, $name, $data, $var_name, false );
  }

  public static function get_post_parent( $post_type ) {
    return Adelphi_Breadcrumbs_Common::get_post_parent( $post_type );
  }
  
  public static function get_breadcrumbs_trail( $post_id ) {
    return Adelphi_Breadcrumbs_Common::get_breadcrumbs_trail( $post_id );
  }

}
