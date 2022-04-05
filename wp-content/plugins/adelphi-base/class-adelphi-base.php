<?php

/*
  Plugin Name: Adelphi Base Plugin
  Description: Base functionalities for Adelphi Wordpress Projects
  Version: 0.1.0
  Author: Adelphi Digital
  Author URI: http://adelphi.digital/
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once dirname( __FILE__ ) . '/includes/plugin-config.php';

if( !class_exists( 'adelphi_base' ) ) :

  class Adelphi_Base {

    protected static $instance;
    public $settings;

    /**
     * Returns an instance of this class. An implementation of the singleton design pattern.
     *
     * @return   Adelphi_Base    A reference to an instance of this class.
     * @since    0.1.0
     */
    public static function get_instance() {

      if( null == self::$instance ) {
        self::$instance = new Adelphi_Base();
      } // end if

      return self::$instance;
    }

    private function __construct() {
      $this->settings = array(
          // basic
          'slug' => __( 'adelphi_base', 'adelphi_base' ),
          'name' => __( 'Adelphi Base Plugin', 'adelphi_base' ),
          'version' => '0.1.0',
          // urls
          'basename' => plugin_basename( __FILE__ ),
          'path' => plugin_dir_path( __FILE__ ),
          'dir' => plugin_dir_url( __FILE__ ),
      );
      spl_autoload_register( array( $this, 'register_autoloader' ) );
      $this->include_submodules();
      // add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_jquery' ), 1 );
    }

    function register_autoloader( $class ) {
      $lower = strtolower( $class );
      if( strpos( $lower, $this->settings['slug'] ) !== 0 ) {
        return false;
      }
      $str_folder = str_replace( $this->settings['slug'] . '_', '', $lower );
      $directories = explode( '_', $str_folder );
      $relative_path_to_folder = implode( '/', $directories );
      $file = 'class-adelphi-base-' . implode( '-', $directories );
      $path_to_file = $this->settings['path'] . '/' . $relative_path_to_folder . '/' . $file . '.php';

      if( file_exists( $path_to_file ) && !class_exists( $class ) ) {
        require_once( $path_to_file );
      }
    }

    function include_submodules() {
      $init_copyright = Adelphi_Base_Copyright::get_instance();
      $init_analytics = Adelphi_Base_Analytics::get_instance();
      $init_theme = Adelphi_Base_Theme::get_instance();
      $init_branding = Adelphi_Base_Branding::get_instance();
      $init_meta = Adelphi_Base_Meta::get_instance();
      $init_addthis = Adelphi_Base_Addthis::get_instance();
    }
    
    function enqueue_jquery() {
      // Deregister the included library
      wp_deregister_script( 'jquery' );
      
      //Register jquery based on current this module
      wp_register_script( 'jquery', plugins_url( '/assets/js/vendor/jquery.min.js', __FILE__ ) );
    }

    public function get_settings() {
      return $this->settings;
    }

  }

  global $adelphi_base;
  $adelphi_base = Adelphi_Base::get_instance();

  endif;
