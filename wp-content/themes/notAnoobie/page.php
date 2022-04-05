<?php

get_header(); ?>
<div class="scroll-wrap">
<?php
while ( have_posts() ) :
	
	the_post();

	// Include the page content template.
	$page_data = NaNThemeComponents\Pages\Standard::get_data();
	nan_theme_render( 'templates/content', 'page', $page_data );

// End the loop.
endwhile;
get_footer(); 