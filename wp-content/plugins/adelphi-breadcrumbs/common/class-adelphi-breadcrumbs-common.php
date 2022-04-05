<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class has the implementation of all the common functions that can be 
 * used by classes across this module
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Breadcrumbs_Common {

  /**
   * Implemantation of this module's render function. Prints data based on 
   * template or returns the template with data values in a string.
   * 
   * @param string $path
   * @param array $data
   * @param boolean $echo
   * @return mixed
   */
  public static function render( $slug, $name = null, $data = array(), $var_name = 'data', $echo = true ) {
    ob_start();
    $templater = new Adelphi_Breadcrumbs_Common_Templater();
    $templater->set_template_data( $data, $var_name );
    $templater->get_template_part( $slug, $name );
    $templater->unset_template_data();

    $out = ob_get_clean();
    if( $echo === true ) {
      echo $out;
    } else {
      return $out;
    }
  }
  
  public static function get_post_parent( $post_type ) {
    $page_id = 0;
    $options = get_option( LP_BREADCRUMBS_OPTIONS_NAME );
    if( !empty( $options ) && isset( $options['ad_breadcrumbs_' . $post_type . '_parent_id'] ) ) {
      $page_id = absint( $options['ad_breadcrumbs_' . $post_type . '_parent_id'] );
    }
    return $page_id;
  }
  
  public static function get_breadcrumbs_ancestors( $post ) {
    if( is_int( $post ) ) {
      $post = get_post( $post );
    }
    $trail = array();
    switch( $post->post_type ) {
      case 'page':
        $trail = get_post_ancestors( $post );
        break;
      default:
        $parent_page = self::get_post_parent( $post->post_type );
        $trail = get_post_ancestors( $parent_page );
        array_unshift( $trail, $parent_page );
    }
    return $trail;
  }
  
  public static function get_breadcrumbs_trail( $post_id ) {
    $breadcrumbs_trail = array();
    $count = 0;
    if( ( is_single( $post_id ) || is_page( $post_id ) ) ) {
      $post = get_post( $post_id );
      $post_title = get_the_title( $post );

      $breadcrumbs_trail_ids = self::get_breadcrumbs_ancestors( $post );
      foreach( $breadcrumbs_trail_ids as $id ) {
        $breadcrumbs_trail[$count]['title'] = get_the_title( $id );
        $breadcrumbs_trail[$count]['link'] = get_permalink( $id );
        $count++;
      }
      //Prepend post/page title
      array_unshift( $breadcrumbs_trail, array( 'title' => $post_title ) );
    }
    else {
      $breadcrumbs_trail[$count]['title'] = wp_title( ' ', false );
      $count++;
    }
    $count++;
    //Add home link to end
    $breadcrumbs_trail[$count]['title'] = __( 'Home' );
    $breadcrumbs_trail[$count]['link'] = get_home_url();
        
    //Reverse the order so that home is first and actual post is last element
    $breadcrumbs_trail_reverse = array_reverse( $breadcrumbs_trail );
    
    return $breadcrumbs_trail_reverse;
  }

}
