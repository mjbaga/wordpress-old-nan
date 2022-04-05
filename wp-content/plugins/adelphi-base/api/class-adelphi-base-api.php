<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-adelphi-base-api
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Base_Api {

  public static function parse( $path, $data = array() ) {
    return self::render( $path, $data, false );
  }

  public static function render( $path, $data = array(), $echo = true ) {
    ob_start();
    extract( $data );
    require $path;

    $out = ob_get_clean();
    if( $echo === true ) {
      echo $out;
    } else {
      return $out;
    }
  }

  public static function adelphi_base() {
    global $adelphi_base;
    return $adelphi_base;
  }
  
  public static function get_adelphi_analytics_options() {
    $adelphi_options = get_option( AD_BASE_ANALYTICS_OPTIONS_NAME );
    return $adelphi_options;
  }

  public static function get_adelphi_addthis_options() {
    $adelphi_options = get_option( AD_BASE_ADDTHIS_OPTIONS_NAME );
    return $adelphi_options;
  }
  
  public static function get_analytics_id() {
    $options = self::get_adelphi_analytics_options();
    $analytics_id = '';
    if( !empty( $options['ad_base_analytics_id'] ) ) {
      $analytics_id = $options['ad_base_analytics_id'];
    }
    return $analytics_id;
  }

  public static function get_addthis_id() {
    $options = self::get_adelphi_addthis_options();
    $addthis_id = '';
    if( !empty( $options['ad_base_addthis_id'] ) ) {
      $addthis_id = $options['ad_base_addthis_id'];
    }
    return $addthis_id;
  }

}
