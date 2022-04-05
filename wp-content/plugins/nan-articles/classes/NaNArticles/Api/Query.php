<?php

namespace NaNArticles\Api;

class Query
{

	public static function get_article_details()
	{
		$category = get_field( 'category' );

		$data = array();
		$data['title'] = apply_filters( 'the_title', get_the_title());
		$data['content'] = apply_filters( 'the_content', get_the_content());
        $data['image'] = get_the_post_thumbnail_url( null , 'full' );
		$data['thumbnail'] = get_the_post_thumbnail( null , 'medium' );
        $data['url'] = get_the_permalink();
	    $image_alt = get_the_post_thumbnail_caption(null);
        $data['category'] = $category->post_title;
        $data['references'] = get_field( 'references' );
        $data['breadcrumbs'] = nan_parse_sidebar('breadcrumbs_widget');
        $data['other_articles'] = nan_parse_sidebar('articles_widget');

        return $data;
	}

    public static function get_thumbnail_details()
    {
        $category = get_field( 'category' );

        $data = array();
        $data['title'] = apply_filters( 'the_title', get_the_title());
        $data['thumbnail'] = get_the_post_thumbnail( null , 'medium' );
        $data['url'] = get_the_permalink();
        $data['category'] = $category->post_title;

        return $data;
    }

	public static function get_most_read_article()
	{
		$args = array(
            'post_type' => 'nan-articles',
            'numberposts' => 1,
            'post_status' => 'publish',
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value',
            'order' => 'desc'
        );

        $post = get_posts($args);

        if(empty($post))
        	return array();

        $category = get_field('category', $post[0]->ID);

        $most_read = array();
        $most_read['title'] = $post[0]->post_title;
        $most_read['url'] = get_post_permalink($post[0]->ID);
        $most_read['thumbnail'] = get_the_post_thumbnail($post[0]->ID, 'large');
        $most_read['category'] = $category->post_title;

		return $most_read;
	}

    public static function get_latest_articles($n, $post_type)
    {
        $post_id = get_the_ID();

        $args = array(
            'post__not_in'=> array($post_id),
            'post_type' => $post_type,
            'numberposts' => $n,
            'post_status' => 'publish',
            'orderby' => 'publish_date',
            'order' => 'desc'
        );

        $posts = get_posts( $args );

        return $posts;
    }

    public static function get_posts_data($n, $post_type, $offset = 0, $cat = 'all', $age = 'all', $searchterm = '')
    {
        $args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'orderby' => 'publish_date',
            'order' => 'desc',
            'numberposts' => 9,
            'offset' => $offset,
            'posts_per_page' => $n
        );

        $meta_query = array();

        if($cat != 'all') {
            $cat_query = array();
            $cat_query['key'] = 'category';
            $cat_query['value'] = $cat;
            $cat_query['compare'] = '=';

            $meta_query[] = $cat_query;
        } 

        if($age != 'all') {
            $age_query = array();
            $age_query['key'] = 'age_group';
            $age_query['value'] = $age;
            $age_query['compare'] = 'LIKE';

            $meta_query[] = $age_query;
        }

        if($searchterm != '') {
            $args['s'] = $searchterm;
        }

        if($cat != 'all' && $age != 'all')
            $meta_query['relation'] = 'AND';

        $args['meta_query'] = $meta_query;

        $query = new \WP_Query($args);
        $posts = $query->get_posts();

        $results = array();
        $results['posts'] = $posts;
        $results['post_count'] = $query->post_count;
        $results['found_post'] = $query->found_posts;
        
        return $results;
    }

    public static function get_page_details()
    {
        global $wp_query;
        $categories = get_field('categories');

        $data = array();
        $data['title'] = apply_filters( 'the_title', get_the_title());
        $data['hero_heading'] = get_field('hero_heading');
        $data['hero_image'] = get_the_post_thumbnail( null , 'full' );
        $data['categories'] = self::get_article_categories($categories);
        $data['breadcrumbs'] = nan_parse_sidebar( 'breadcrumbs_widget' );
        $data['post_type'] = get_field('listing_type');
        $data['category'] = 'all';
        $data['url'] = get_permalink();
        $data['term'] = '';
        $data['cattext'] = 'Search all categories';

        if(isset($_GET['cat'])) {
            $data['category'] = urldecode($_GET['cat']);

            $getcat = get_post($data['category']);

            if($getcat) {
                $data['cattext'] = 'Search within ' . $getcat->post_title;
            }
        }

        if(isset($_GET['term'])) {
            $data['term'] = urldecode($_GET['term']);
        }
        
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

}