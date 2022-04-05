<?php

namespace NaNThemeComponents\Pages;

class Standard
{

	public static function get_data() 
    {
    	$data = array();
        $data['title'] = apply_filters( 'the_title', get_the_title());
    	$data['content'] = apply_filters( 'the_content', get_the_content());
        $data['breadcrumbs'] = nan_parse_sidebar('breadcrumbs_widget');
        
    	return $data;
    }

}