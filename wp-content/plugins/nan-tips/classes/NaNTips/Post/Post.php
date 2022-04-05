<?php

namespace NaNTips\Post;

class Post
{

    private static $instance;
    private $slug;
    private $label;

    /**
    * Returns an instance of this class. An implementation of the singleton design pattern.
    *
    * @return   Post    A reference to an instance of this class.
    * @since    1.0.0
    */
    public static function get_instance() 
    {
        if( null == self::$instance ) {
            self::$instance = new Post();
        } // end if

        return self::$instance;
    }

    function __construct() 
    {
        $this->slug = 'nan-tips';
        $this->label = __( 'Tips of the Day' );

        add_action( 'init', array( $this, 'init_post' ) );
        add_action( 'init', array( $this, 'register_fields' ) );
        // add_filter( 'the_title', array( $this, 'set_default_title') );
        // add_action('save_post', array( $this, 'save_tip_post') );
    }

	function init_post() 
    {
        $args = array(
            'label' => $this->label,
            'public' => TRUE,
            'rewrite' => array( 'slug' => 'tips' ),
            'menu_icon' => 'dashicons-lightbulb',
            'supports' => array(
                'title',
                'editor'
            )
        );
        register_post_type( $this->slug, $args );
    }

    function save_tip_post()
    {
        apply_filters( 'the_title', 'filter_me' );
        die('test');
    }

    
    function set_default_title( $title, $id ) 
    {
        $latest_tip_date = $this->get_latest_tip_date();

        $title = 'Tip - ' . $latest_tip_date;

        return $title;
    }

    function get_latest_tip_date()
    {
        $latest_post = self::query_latest_tip();

        global $post;
        $latest_tip_date = null;

        foreach($latest_post as $post) {
            setup_postdata($post);
            $latest_tip_date = get_field('tip_date', false);
        }

        return $latest_tip_date;
    }

    public static function query_latest_tip()
    {
        $args = array(
            'post_type' => 'nan-tips',
            'numberposts' => 1,
            'post_status' => 'publish',
            'meta_key' => 'tip_date',
            'orderby' => 'meta_value',
            'order' => 'desc'
        );

        $latest_post = get_posts($args);

        return $latest_post;
    }

    function register_fields() 
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_5a7d1a0e3af5b',
            'title' => 'Tips',
            'fields' => array(
                array(
                    'key' => 'field_5a7d2e4f27a4a',
                    'label' => 'Tip Date',
                    'name' => 'tip_date',
                    'type' => 'date_picker',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'd/m/Y',
                    'return_format' => 'd/m/Y',
                    'first_day' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'nan-tips',
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

        endif;

    }

}
