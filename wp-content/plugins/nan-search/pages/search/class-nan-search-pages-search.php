<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class extends default page template example by tomcarlin
 *
 * @author mjdbaga@gmail.com
 */
if( !class_exists( 'NaN_Search_Pages_Search' ) ) :

  class NaN_Search_Pages_Search extends Page_Template_Plugin
  {

    /**
     * The array of page templates that this plugin tracks.
     *
     * @var      array
     */
    protected $templates;
    
    private static $instance;

    /**
     * Returns an instance of this class. An implementation of the singleton design pattern.
     *
     * @return   NaN_Search_Pages_Search    A reference to an instance of this class.
     */
    public static function get_instance() {
      if( null == self::$instance ) {
        self::$instance = new NaN_Search_Pages_Search();
      } // end if
      return self::$instance;
    }

    private function __construct() {
      $this->templates = array();
      $this->plugin_slug = 'nan_search';

      // Grab the translations for the plugin
      add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
      
      // Add a filter to the attributes metabox to inject template into the cache.
      if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
          // 4.6 and older
          add_filter('page_attributes_dropdown_pages_args', array( $this, 'register_project_templates' ));
      } else {
         // Add a filter to the wp 4.7 version attributes metabox
         add_filter('theme_page_templates', array( $this, 'add_new_template' ));
      }

      // Add a filter to the save post in order to inject out template into the page cache
      add_filter( 'wp_insert_post_data', array( $this, 'register_project_templates' ) );
      // Add a filter to the template include in order to determine if the page has our template assigned and return it's path
      add_filter( 'template_include', array( $this, 'view_project_template' ) );
      // Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
      register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
      // Add your templates to this array.
      $this->templates = array(
          'page-templates/template-search.php' => __( 'Search Page Template', $this->plugin_slug ),
      );
      // adding support for theme templates to be merged and shown in dropdown
      $templates = wp_get_theme()->get_page_templates();
      $templates = array_merge( $templates, $this->templates );
    }

    /**
    * Adds our template to the page dropdown for v4.7+
    *
    */
    public function add_new_template( $posts_templates ) {
      $posts_templates = array_merge( $posts_templates, $this->templates );
      return $posts_templates;
    }
    
    public function view_project_template( $template ) {

      global $post;

      // If no posts found, return to
      // avoid "Trying to get property of non-object" error
      if ( !isset( $post ) ) return $template;

      if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
              return $template;
      } // end if

      $file = NAN_SEARCH_PLUGIN_DIR . '/' . get_post_meta( $post->ID, '_wp_page_template', true );

      // Just to be safe, we check if the file exist first
      if( file_exists( $file ) ) {
              return $file;
      } // end if

      return $template;

    }

  }

  

endif;