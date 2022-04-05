<?php

namespace NaNTips\Api;

use NaNTips\Util\ViewRenderer;
use NaNTips\Api\Query;

class Api
{
	/**
	 * This function renders templates on specified path
	 * @param  string $template_path
	 * @param  array $data
	 */
	public static function render($template_path, $data)
	{
		$vr = new ViewRenderer(nan_tips_template_path($template_path), $data);
		$vr->render();
	}

	public static function get_page_details()
	{
		$listing = Query::get_page_details();
		return $listing;
	}

	/**
	 * Gets all the tips of a specified month
	 * @return array
	 */
	public static function get_all_tips_month($month, $year, $end_day = 0)
	{
		try{
		    $data = Query::get_all_tips_month($month, $year, $end_day);
		    return $data;
		} catch (Exception $ex) {
		    error_log( $ex->getMessage() );
		    return array();
		}
	}

	/**
	 * Gets all the tips of a specified month
	 * @return array
	 */
	public static function get_todays_tip()
	{
		try{
		    $data = Query::get_todays_tip();
		    return $data;
		} catch (Exception $ex) {
		    error_log( $ex->getMessage() );
		    return array();
		}
	}
}