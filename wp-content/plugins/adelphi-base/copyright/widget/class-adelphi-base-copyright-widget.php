<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Adelphi_Base_Copyright_Widget to display copyright information
 *
 * @author mjdbaga@gmail.com
 */
class Adelphi_Base_Copyright_Widget extends WP_Widget {
  
  protected $widget_slug;
  protected $widget_template_path;
  protected $form_template_path;

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    $this->widget_slug = 'ad_copyright_widget';
    $this->widget_template_path = AD_BASE_PLUGIN_DIR . '/copyright/templates/copyright.tpl.php';
    parent::__construct(
            $this->widget_slug, // Base ID
            __( 'Copyright Widget', $this->widget_slug ), // Name
            array( 'description' => __( 'A widget to display copyright.', $this->widget_slug ), ) // Args
    );
    add_action( 'init', array( $this, 'register_fields' ) );
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

    $copyright_year = date( 'Y' );
    $copyright = get_field( 'copyright_text', 'widget_' . $this->id );
    
    ob_start();
    require_once $this->widget_template_path;
    $html = ob_get_clean();

    return $html;
  }
  
  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
  }
  
  public static function register_fields() {
    if( function_exists('acf_add_local_field_group') ) {

      acf_add_local_field_group(array (
              'key' => 'group_591e92076b7d8',
              'title' => 'Widget - Copyright',
              'fields' => array (
                      array (
                              'key' => 'field_591e922a794e1',
                              'label' => 'Copyright Text',
                              'name' => 'copyright_text',
                              'type' => 'text',
                              'instructions' => '',
                              'required' => 0,
                              'conditional_logic' => 0,
                              'wrapper' => array (
                                      'width' => '',
                                      'class' => '',
                                      'id' => '',
                              ),
                              'default_value' => '',
                              'placeholder' => '',
                              'prepend' => '',
                              'append' => '',
                              'maxlength' => '',
                      ),
              ),
              'location' => array (
                      array (
                              array (
                                      'param' => 'widget',
                                      'operator' => '==',
                                      'value' => 'ad_copyright_widget',
                              ),
                      ),
              ),
              'menu_order' => 0,
              'position' => 'normal',
              'style' => 'default',
              'label_placement' => 'top',
              'instruction_placement' => 'label',
              'hide_on_screen' => '',
              'active' => 1,
              'description' => '',
      ));

    }
  }
  
}
