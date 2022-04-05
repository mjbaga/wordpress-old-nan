<?php

namespace NaNThemeComponents\Posts\PartnerLogos;

class PartnerLogo
{
	public static function register_fields()
	{
		if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5a250a04e3abe',
			'title' => 'Partner Logo',
			'fields' => array(
				array(
					'key' => 'field_5a250a10491f9',
					'label' => 'Link',
					'name' => 'link',
					'type' => 'url',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'nan-partner-logo',
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

	public static function init_post() {
        $args = array(
            'label' => 'Partner Logos',
            'public' => TRUE,
            'rewrite' => array( 'slug' => 'nan-partner-logo' ),
            'menu_icon' => 'dashicons-format-gallery',
            'supports' => array(
                'title',
                'thumbnail'
            )
        );
        register_post_type( 'nan-partner-logo', $args );
        
    }

}