<?php

/*
	Plugin Name: notAnoobie Tips
	Description: Bespoke Plugin for Tip of the Day
	Version: 1.0
	Author: mjdbaga@gmail.com
	Author URI: http://www.adelphi.digial/
*/

if( !defined('ABSPATH') )
	die('Access denied.');

require_once dirname( __FILE__ ) . '/includes/plugin-config.php';
require_once dirname( __FILE__ ) . '/vendor/autoload.php';

/** Returns Plugin Directory Path */
function nan_tips_plugin_path () {
	return plugin_dir_path(__FILE__);
}

function nan_tips_plugin_uri () {
	return plugin_dir_url(__FILE__);
}

/**
 * Returns the absolute path of the specified template
 *
 * @param       string $template template path relative to templates directory
 *
 * @return      string absolute path to template
 */
function nan_tips_template_path ($template) {
	return nan_tips_plugin_path() . 'templates/' . $template;
}

/**
 * Autoloader for Plugin classes
 *
 * @param       string $className Name of the class that shall be loaded
 */
function nan_tips_autoload ($className) {

	$filepath = nan_tips_plugin_path() . '/' . str_replace('\\', '/', $className) . '.php';

	if (file_exists($filepath))
		require_once($filepath);
}

spl_autoload_register('nan_tips_autoload');

$nan_tips = NaNTips\Tips::get_instance();
