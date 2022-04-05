<?php

/**
 * Template Name: Tips Listing Page Template
 *
 * Listing Page Template
 */

use NaNTips\Api\Api;

get_header(); ?>
<div class="scroll-wrap">
<?php
while( have_posts() ):

    the_post();

    $template = 'content-tips-listing.php';

    $data = Api::get_page_details();

    Api::render($template, $data);

endwhile;

get_footer();
