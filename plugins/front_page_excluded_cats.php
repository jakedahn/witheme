<?php
/*
Plugin Name: Front Page Excluded Categories
Version: 1.1.1
Plugin URI: http://geekularity.com/fp-excluded-categories-plugin-for-wordpress/
Description: This version uses a comma separated list of *excluded* category ids. 
Author: Sean O'Steen
Author URI: http://geekularity.com/
*/ 

function fpe_where($where) {
	// Change the $cats_to_exclude string to the category id you do not want to appear on the front page.
	// Example:  $cats_to_exclude = '1, 2, 3, 4';
   	$cats_to_exclude = '9, 10';

	global $wpdb, $wp_query;

	if (! $wp_query->is_home || strlen($cats_to_exclude) == 0) {
		return $where;
	}

	if (empty($wpdb->term_relationships))
	{
		$where .= " AND $wpdb->post2cat.category_id NOT IN (" . $cats_to_exclude . ")";
	}
	else
	{
		$where .= " AND $wpdb->term_taxonomy.term_id NOT IN (" . $cats_to_exclude . ")";
	}
	return $where;
}

function fpe_join($join) {
  	global $wpdb, $wp_query;
 
	if (!$wp_query->is_home) {
		return $join;
  	}
	if (empty($wpdb->term_relationships))
	{
		$join .= " LEFT JOIN $wpdb->post2cat ON $wpdb->post2cat.post_id = $wpdb->posts.ID ";
	}
	else
	{
		if (!preg_match("/$wpdb->term_relationships/i",$join)) 
		{
			$join .=" LEFT JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) ";
		}
	    if (!preg_match("/$wpdb->term_taxonomy/i",$join)) 
		{
			$join .=" LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id";
		}
	}
	return $join;
}

function fpe_distinct($distinct) {
	global  $wp_query;

	if (! $wp_query->is_home ) {
		return $distinct;
	}
	return "distinct";
}

add_filter('posts_join', 'fpe_join');
add_filter('posts_where', 'fpe_where');
add_filter('posts_distinct', 'fpe_distinct');

?>