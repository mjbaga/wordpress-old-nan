<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Adelphi_Breadcrumbs_Widget to display breadcrumbs
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Breadcrumbs_Widget extends WP_Widget {
  
  protected $widget_slug;
  protected $widget_template_slug;
  protected $form_template_path;

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    $this->widget_slug = 'ad_breadcrumbs_widget';
    $this->widget_template_slug = 'breadcrumbs';
    parent::__construct(
            $this->widget_slug, // Base ID
            __( 'Breadcrumbs Widget', $this->widget_slug ), // Name
            array( 'description' => __( 'A widget to display breadcrumbs.', $this->widget_slug ), ) // Args
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
   * @return String html for all sponsors to be rendered in footer. Returns from cache if cache exists.
   */
  public function parse_widget( $instance ) {
    global $wp_query;

    $data = array();
    $queried_object = get_queried_object();

    if ( !$queried_object ) {
      $data['breadcrumbs'] = Adelphi_Breadcrumbs_Api::get_breadcrumbs_trail( null );
    }
    else{
    
      $post_id = $queried_object->ID;

      $data['breadcrumbs'] = Adelphi_Breadcrumbs_Api::get_breadcrumbs_trail( $post_id );
    
    }
    
    $html = Adelphi_Breadcrumbs_Api::parse( $this->widget_template_slug, null, $data );

    return $html;
  }
  
}
