<?php

/**
 * Site Prefix
 */
if( !defined('NOTANOOBIE_SITE_PREFIX') ) {
	define( 'NOTANOOBIE_SITE_PREFIX', 'nan-' );
}

/**
 * Plugin Directory
 */
if( !defined('NAN_TIPS_PLUGIN_DIR') ) {
	define( 'NAN_TIPS_PLUGIN_DIR', dirname( __FILE__ ) . '/..' );
}

/**
 * Site Prefix
 */
if( !defined('NAN_TIPS_SLUG') ) {
	define( 'NAN_TIPS_SLUG', 'nan-tips' );
}

/*
 * Tips Listing Cache Time for featured items
 */
if( !defined( 'NAN_TIPS_CACHE_TIME' ) ) {
	define( 'NAN_TIPS_CACHE_TIME', 1800 ); //30 * 60
}

/**
 * Tips Options name in cms settings
 */
if( !defined( 'NAN_TIPS_OPTIONS_NAME' ) ) {
  	define( 'NAN_TIPS_OPTIONS_NAME', 'nan_tips_options_name' );
}