<?php
/*
Plugin Name: Random Featured Post
Plugin URI: http://www.mydollarplan.com/random-featured-post-plugin/
Description: Displays featured posts by randomly selecting a post from a designated category.
Author: Scott @ MyDollarPlan.com
Version: 1.1.3 
Author URI: http://www.mydollarplan.com/random-featured-post-plugin/
*/ 

/*  Copyright 2008  Scott @ MyDollarPlan.com  (email : Scott@MyDollarPlan.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function fp_option_menu() {
	if (function_exists('current_user_can')) {
		if (!current_user_can('manage_options')) return;
	} else {
		global $user_level;
		get_currentuserinfo();
		if ($user_level < 8) return;
	}
	if (function_exists('add_options_page')) {
		add_options_page(__('Featured Post'), __('Featured Post'), 1, __FILE__, 'fp_options_page');
	}
}

add_action('admin_menu', 'fp_option_menu');

$default_options['show_featured'] = '';
$default_options['show_category'] = '';
$default_options['div_title'] = 'Featured Post';
$default_options['more_text'] = 'Read more &rarr;';
$default_options['excerpt_off'] = 'N';
$default_options['ignore_more'] = '';
$default_options['num_posts'] = '1';
$default_options['show_posts'] = '';
$default_options['show_pages'] = '';

add_option('fp_featuredpost', $default_options);

function fp_options_page(){
	global $wpdb;
	if (isset($_POST['update_options'])) {
		$options['show_featured'] = trim($_POST['show_featured'],'{}');
            //$options['show_category'] = trim($_POST['show_category'],'{}');
            $options['div_title'] = trim($_POST['div_title'],'{}');
		$options['more_text'] = trim($_POST['more_text'],'{}');
		$options['excerpt_off'] = trim($_POST['excerpt_off'],'{}');
		$options['ignore_more'] = trim($_POST['ignore_more'],'{}');
            $options['num_posts'] = trim($_POST['num_posts'],'{}');
		$options['show_posts'] = trim($_POST['show_posts'],'{}');
		$options['show_pages'] = trim($_POST['show_pages'],'{}');


		$show_category = $_POST['show_category'];
            if (empty($show_category)) {
			$cats = "";
		} else {
			$cats = implode(" ", $show_category);
		}
		$options['show_category'] = $cats;

		update_option('fp_featuredpost', $options);
		echo '<div class="updated"><p>' . __('Options saved') . '</p></div>';
	} else {
		$options = get_option('fp_featuredpost');

		$show_category = explode(" ",$options['show_category']);
	}
	?>
		<div class="wrap">
		<h2><?php echo __('Featured Post Options'); ?></h2><br />
		<form method="post" action="">
                <table align="left">
                <tr><th align="left"><input type="checkbox" name="show_featured" value="show" <?php if ($options['show_featured'] == 'show') echo 'checked="checked"'; ?> />&nbsp;
                <?php _e('Show Featured Post') ?><br /></th></tr>

                <tr><td><?php _e('Number of posts to show: ') ?>
                <input type="text" name="num_posts" size="4" value="<?php if (is_numeric($options['num_posts'])) { echo $options['num_posts']; } else { echo '1'; } ?>" /><br /></td></tr>

		    <tr><td><?php _e('Featured Post Box Title: ') ?><input type="text" name="div_title" size="30" value="<?php echo $options['div_title']; ?>" /><br /></td></tr>

                <tr><td><?php _e('Content Options: ') ?><br />
                     &nbsp;&nbsp;&nbsp;<INPUT TYPE=RADIO NAME="excerpt_off" VALUE="N" <?php if ($options['excerpt_off'] != 'Y') echo 'CHECKED'; ?>>Display excerpt.<br />
                     &nbsp;&nbsp;&nbsp;<INPUT TYPE=RADIO NAME="excerpt_off" VALUE="Y" <?php if ($options['excerpt_off'] == 'Y') echo 'CHECKED'; ?>>Display full content.<br /><br />
                </td></tr>

                <tr><td align="left"><input type="checkbox" name="ignore_more" value="Y" <?php if ($options['ignore_more'] == 'Y') echo 'checked="checked"'; ?> />&nbsp;
                <?php _e('Ignore <tt>&lt;!--more--&gt;</tt> tag when displaying full content.') ?><br /></td></tr>

		<tr><td><?php _e('Text for "continue to post" link: ') ?>
                <input type="text" name="more_text" size="25" value="<?php echo $options['more_text']; ?>" /><br /></td></tr>

                <tr><td align="left"><input type="checkbox" name="show_posts" value="Y" <?php if ($options['show_posts'] == 'Y') echo 'checked="checked"'; ?> />&nbsp;
                <?php _e('Show posts (default)') ?></td></tr>

                <tr><td align="left"><input type="checkbox" name="show_pages" value="Y" <?php if ($options['show_pages'] == 'Y') echo 'checked="checked"'; ?> />&nbsp;
                <?php _e('Show static pages') ?><br /></td></tr>

		<tr><td><br /><input type="submit" name="update_options" value="<?php _e('Update') ?>"  style="font-weight:bold;" /></td></tr>
                </table>

<table border="0" align="right">
<?php
   echo '<tr><th>Show</th><th align="left">Category</th></tr>';
   $categories = mysql_query("
	SELECT t.term_id, t.name
	FROM $wpdb->terms t
	LEFT JOIN $wpdb->term_taxonomy tax ON tax.term_id = t.term_id
	WHERE tax.taxonomy = 'category'
	ORDER BY t.name
	", $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);
	
   if ($categories && mysql_num_rows($categories) > 0) {
	while ($category = mysql_fetch_object($categories)) {
		echo '<tr><td align="center"><input type="checkbox" name="show_category[ ]" value="'.$category->term_id.'"';
		if (sizeof($show_category) > 0) if (in_array(strval($category->term_id),$show_category)) echo ' CHECKED';
            echo '></td><td>'.$category->name.'&nbsp;</td></tr>';  
	}
   }	
?>
</table>	

		</form>
	</div>
	<?php	
}


function show_featured_post($PreFeature = '', $PostFeature = '', $AlwaysShow = false, $categoryID = 0, $NumberOfPosts = 0) {
   global $wpdb;
   
   $options = get_option('fp_featuredpost');
   if (!$AlwaysShow) { if ($options['show_featured'] != 'show') return; }
   
   if ($categoryID == 0) {
	$show_category = explode(" ",$options['show_category']);
      if (sizeof($show_category) == 0) return;
   } else {
      if (!is_numeric($categoryID)) return;
      $show_category = explode(" ",$categoryID);
   }
   $sqlcat = "( ";
   $count = 0;
   foreach ($show_category as $cat) {
      if ($count > 0) $sqlcat = $sqlcat." OR ";
      $sqlcat = $sqlcat."$wpdb->term_taxonomy.term_id = ".$cat;
      $count = $count + 1;
   }
   $sqlcat = $sqlcat." )";

   if (!is_numeric($options['num_posts'])) {
	$num_posts = '1';
   } else {
      $num_posts = $options['num_posts'];
   }
   if ($NumberOfPosts > 0) $num_posts = $NumberOfPosts;

   if (empty($options['more_text'])) {
      $more_text = 'Read more &rarr;';
   } else {
      $more_text = $options['more_text'];
   }

   $sqlposts = '';   //  shows pages and posts
   if ($options['show_posts'] != 'Y' && $options['show_pages'] != 'Y')  {   // not checked, default to show posts only
   	$sqlposts = " AND $wpdb->posts.post_type = 'post' ";
   } else {
	if ($options['show_posts'] == 'Y' && $options['show_pages'] != 'Y')  {   // show only posts
	   	$sqlposts = " AND $wpdb->posts.post_type = 'post' ";
	} elseif ($options['show_posts'] != 'Y' && $options['show_pages'] == 'Y')  {   // show only pages
	   	$sqlposts = " AND $wpdb->posts.post_type = 'page' ";
	}  // if both checked do nothing and pages and posts shown by default
   }

   $div_title = $options['div_title'];
   if (empty($div_title)) $div_title = "Featured Post";

   $posts = mysql_query("
		SELECT * FROM $wpdb->posts
		LEFT JOIN $wpdb->term_relationships ON
		($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy ON
		($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		WHERE $wpdb->posts.post_status = 'publish'".$sqlposts."
		AND $wpdb->term_taxonomy.taxonomy = 'category'
		AND ".$sqlcat." ORDER BY RAND()
		LIMIT ".$num_posts, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);
	
   if ($posts && mysql_num_rows($posts) > 0) {
	while ($thepost = mysql_fetch_object($posts)) {
		$myID = $thepost->ID;

   		//if ($myID == 0) return;

		$thepost = get_post($myID);
		setup_postdata($thepost);

   		echo $PreFeature."\n<div class=\"featuredpost\">\n";
   		echo "<h3>".$div_title."</h3>\n";
   		echo "<h2><a href=\"";
   		echo get_permalink($myID);
   		echo "\" title=\"";
   		echo apply_filters('the_title', $thepost->post_title);
   		echo "\">";
   		echo apply_filters('the_title', $thepost->post_title);
   		echo "</a></h2>\n";
   		if ($options['excerpt_off'] == 'Y') {
			if ($options['ignore_more'] != 'Y') {   // respect more tag
				$moreposition = strpos($thepost->post_content,"<!--more-->");
                        if (is_home() || $moreposition == 0) {
	      			the_content('');
                        } else {
					echo apply_filters('the_content', substr($thepost->post_content,0,$moreposition));
                        }
				if ($moreposition != 0) {   // we have a more tag, partial post displayed
		   			echo "<a href=\"";
					echo get_permalink($myID);
					echo "\" title=\"";
					echo apply_filters('the_title', $thepost->post_title);
					echo "\">".$more_text."</a>\n";
				}
			} else {
				echo apply_filters('the_content', $thepost->post_content);
			}
   		} else {
      		if (empty($thepost->post_excerpt)) {
	      		the_excerpt();
			} else {
				echo apply_filters('the_excerpt', $thepost->post_excerpt);
			}
   			echo "<a href=\"";
   			echo get_permalink($myID);
   			echo "\" title=\"";
   			echo apply_filters('the_title', $thepost->post_title);
			echo "\">".$more_text."</a>\n";
   		}
   		echo "</div>\n".$PostFeature."\n";
	}   // end while
   }  // else no posts found
}

?>