<?php

namespace NaNArticles\Post;

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
        $this->slug = 'nan-articles';
        $this->label = __( 'Articles' );

        add_action( 'init', array( $this, 'init_post' ) );
        add_action( 'init', array( $this, 'register_fields' ) );
        add_action( 'init', array( $this, 'init_article_template' ) );
    }

	function init_post() 
    {
        $args = array(
            'label' => $this->label,
            'public' => TRUE,
            'rewrite' => array( 'slug' => 'articles' ),
            'menu_icon' => 'dashicons-media-document',
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt'
            ),
            'taxonomies' => array('post_tag')
        );
        register_post_type( $this->slug, $args );
    }

    /**
    * Initiate the single template for article post
    */
    function init_article_template() {
        //add template
        add_filter( 'single_template', array( $this, '_nan_article_single_template' ), 10, 1 );
    }

    /**
    * Callback for single template filter for article post type
    * 
    * @param string $single_template
    * @return string
    */
    function _nan_article_single_template( $single_template ) {
        $object = get_queried_object();

        if( $object->post_type != $this->slug ) {
            return $single_template;
        }

        $single_template = NAN_ARTICLES_PLUGIN_DIR . '/templates/Post/single-article.php';
        return $single_template;
    }

    function register_fields() 
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_5a815fbf3f523',
            'title' => 'Articles',
            'fields' => array(
                array(
                    'key' => 'field_5a815fc3c7ff6',
                    'label' => 'Category',
                    'name' => 'category',
                    'type' => 'post_object',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                        0 => 'nan-category',
                    ),
                    'taxonomy' => array(
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'return_format' => 'object',
                    'ui' => 1,
                ),
                array(
                    'key' => 'field_5a815febc7ff7',
                    'label' => 'References',
                    'name' => 'references',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_5a8cca1fa496e',
                    'label' => 'Age Group',
                    'name' => 'age_group',
                    'type' => 'checkbox',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'preschool' => 'Preschool',
                        'preteen' => 'Pre-teens',
                        'teens' => 'Teens',
                    ),
                    'allow_custom' => 0,
                    'save_custom' => 0,
                    'default_value' => array(
                    ),
                    'layout' => 'vertical',
                    'toggle' => 0,
                    'return_format' => 'value',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'nan-articles',
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
