<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * NaN_Subscribe_Widget to display subscribe
 *
 * @author mjdbaga@gmail.com
 */
class NaN_Search_Widget extends WP_Widget {
  
  protected $widget_slug;
  protected $widget_template_slug;
  protected $widget_template_name;
  protected $form_template_path;

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    $this->widget_slug = 'nan_search_widget';
    $this->widget_template_slug = 'widget';
    $this->widget_template_name = 'search-form';
    add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
    parent::__construct(
            $this->widget_slug, // Base ID
            __( 'Search Widget', $this->widget_slug ), // Name
            array( 'description' => __( 'A widget to display search.', $this->widget_slug ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    
    echo $args['before_widget'];

    echo $this->parse_widget( $instance );

    echo $args['after_widget'];
  }

  /**
   *
   * @param type $instance instance of this widget specified in widget area.
   * @return String html for all the sideposts to be rendered. Returns from cache if cache exists.
   */
  public function parse_widget( $instance ) {
    $cache_key = $this->widget_slug . '_' . $this->id;
    $cache = get_transient( $cache_key );
    $cache_time = NAN_SEARCH_CACHE_TIME; 

    if( $cache ) {
      return $cache;
    }

    $search_page_id = NaN_Search_Api::get_search_page();
    
    $data = array();
    $data['search_page'] = get_permalink( $search_page_id );

    $html = NaN_Search_Api::parse( $this->widget_template_slug, $this->widget_template_name, $data );
    set_transient( $cache_key, $html, $cache_time );
    return $html;
  }

  
  public function flush_widget_cache() {
    $cache_key = $this->widget_slug . '_' . $this->id;
    delete_transient( $cache_key );
  }
  
}
