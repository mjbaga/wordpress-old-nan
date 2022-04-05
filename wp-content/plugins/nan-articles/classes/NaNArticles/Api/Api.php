<?php

namespace NaNArticles\Api;

use NaNArticles\Api\Query;
use Util\ViewRenderer;

class Api
{
	/**
	 * This function renders templates on specified path
	 * @param  string $template_path
	 * @param  array $data
	 */
	public static function render($template_path, $data)
	{
		$vr = new ViewRenderer(nan_articles_template_path($template_path), $data);
		$vr->render();
	}

	public static function get_article_details()
	{
		try{
		    $data = Query::get_article_details();
		    return $data;
		} catch (Exception $ex) {
		    error_log( $ex->getMessage() );
		    return array();
		}
	}

	public static function get_most_read_article()
	{
		try{
		    $data = Query::get_most_read_article();
		    return $data;
		} catch (Exception $ex) {
		    error_log( $ex->getMessage() );
		    return array();
		}
	}

	public static function get_latest_articles($n, $post_type)
	{
		try{
		    $data = Query::get_latest_articles($n, $post_type);
		    return $data;
		} catch (Exception $ex) {
		    error_log( $ex->getMessage() );
		    return array();
		}
	}

	public static function get_page_details()
	{
		$listing = Query::get_page_details();
		return $listing;
	}

	public static function get_posts_data($n, $post_type, $offset = 0, $cat = 'all', $age = 'all', $searchterm = '')
	{
		try{
		    $data = Query::get_posts_data($n, $post_type, $offset, $cat, $age, $searchterm);
		    return $data;
		} catch (Exception $ex) {
		    error_log( $ex->getMessage() );
		    return array();
		}
	}
}