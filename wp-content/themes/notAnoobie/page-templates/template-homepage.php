<?php
/**
 * Template Name: Homepage Template
 *
 * Homepage Template
 * @since 0.1.0
 */

get_header();

while ( have_posts() ) :
	the_post();

	// Include the page content template.
	$page_data = NaNThemeComponents\Pages\Homepage::get_data();
	nan_theme_render( 'templates/content', 'home', $page_data );

	// End the loop.
endwhile;

get_footer();
