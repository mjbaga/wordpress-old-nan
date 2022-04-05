<?php

namespace NaNThemeComponents\Shared;

use Carbon\Carbon;

class Footer
{
	public static function get_data() {
	    $data = array();
	    $data['legal_navigation'] = Navigation::get_legal_navigation();
	    $data['mobile_main_navigation'] = Navigation::get_mobile_main_navigation();
	    $data['copyright'] = nan_parse_sidebar('footer_bottom_widget');
	    $data['footer_top'] = nan_parse_sidebar( 'footer_top_widget' );
	    $data['push_frequency'] = get_field('push_notification_frequency', 'option');
	    return $data;
	}
}