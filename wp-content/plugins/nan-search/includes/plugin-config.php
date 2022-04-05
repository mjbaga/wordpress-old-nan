<?php

/*
 * Site Prefix
 */
if( !defined( 'NAN_SITE_PREFIX' ) ) {
  define( 'NAN_SITE_PREFIX', 'nan_' );
}

/*
 * Plugin Directory
 */
if( !defined( 'NAN_SEARCH_PLUGIN_DIR' ) ) {
  define( 'NAN_SEARCH_PLUGIN_DIR', dirname( __FILE__ ) . '/..' );
}


/*
 * Event Listing Cache Time for calendar and featured items
 */
if( !defined( 'NAN_SEARCH_CACHE_TIME' ) ) {
  define( 'NAN_SEARCH_CACHE_TIME', 1800 ); //30 * 60
}

/*
 * Event Options name in cms settings
 */
if( !defined( 'NAN_SEARCH_OPTIONS_NAME' ) ) {
  define( 'NAN_SEARCH_OPTIONS_NAME', 'nan_search_options_name' ); //30 * 60
}