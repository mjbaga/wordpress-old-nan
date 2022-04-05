<?php

/**
 * Template Name: Listing Page Template
 *
 * Listing Page Template
 */

use NaNArticles\Api\Api;

get_header(); ?>
<div class="scroll-wrap">
<?php
while( have_posts() ):

    the_post();

    $paged = absint( get_query_var( 'paged', 1 ) );
    $perpage = get_option( 'posts_per_page' );

    $template = 'content-listing.php';

    $data = Api::get_page_details();

    Api::render($template, $data);

endwhile;

get_footer();
