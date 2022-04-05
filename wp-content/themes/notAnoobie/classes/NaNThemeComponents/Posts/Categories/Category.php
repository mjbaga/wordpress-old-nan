<?php

namespace NaNThemeComponents\Posts\Categories;

class Category
{
	public static function register_fields()
	{
		if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5a7bf2b479ba5',
			'title' => 'Categories',
			'fields' => array(
				array(
					'key' => 'field_5a7bf2d9dd1cc',
					'label' => 'Icon',
					'name' => 'icon',
					'type' => 'select',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'icon-gaming' => 'Gaming',
						'icon-cyberbully' => 'Cyber Bullying',
						'icon-socialmedia' => 'Social Media',
						'icon-inappcontent' => 'Inappropriate Content',
						'icon-screentime' => 'Screen Time',
						'icon-onlineprivacy' => 'Online Privacy',
						'icon-online-content' => 'Online Content',
					),
					'default_value' => array(
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'nan-category',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => array(
				0 => 'the_content',
				1 => 'featured_image',
			),
			'active' => 1,
			'description' => '',
		));

		endif;
	}

	public static function init_post() {
        $args = array(
            'label' => 'Category',
            'public' => TRUE,
            'rewrite' => array( 'slug' => 'nan-category' ),
            'menu_icon' => 'dashicons-networking',
            'supports' => array(
                'title',
                'thumbnail'
            )
        );
        
        register_post_type( 'nan-category', $args );
    }
}