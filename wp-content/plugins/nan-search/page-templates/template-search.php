<?php
/**
 * Template Name: Search Page Template
 *
 * Search Page Template
 */
get_header();

while( have_posts() ):
  the_post();
  
  $data = array();
  $data['cx_id'] = NaN_Search_Api::get_search_cx_id();
  NaN_Search_Api::render( 'content', 'search', $data );
  
endwhile;

get_footer();
