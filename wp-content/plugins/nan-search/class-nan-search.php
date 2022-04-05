<?php

/*
	Plugin Name: notAnoobie Search Plugin
	Description: Bespoke Plugin to create search functionalities to display in homepage
	Version: 0.1.0
	Author: Adelphi Digital
	Author URI: http://www.adelphi.digital/
 */
require_once dirname( __FILE__ ) . '/includes/plugin-config.php';
require_once dirname( __FILE__ ) . '/vendor/autoload.php';
if( !class_exists( 'Page_Template_Plugin' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/tommcfarlin/page-template-example/class-page-template-example.php';
}

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( !class_exists( 'NaN_Search' ) ) :

	class NaN_Search {

		public $settings;
		protected static $instance;

		/**
		 * Returns an instance of this class. An implementation of the singleton design pattern.
		 *
		 * @return   NaN_Search    A reference to an instance of this class.
		 * @since    0.1.0
		 */
		public static function get_instance() {

			if( null == self::$instance ) {
				self::$instance = new NaN_Search();
			} // end if

			return self::$instance;
		}

		private function __construct() {
			$this->settings = array(
					'prefix' => 'nan_search_',
					// urls
					'basename' => plugin_basename( __FILE__ ),
					'path' => dirname( __FILE__ ),
					'dir' => plugin_dir_url( __FILE__ ),
			);
			spl_autoload_register( array( $this, 'register_autoloader' ) );

			$this->init_custom_admin_settings();
			$this->init_page_templates();
			$this->init_widgets();
		}

		/**
		 * Spl autoloader function. If classname is nan_search_<folder1>_<folder2>,
		 * it will try to include php file named class-nan-search-<folder1>-<folder2>
		 * located in <pathtpplugin>/<folder1>/<folder2>.
		 *
		 * @param String $class
		 * @return boolean
		 */
		function register_autoloader( $class ) {
			$lower = strtolower( $class );
			if( strpos( $lower, $this->settings['prefix'] ) !== 0 ) {
				return;
			}

			$str_folder = str_replace( $this->settings['prefix'], '', $lower );
			$directories = explode( '_', $str_folder );
			$relative_path_to_folder = implode( '/', $directories );
			$file = 'class-nan-search-' . implode( '-', $directories );
			$path_to_file = $this->settings['path'] . '/' . $relative_path_to_folder . '/' . $file . '.php';

			if( file_exists( $path_to_file ) && !class_exists( $class ) ) {
				require_once( $path_to_file );
			}
		}

		private function init_widgets() {
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		}

		function register_widgets() {
			unregister_widget('WP_Widget_Search'); //unregister wordpress default search widget
			register_widget( 'NaN_Search_Widget' );
		}
		
		function init_page_templates() {
			$page_templates = NaN_Search_Pages_Search::get_instance();
		}
		
		function init_custom_admin_settings() {
			$admin_settings = NaN_Search_Admin::get_instance();
		}

	}

endif;

$nan_search = NaN_Search::get_instance();
