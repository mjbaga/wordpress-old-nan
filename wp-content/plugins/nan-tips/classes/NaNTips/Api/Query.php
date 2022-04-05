<?php

namespace NaNTips\Api;

use Carbon\Carbon;

class Query
{

	public static function get_page_details()
	{
		$now = Carbon::now();
        $current_day = $now->format('j');
        $current_month = $now->format('n');
        $current_year = $now->format('Y');

        $prev_month_date = $now->copy()->subMonth();

		$data = array();
		$data['title'] = apply_filters( 'the_title', get_the_title());
		$data['hero_heading'] = get_field('hero_heading');
        $data['hero_image'] = get_the_post_thumbnail( null , 'full' );
        $tips = self::get_all_tips_month($current_month, $current_year, $current_day);
        $data['prev_month'] = $prev_month_date->format('n');
        $data['prev_year'] = $prev_month_date->format('Y');
        $data['tips_this_month'] = self::process_tips($tips);

        return $data;
	}

    public static function get_prevmonth_tips($params)
    {
        $prevmonth = absint($params['prevmonth']);
        $prevyear = absint($params['prevyear']);

        $posts = self::get_all_tips_month($prevmonth, $prevyear);
        $tips = self::process_tips($posts);

        return $tips;
    }

    /**
     * Gets all the tips of a specified month
     * @return array
     */
    public static function get_all_tips_month($month, $year, $end_day = 0)
    {
        $month_start = Carbon::create($year, $month, 1);

        if($end_day == 0) {
            $month_end = new Carbon('last day of ' . $month_start->format('F') . ' ' . $month_start->format('Y'));
        } else {
            $month_end = Carbon::create($year, $month, $end_day);
        }

        $args = array(
            'post_type' => NAN_TIPS_SLUG,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_key' => 'tip_date',
            'orderby' => 'meta_value',
            'order' => 'desc',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'       => 'tip_date',
                    'compare'   => '>=',
                    'value'     => $month_start->format('Ymd'),
                    'type'      => 'DATE'
                ),
                array(
                    'key'       => 'tip_date',
                    'compare'   => '<=',
                    'value'     => $month_end->format('Ymd'),
                    'type'      => 'DATE'
                )
            )
        );

        $posts = get_posts( $args );

        return $posts;
    }

    /**
     * This is returned from the API call for the todays tip
     * 
     * @param  array $params
     * @return JSON response
     */
    public static function get_todays_tip()
    {
        $today = date('Ymd');

        $args = array(
            'post_type' => NAN_TIPS_SLUG,
            'numbposts' => 1,
            'post_status' => 'publish',
            'meta_query'    => array(
                array(
                    'key'       => 'tip_date',
                    'value'     => $today,
                    'compare'   => '=',
                ),
            )
        );

        $tips = get_posts( $args );

        if(empty($tips))
            return array(); 

        $return_arr = array();
        $return_arr['tip'] = $tips[0]->post_content;

        return $return_arr;
    }

    public static function process_tips($tips)
    {
        $processed_tips = array();

        if(empty($tips))
            return array();

        global $post;

        foreach($tips as $post) {
            setup_postdata( $post );
            $tip_date = get_field('tip_date');

            $ctip_date = Carbon::createFromFormat('d/m/Y', $tip_date);

            $item = array();
            $item['post_id'] = get_the_ID();
            $item['tip'] = apply_filters( 'the_content', get_the_content());
            $item['day'] = $ctip_date->format('d');
            $item['month'] = $ctip_date->format('F');
            $item['year'] = $ctip_date->format('Y');
            $processed_tips[] = $item;
        }

        return $processed_tips;
    }
}