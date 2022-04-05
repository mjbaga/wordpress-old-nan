<?php

namespace NaNArticles;

use NaNArticles\Post\Post;
use NaNArticles\Page\Listing;
use NaNArticles\Api\Api;
use NaNArticles\Api\Query;

class Article
{
	public $settings;

	protected static $instance;

	/**
	 * Returns an instance of this class. An implementation of the singleton design pattern.
	 *
	 * @return   Article    A reference to an instance of this class.
	 * @since    0.1.0
	 */
	public static function get_instance() 
	{
		if( null == self::$instance ) {
			self::$instance = new Article();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->init_custom_posts();
		$this->init_widgets();
		$this->init_page_templates();
		$this->init_articles_api();
        $this->init_query_vars();
        $this->init_rewrite_tag();
        $this->init_rewrite_rule();
	}

	function init_custom_posts() 
	{
    	$article = Post::get_instance();
    }

    function init_widgets()
    {
    	add_action( 'widgets_init', array( $this, 'register_widgets' ) );
    }

    function register_widgets()
    {
    	register_widget( 'NaNArticles\\Widget\\HomepageWidget' );
    	add_action( 'init', array( '\\NaNArticles\\Widget\\HomepageWidget', 'register_fields' ) );
    	register_widget( 'NaNArticles\\Widget\\ArticlesWidget' );
    	add_action( 'init', array( '\\NaNArticles\\Widget\\ArticlesWidget', 'register_fields' ) );
    }

    function init_page_templates() 
    {
		$page_templates = Listing::get_instance();
    }

    function init_articles_api()
    {
    	add_action( 'rest_api_init', function () {

    	    register_rest_route( 'articles', 'latest',array(
    	        'methods'  => array('GET', 'POST'),
    	        'callback' => array('\\NaNArticles\\Article', 'get_latest_articles')
    	    ));

    	});
    }

    /**
     * This is returned from the API call for events
     * EDIT: Changed to static function for bugfix in UAT
     * 
     * @param  array $params
     * @return JSON response
     */
    public static function get_latest_articles($params)
    {
        $nextstart = absint($params['nextstart']);
        $toload = absint($params['toload']);
        $post_type = $params['posttype'];
        $age = isset($params['age']) ? $params['age'] : 'all';
        $cat = isset($params['category']) ? $params['category'] : 'all';
        $search = isset($params['search']) ? $params['search'] : '';

        $posts_per_page = 9;

        $toload += $posts_per_page;

        $articles = array();
        
        $query = Api::get_posts_data($posts_per_page, $post_type, $nextstart, $cat, $age, $search);

        global $post;

        foreach( $query['posts'] as $post ) {
            setup_postdata( $post );
            $articles[] = Query::get_thumbnail_details();
        }
        
        wp_reset_postdata();

        $data['listing'] = $articles;
        $result_text = '';

        if($search != '') {

            $res = $query['found_post'] == 1 ? ' result' : ' results';

            $result_text = $query['found_post'] . $res . ' found';

            if($cat != 'all') {
                $cat_post = get_post($cat);
                
                $result_text .= ' under "' . $cat_post->post_title . '"';
            }

            $data['result_text'] = $result_text;
        }

        $total_no_of_posts = $query['found_post'];

        $itemleft = $total_no_of_posts - $toload;
        
        if($itemleft < 0) $itemleft = 0;

        $data['itemleft'] = $itemleft;
        $data['nextstart'] = $toload + 1;
        $data['toload'] = $toload;

        $response = array();
        $response[] = $data;

        return $response;
    }

    function articles_rewrite_tag()
    {
        add_rewrite_tag('%cat%', '([a-zA-Z\d\-_+]+)');
    }

    function init_rewrite_tag()
    {
        add_action('init', array($this, 'articles_rewrite_tag'));
    }

    function articles_rewrite_rule() 
    {
        add_rewrite_rule( '^(\d*)/([a-zA-Z\d\-_+]+)?', 'index.php?page_id=$matches[1]&cat=$matches[2]','top' );
    }

    function init_rewrite_rule()
    {
        add_action('init', array($this, 'articles_rewrite_rule'), 10, 0);
        add_action( 'shutdown', 'flush_rewrite_rules');
    }

    function articles_register_query_vars( $vars ) 
    {
        $vars[] = 'cat';
        return $vars;
    }

    function init_query_vars() 
    {
        add_filter( 'query_vars', array($this, 'articles_register_query_vars') );
    }


}