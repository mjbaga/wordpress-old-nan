<?php

namespace NaNThemeComponents\Pages;

class Homepage
{

	public static function get_data() 
    {
    	$banner = get_field('hero_banner');
    	$categories = get_field('article_categories');
        $stories = get_field('stories');
        $link = get_field('all_stories_link');

    	$data = array();
    	$data['banner'] = $banner['url'];
    	$data['banner_alt'] = $banner['alt'] != '' ? $banner['alt'] : $banner['title'];
    	$data['banner_text'] = get_field('banner_text');
    	$data['articles_heading'] = get_field('articles_heading');
    	$data['articles_text'] = get_field('articles_text');
    	$data['article_categories'] = self::get_article_categories($categories);
        $data['articles_page'] = get_field('articles_page');
    	$data['discoverables'] = get_field('discoverables');
    	$data['stories'] = self::get_stories_data($stories);
        $data['tip_of_the_day'] = nan_parse_sidebar('hp_tip_widget');
        $data['articles'] = nan_parse_sidebar('hp_articles_widget');
        $data['all_stories_link'] = $link;

    	return $data;
    }

    private static function get_article_categories($categories)
    {
    	if( empty( $categories ) ) {
    		return array();
    	}

    	global $post;

    	$cat_links = array();
    	foreach( $categories as $post ) {
    		setup_postdata( $post );
    		$item = array();
            $item['id'] = get_the_ID();
    		$item['title'] = get_the_title();
    		$item['icon'] = get_field('icon');
    		$item['filter_value'] = get_field('filter_value');
    		$cat_links[] = $item;
    	}
    	wp_reset_postdata();
    	return $cat_links;
    }

    private static function get_stories_data($stories)
    {
        if( empty( $stories ) ) {
            return array();
        }

        global $post;

        $data = array();

        foreach($stories as $post) {
            setup_postdata( $post );

            $item = array();
            $item['title'] = get_the_title();
            $item['excerpt'] = get_the_excerpt();
            $item['url'] = get_the_permalink();
            $item['thumbnail'] = get_the_post_thumbnail( null , 'medium' );
            $data[] = $item;
        }

        wp_reset_postdata();
        return $data;
    }

    public static function register_fields()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_5a7c0f98484a3',
            'title' => 'Homepage',
            'fields' => array(
                array(
                    'key' => 'field_5a7d4dc44d7dd',
                    'label' => 'Hero Banner',
                    'name' => 'hero_banner',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_5a7d4b0e63138',
                    'label' => 'Banner Text',
                    'name' => 'banner_text',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
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
                array(
                    'key' => 'field_5a7d4b2363139',
                    'label' => 'Articles Heading',
                    'name' => 'articles_heading',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
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
                array(
                    'key' => 'field_5a7d4b3a6313a',
                    'label' => 'Articles Text',
                    'name' => 'articles_text',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
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
                array(
                    'key' => 'field_5a7d4b486313b',
                    'label' => 'Article Categories',
                    'name' => 'article_categories',
                    'type' => 'relationship',
                    'instructions' => '',
                    'required' => 0,
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
                    'filters' => array(
                        0 => 'post_type',
                    ),
                    'elements' => '',
                    'min' => '',
                    'max' => '',
                    'return_format' => 'object',
                ),
                array(
                    'key' => 'field_5a94f21153e68',
                    'label' => 'Articles Page',
                    'name' => 'articles_page',
                    'type' => 'page_link',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                        0 => 'page',
                    ),
                    'taxonomy' => array(
                    ),
                    'allow_null' => 0,
                    'allow_archives' => 1,
                    'multiple' => 0,
                ),
                array(
                    'key' => 'field_5a7d4b906313c',
                    'label' => 'Discoverables',
                    'name' => 'discoverables',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 3,
                    'layout' => 'row',
                    'button_label' => '',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_5a7d4bb16313d',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
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
                        array(
                            'key' => 'field_5a7d4bbe6313e',
                            'label' => 'Image',
                            'name' => 'image',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                        ),
                        array(
                            'key' => 'field_5a7d4bc86313f',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
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
                        array(
                            'key' => 'field_5a7d4bd063140',
                            'label' => 'Link',
                            'name' => 'link',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 0,
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
                ),
                array(
                    'key' => 'field_5a7d4be263141',
                    'label' => 'Stories',
                    'name' => 'stories',
                    'type' => 'relationship',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                        0 => 'nan-stories',
                    ),
                    'taxonomy' => array(
                    ),
                    'filters' => array(
                        0 => 'post_type',
                    ),
                    'elements' => '',
                    'min' => '',
                    'max' => 5,
                    'return_format' => 'object',
                ),
                array(
                    'key' => 'field_5a8a7455f228d',
                    'label' => 'All Stories Link',
                    'name' => 'all_stories_link',
                    'type' => 'page_link',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                        0 => 'page',
                    ),
                    'taxonomy' => array(
                    ),
                    'allow_null' => 0,
                    'allow_archives' => 1,
                    'multiple' => 0,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-templates/template-homepage.php',
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

    private static function get_post_data( $posts )
    {
    	global $post;
    	
    	$post_data = array();
    	foreach( $posts as $post ) {
    		setup_postdata( $post );
    		$excerpt = get_the_excerpt();
    		$item = array();
    		$item['title'] = get_the_title();
    		$item['image'] = get_the_post_thumbnail( null, 'thumbnail' );
    		$item['description'] = apply_filters( 'the_excerpt', $excerpt );
    		$post_data[] = $item;
    	}
    	wp_reset_postdata();
    	return $post_data;
    }

    private static function get_discoverable_data()
    {

    }

}