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
if( !defined('NAN_ARTICLES_PLUGIN_DIR') ) {
	define( 'NAN_ARTICLES_PLUGIN_DIR', dirname( __FILE__ ) . '/..' );
}

/**
 * Site Prefix
 */
if( !defined('NAN_ARTICLES_SLUG') ) {
	define( 'NAN_ARTICLES_SLUG', 'nan-articles' );
}

/*
 * Tips Listing Cache Time for featured items
 */
if( !defined( 'NAN_ARTICLES_CACHE_TIME' ) ) {
	define( 'NAN_ARTICLES_CACHE_TIME', 1800 ); //30 * 60
}

/**
 * Tips Options name in cms settings
 */
if( !defined( 'NAN_ARTICLES_OPTIONS_NAME' ) ) {
  	define( 'NAN_ARTICLES_OPTIONS_NAME', 'nan_articles_options_name' );
}