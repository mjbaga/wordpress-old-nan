<?php

namespace NaNThemeComponents\Shared;

class Header
{
	public static function get_data() {
	    $data = array();
	    $data['is_home'] = is_home();
	    $data['site_title'] = SITE_NAME;
	    $data['primary_navigation'] = Navigation::get_primary_navigation();
	    $data['mobile_legal_navigation'] = Navigation::get_mobile_legal_navigation();
	    $data['logo1'] = nan_get_assets_url() . '/notAnoobie/images/notAnoobie-wh-logo.png';
	    $data['logo2'] = nan_get_assets_url() . '/notAnoobie/images/notAnoobie-logo.png';
	    $data['header_search'] = nan_parse_sidebar('header_widget');
	    $data['copyright'] = nan_parse_sidebar('copyright_widget');
	    return $data;
	}
}