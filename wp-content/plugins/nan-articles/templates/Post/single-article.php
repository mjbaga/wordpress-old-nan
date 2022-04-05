<?php
/**
 * The template for displaying single event template
 */

use NaNArticles\Api\Api;

get_header(); ?>
<div class="scroll-wrap">
<?php
while( have_posts() ) {
  
	the_post();

	setPostViews(get_the_ID());

	$template = 'content-article.php';

	$data = Api::get_article_details();

	Api::render($template, $data);
    
}

get_footer();
