<?php
/*
Plugin Name: Wordpress Gravatars
Plugin URI: http://wordpress.org/extend/plugins/wp-gravatar/
Description: Makes use of Gravatars and MyBlogLog Avatars, places Gravatars, OpenAvatar, Wavatar, Identicon, monsterID or MyBlogLog Avatars in the comments section. Uses the comment authors email to display their Gravatar. It also gives the user an Author Profile picture, based on his or hers <strong>Gravatar</strong>. Developer blog at <a href="http://shuttlex.blogdns.net">this site</a>.
Version: 2.7.1
Author: Rune Gulbrandsøy
Author URI: http://gravatar.bloggs.be
*/

/*
  Copyright 2007 - 2008 Rune (http://bloggs.be/rune/)

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

/*
The idea for the Favicon parts come from the plugin favatars by Jeff Minard (http://thecodepro.com/). I have used some of his codem and rewritten some of the parts i have used.
Thanks to Petter (http://neppe.no) for the tips about a nofollow option!
*/


function gravatar_admin_menu(){
	if (function_exists('add_meta_box')) { 
    	add_menu_page('Gravatar', 'Gravatar', 8, 'gravatar', 'gravatar_admin');
    } else {
    add_submenu_page('themes.php', 'Gravatar', 'Gravatar', 8, 'gravatar', 'gravatar_admin');
    }
}

function show_openid(){
echo "This site is using <a href='http://openvatar.com/' target='_blank'>OpenAvatar</a> based on <a href='http://openid.net' target='_blank'><img src='http://shuttlex.blogdns.net/openid.gif'/></a>";
}

function show_gravatar($s) {
$gravatar = get_option('bruk_gravatar');
$openavatar = get_option('bruk_openavatar');
$gravatar_align = get_option('bruk_gravatar_align');
$default = get_option('default_gravatar');
$default_pingback = get_option('default_gravatar_pingback');
$gravatar_use_url = get_option('bruk_gravatar_url');
$gravatar_use_url_follow = get_option('bruk_gravatar_url_follow');
$home_url = get_option('bruk_gravatar_home_url');
$use_favico = get_option('bruk_gravatar_favico');
$use_mbl = get_option('bruk_mbl_ikon');
$gravatar_no_page = get_option('bruk_gravatar_pages');
$gravatar_size = get_option('bruk_gravatar_size');
$gravatar_rating = get_option('bruk_gravatar_rating');
$gravatar_css = get_option('bruk_gravatar_css');
if($gravatar == true && get_option('stylesheet') != 'prologue'){
if (is_page() && $gravatar_no_page == true && !is_single()){
 }else{
	global $comment, $type;
	$comment_tekst = $comment->get_comment_text;
	$kommentar_type = $comment->get_comment_type;
if ( !empty( $comment->comment_author_email ) ) {
        $lowercase = strtolower($comment->comment_author_email);
        $md5 = md5( $lowercase );
        //$default == $default_gravatar;
        $comment_name = $comment->comment_author;
        if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
        	$comment_link = get_option('home');
        	}else{
        	$comment_link = $comment->comment_author_url;
        	if ($use_favico == true){
        	$favicon_url = getFavicon($comment_link);
    		$default = $favicon_url;
    		if ($default == '')
    			$default = get_option('default_gravatar');
    			}
        	}
        //OpenAvatar section
        if ( $default = get_option('default_gravatar') && $openavatar == true) {
        if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
        	$comment_url = '';
        	}else{
        	$comment_url = $comment->comment_author_url;
        	}
        	if (parse_url($comment_url, PHP_URL_PATH)=='')
        	{
			if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
			$default = get_option('default_gravatar');
			}else{
			$com_url = $comment->comment_author_url;
			if (stristr($com_url, 'myopenid') == true) {
			$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  			}else {
  			$default = get_option('default_gravatar');
  			}}}
		else
 			{
 			if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
			$default = get_option('default_gravatar');
			}else{
			$com_url = $comment->comment_author_url;
			if (stristr($com_url, 'myopenid') == true) {
			$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  			}else {
  			$default = get_option('default_gravatar');
  			}}}
        if ($use_mbl == true && $default == get_option('default_gravatar')){
        	$default = "http://pub.mybloglog.com/coiserv.php?href=mailto:" . $lowercase . "&amp;n=". $lowercase;
        	}
        	}
        // End of OpenAvatar Section
        //edit the style to what you want, the standard style looks good on most themes.
        if($gravatar_use_url_follow == true){
       			 	$follow_links = "rel='external nofollow'";
       			 	} else {
       			 	$follow_links = "rel='external'";
       			 	}
		if ($gravatar_size == '' || $gravatar_size == ' ') {
			$gravatar_size = "40";
			}else{
			$gravatar_size = $gravatar_size;
			}
		if ($gravatar_rating == '' || $gravatar_rating == ' ') {
			$gravatar_rating = "X";
			}else{
			$gravatar_rating = $gravatar_rating;
			}
		
		if ($gravatar_css == '' || $gravatar_css == ' '){
			$gravatar_css_temp = "style='float: left; margin-right: 10px; border: none; display:inline;'";
			}else{
			$gravatar_css_temp = "style='";
			$gravatar_css_temp .= $gravatar_css;
			$gravatar_css_temp .= "'";
			}
		if ($default ==' ' || $default ==''){
			$default = get_option('default_gravatar');
			}
			if (get_option('bruk_wavatar_default') == true && $default == get_option('default_gravatar')){
				$default = 'wavatar';
				}
			if (get_option('bruk_identicon_default') == true && $default == get_option('default_gravatar')){
				$default = 'identicon';
				}
			if (get_option('bruk_monsterid_default') == true && $default == get_option('default_gravatar')){
				$default = 'monsterid';
				}
			if (get_option('bruk_own_default') == true){
				if (stristr($com_url, 'myopenid') == true) {
				$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  				}else {
  				$default = get_option('default_gravatar');
				}}
			if($home_url == true && $comment_link != get_option('home')){
       			 $s = "<a href='$comment_link' $follow_links>$comment_name</a><a href='$comment_link' $follow_links><img $gravatar_css_temp src='http://www.gravatar.com/avatar/$md5?rating=$gravatar_rating&amp;default=$default' alt='No Gravatar' width=$gravatar_size height=$gravatar_size/></a>";
       		} else {
       		if ($gravatar_use_url == true){
       			$s = "<a href='$comment_link' $follow_links>$comment_name</a><a href='$comment_link' $follow_links><img $gravatar_css_temp' src='http://www.gravatar.com/avatar/$md5?rating=$gravatar_rating&amp;default=$default' alt='No Gravatar' width=$gravatar_size height=$gravatar_size/></a>";
       		}else{	
       			$s = "$comment_name<img $gravatar_css_temp src='http://www.gravatar.com/avatar/$md5?rating=$gravatar_rating&amp;default=$default' alt='No Gravatar' width=$gravatar_size height=$gravatar_size/>";
       		}}
		}}
	return $s;
}
return $s;
}

function show_gravatar_post($s) {
$gravatar = get_option('bruk_gravatar');
$gravatar_align = get_option('bruk_gravatar_align');
$default = get_option('default_gravatar');
$post_gravatar = get_option('bruk_gravatar_post');
$gravatar_size = get_option('bruk_gravatar_size');
	if($post_gravatar == true && get_option('bruk_gravatar_single_post') == false){
	global $post;
	if ($gravatar_size == '' || $gravatar_size == ' ') {
			$gravatar_size = "20";
			}else{
			$gravatar_size = $gravatar_size;
			}
       $epost = get_the_author_email();
        $lowercase = strtolower($epost);
        $md5 = md5($lowercase);
        $content=$s;
        $s= "<img style='float: left; margin-right: 10px; border: none;' src='http://www.gravatar.com/avatar.php?gravatar_id=$md5&amp;default=$default' alt='No Gravatar' width=$gravatar_size height=$gravatar_size/>";
		$s=$s."$content";
		}
	return $s;
	
}

function prologue_show_gravatar_post($id) {
global $post,$wpdb,$user;
$default = get_option('default_gravatar');
$gravatar_size = get_option('bruk_gravatar_size');
$epost = $wpdb->get_var("SELECT user_email FROM $wpdb->users WHERE ID=".$id."");
        $lowercase = strtolower($epost);
        $md5 = md5($lowercase);
        if ($gravatar_size == '' || $gravatar_size == ' ') {
			$gravatar_size = "48";
			}else{
			$gravatar_size = $gravatar_size;
			}
        return "<img style='float: left; margin-right: 10px; border: none;' src='http://www.gravatar.com/avatar.php?gravatar_id=$md5&amp;size=48&amp;default=$default' width=$gravatar_size height=$gravatar_size alt='No Gravatar'/>";
}

function gravatar_footer() {
$side = get_option('blogname');
echo "<p><small><strong>$side</strong>&nbsp;is using <a href='http://gravatar.bloggs.be'>WP-Gravatar</a></small></p>";
 
}


function show_gravatar_edit($s) {
global $comment;
$gravatar = get_option('bruk_gravatar');
$default = get_option('default_gravatar');
$use_mbl = get_option('bruk_mbl_ikon');
$openavatar = get_option('bruk_openavatar');
$comment_tekst = $comment->comment_text;
if ( !empty( $comment->comment_author_email ) ) {
        $lowercase = strtolower($comment->comment_author_email);
        $md5 = md5( $lowercase );
       
        if ($use_mbl == true && $default == get_option('default_gravatar')){
        	$default = "http://pub.mybloglog.com/coiserv.php?href=mailto:" . $lowercase . "&amp;n=". $lowercase;
        	}
        //OpenAvatar section
        if ( $default = get_option('default_gravatar') && $openavatar == true) {
        if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
        	$comment_url = '';
        	}else{
        	$comment_url = $comment->comment_author_url;
        	}
        	if (parse_url($comment_url, PHP_URL_PATH)=='')
        	{
			if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
			$default = get_option('default_gravatar');
			}else{
			$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url.'/');
 			}}
		else
 			{
 			if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
			$default = get_option('default_gravatar');
			}else{
			$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  			}}
        if ($use_mbl == true && $default == get_option('default_gravatar')){
        	$default = "http://pub.mybloglog.com/coiserv.php?href=mailto:" . $lowercase . "&amp;n=". $lowercase;
        	}
        	}
        // End of OpenAvatar Section
        if ($openavatar == false) {
        $default = get_option('default_gravatar');
        }
        	if (get_option('bruk_wavatar_default') == true && $default == get_option('default_gravatar')){
				$default = 'wavatar';
				}
			if (get_option('bruk_identicon_default') == true && $default == get_option('default_gravatar')){
				$default = 'identicon';
				}
			if (get_option('bruk_monsterid_default') == true && $default == get_option('default_gravatar')){
				$default = 'monsterid';
				}
			if (get_option('bruk_own_default') == true){
				$default = get_option('default_gravatar');
			}
        $s = "<img style='float: left; margin-right: 10px; border: none;' src='http://www.gravatar.com/avatar/$md5?size=48&amp;default=$default' alt='' />$comment->comment_content";
	}
	return $s;

}

function gravatar_admin(){
global $userdata;
get_currentuserinfo();
$current_user = $userdata->ID;
$home_link = get_option('home');
	$default_gravatar = get_option('default_gravatar');
		if ($default_gravatar != '') {
			$default_gravatar_temp = $default_gravatar;
			}else{
			$default_gravatar_temp = "http://use.perl.org/images/pix.gif";
			}
		$default_profilepage = get_option('default_profilepage');
		if ($default_profilepage != '') {
			$default_profilepage_temp = $default_profilepage;
			}else{
			$default_profilepage_temp = "about";
			}
		$default_gravatar_size = get_option('bruk_gravatar_size');
		if ($default_gravatar_size != '') {
			$default_gravatar_size_temp = $default_gravatar_size;
			}else{
			$default_gravatar_size_temp = "40";
			}
		$default_gravatar_rating = get_option('bruk_gravatar_rating');
		if ($default_gravatar_rating == '' || $default_gravatar_rating == ' ') {
			$default_gravatar_rating_temp = "X";
			}else{
			$default_gravatar_rating_temp = $default_gravatar_rating;
			}
		$default_gravatar_single_post_pre = get_option('bruk_gravatar_single_post_pre');
		if ($default_gravatar_single_post_pre != '') {
			$default_gravatar_single_post_pre_temp = $default_gravatar_single_post_pre;
			}else{
			$default_gravatar_single_post_pre_temp = "This is some text prior to the author information. You can change this text from the admin section of WP-Gravatar";
			}
		$bruk_gravatar_single_post_color = get_option('bruk_gravatar_single_post_color');
		if ($bruk_gravatar_single_post_color != '') {
			$bruk_gravatar_single_post_color_temp = $bruk_gravatar_single_post_color;
			}else{
			$bruk_gravatar_single_post_color_temp = "c3c5c3";
			}
		$bruk_gravatar_single_img_size = get_option('bruk_gravatar_single_img_size');
		if ($bruk_gravatar_single_img_size == '' || $bruk_gravatar_single_img_size == ' ') {
			$bruk_gravatar_single_img_size_temp = "30";
			}else{
			$bruk_gravatar_single_img_size_temp = $bruk_gravatar_single_img_size;
			}
		$bruk_gravatar_single_img_size_author = get_option('bruk_gravatar_single_img_size_author');
		if ($bruk_gravatar_single_img_size_author == '' || $bruk_gravatar_single_img_size_author == ' ') {
			$bruk_gravatar_single_img_size_author_temp = "20";
			}else{
			$bruk_gravatar_single_img_size_author_temp = $bruk_gravatar_single_img_size_author;
			}
		$bruk_gravatar_single_box_css = get_option('bruk_gravatar_single_box_css');
		if ($bruk_gravatar_single_box_css == '' || $bruk_gravatar_single_box_css == ' ') {
			$bruk_gravatar_single_post_box_css_temp = "font-size:9px; text-align: left;";
			}else{
			$bruk_gravatar_single_post_box_css_temp = $bruk_gravatar_single_box_css;
			}
		$bruk_gravatar_single_img_css = get_option('bruk_gravatar_single_img_css');
		if ($bruk_gravatar_single_img_css == '' || $bruk_gravatar_single_img_css == ' ') {
			$bruk_gravatar_single_post_img_css_temp = "float: right; border: none;";
			}else{
			$bruk_gravatar_single_post_img_css_temp = $bruk_gravatar_single_img_css;
			}
		$bruk_gravatar_author_archive_link = get_option('bruk_gravatar_author_archive_link');
		if ($bruk_gravatar_author_archive_link == '' || $bruk_gravatar_author_archive_link == ' ') {
			$bruk_gravatar_author_archive_link_temp = "Read more from this author";
			}else{
			$bruk_gravatar_author_archive_link_temp = $bruk_gravatar_author_archive_link;
			}
		$bruk_gravatar_css = get_option('bruk_gravatar_css');
		if ($bruk_gravatar_css == '' || $bruk_gravatar_css == ' ') {
			$bruk_gravatar_css_temp = "float: left; margin-right: 10px; border: none; display:inline;";
			}else{
			$bruk_gravatar_css_temp = $bruk_gravatar_css;
			}
	$gravatar = get_option('bruk_gravatar');
	$openavatar = get_option('bruk_openavatar');
	$openavatar_show = get_option('bruk_openavatar_show');
	$gravatar_align = get_option('bruk_gravatar_align');
	$gravatar_kudos = get_option('bruk_gravatar_kudos');
	$gravatar_profil = get_option('bruk_gravatar_profil');
	$gravatar_url = get_option('bruk_gravatar_url');
	$gravatar_url_follow = get_option('bruk_gravatar_url_follow');
	$gravatar_home_url = get_option('bruk_gravatar_home_url');
	$gravatar_favico = get_option('bruk_gravatar_favico');
	$gravatar_uid = get_option('bruk_gravatar_uid');
	$gravatar_post = get_option('bruk_gravatar_post');
	$gravatar_single_post = get_option('bruk_gravatar_single_post');
	$gravatar_single_post_top = get_option('bruk_gravatar_single_post_top');
	$gravatar_author_archive = get_option('bruk_gravatar_author_archive');
	$use_mbl = get_option('bruk_mbl_ikon');
	$gravatar_no_page = get_option('bruk_gravatar_pages');
	$gravatar_admin_page = get_option('bruk_gravatar_admin');
	$use_own = get_option('bruk_own_default');
	$use_wavatar = get_option('bruk_wavatar_default');
	$use_identicon = get_option('bruk_identicon_default');
	$use_monsterid = get_option('bruk_monsterid_default');
	if ($gravatar_uid == ' ' || $gravatar_uid == ''){
		$temp_uid = '1';
		}else{
		$temp_uid = $gravatar_uid;
		}
	$version = "2.7.1";
	
	
	if ($_POST['updatinggravatar']) {
		$temp_grav = $_POST['defaultgravataroption'];
		
		if ($_POST['bruke_gravatar']) {
			$gravatar = true;
			
		} else {
			$gravatar = false;
			
		}
		if ($_POST['bruke_openavatar']) {
			$openavatar = true;
			
		} else {
			$openavatar = false;
			
		}
		if ($_POST['bruke_openavatar_show']) {
			$openavatar_show = true;
			
		} else {
			$openavatar_show = false;
			
		}
		
		 if ($_POST['bruke_gravatar_align']){
		 	$gravatar_align = true;
		 	} else {
		 	$gravatar_align = false;
		 	}
		 if ($_POST['bruk_gravatar_pages']){
		 	$gravatar_no_page = true;
		 	} else {
		 	$gravatar_no_page = false;
		 	}
		  if ($_POST['bruk_gravatar_admin']){
		 	$gravatar_admin_page = true;
		 	} else {
		 	$gravatar_admin_page = false;
		 	}
		 if ($_POST['bruke_gravatar_profil']){
		 	$gravatar_profil = true;
		 	} else {
		 	$gravatar_profil = false;
		 	}
		 	
		 if ($_POST['bruk_gravatar_post']){
		 	$gravatar_post = true;
		 	} else {
		 	$gravatar_post = false;
		 	}
		 if ($_POST['bruk_gravatar_single_post']){
		 	$gravatar_single_post = true;
		 	} else {
		 	$gravatar_single_post = false;
		 	}
		 	
		  if ($_POST['bruk_gravatar_url']){
		 	$gravatar_url = true;
		 	} else {
		 	$gravatar_url = false;
		 	}
		 if ($_POST['bruk_gravatar_url_follow']){
		 	$gravatar_url_follow = true;
		 	} else {
		 	$gravatar_url_follow = false;
		 	}
		 if ($_POST['bruk_gravatar_home_url']){
		 	$gravatar_home_url = true;
		 	} else {
		 	$gravatar_home_url = false;
		 	}
		 if ($_POST['bruk_gravatar_favico']){
		 	$gravatar_favico = true;
		 	} else {
		 	$gravatar_favico = false;
		 	}
		 if ($_POST['bruk_gravatar_kudos']){
		 	$gravatar_kudos = true;
		 	} else {
		 	$gravatar_kudos = false;
		 	}
		 if ($_POST['bruk_own_default']){
		 	$own_default = true;
		 	} else {
		 	$own_default = false;
		 	}
		  if ($_POST['bruk_wavatar_default']){
		 	$wavatar_default = true;
		 	} else {
		 	$wavatar_default = false;
		 	}
		   if ($_POST['bruk_identicon_default']){
		 	$identicon_default = true;
		 	} else {
		 	$identicon_default = false;
		 	}
		 
		  if ($_POST['bruk_monsterid_default']){
		 	$monsterid_default = true;
		 	} else {
		 	$monsterid_default = false;
		 	}
		 if ($_POST['bruk_mbl_ikon']){
		 	$use_mbl = true;
		 	} else {
		 	$use_mbl = false;
		 	}
		 if ($_POST['bruk_gravatar_single_post_top']){
		 	$gravatar_single_post_top = true;
		 	} else {
		 	$gravatar_single_post_top = false;
		 	}
		 if ($_POST['bruk_gravatar_author_archive']){
		 	$gravatar_author_archive = true;
		 	} else {
		 	$gravatar_author_archive = false;
		 	}
		 
		 if ($_POST['default_gravatar']){
		 	$default_gravatar = $_POST['default_gravatar'];
		 	}
		 if ($_POST['default_profilepage']){
		 	$default_profilepage = $_POST['default_profilepage'];
		 	}
		 if ($_POST['gravatar_size']){
		 	$gravatar_size = $_POST['gravatar_size'];
		 	}
		 if ($_POST['gravatar_rating']){
		 	$gravatar_rating = $_POST['gravatar_rating'];
		 	}
		
		 if ($_POST['bruk_gravatar_uid']){
		 	$gravatar_uid = $_POST['bruk_gravatar_uid'];
		 	}
		 if ($_POST['bruk_gravatar_single_post_pre']){
		 	$gravatar_single_post_pre = $_POST['bruk_gravatar_single_post_pre'];
		 	}
		 if ($_POST['bruk_gravatar_css']){
		 	$gravatar_css = $_POST['bruk_gravatar_css'];
		 	}
		 if ($_POST['bruk_gravatar_single_post_color']){
		 	$gravatar_single_post_color = $_POST['bruk_gravatar_single_post_color'];
		 	}
		 if ($_POST['bruk_gravatar_single_box_css']){
		 	$gravatar_single_box_css = $_POST['bruk_gravatar_single_box_css'];
		 	}
		 if ($_POST['bruk_gravatar_single_img_css']){
		 	$gravatar_single_img_css = $_POST['bruk_gravatar_single_img_css'];
		 	}
		 if ($_POST['bruk_gravatar_single_img_size']){
		 	$gravatar_single_img_size = $_POST['bruk_gravatar_single_img_size'];
		 	}
		 if ($_POST['bruk_gravatar_single_img_size_author']){
		 	$gravatar_single_img_size_author = $_POST['bruk_gravatar_single_img_size_author'];
		 	}
		 if ($_POST['bruk_gravatar_author_archive_link']){
		 	$gravatar_author_archive_link = $_POST['bruk_gravatar_author_archive_link'];
		 	}
			
		 
		update_option('bruk_gravatar', $gravatar);
		update_option('bruk_openavatar', $openavatar);
		update_option('bruk_openavatar_show', $openavatar_show);
		update_option('bruk_gravatar_align', $gravatar_align);
		update_option('bruk_gravatar_profil', $gravatar_profil);
		update_option('bruk_gravatar_post', $gravatar_post);
		update_option('bruk_gravatar_single_post', $gravatar_single_post);
		update_option('bruk_gravatar_single_post_top', $gravatar_single_post_top);
		update_option('bruk_gravatar_author_archive', $gravatar_author_archive);
		update_option('bruk_gravatar_single_post_pre', $gravatar_single_post_pre);
		update_option('bruk_gravatar_single_post_color', $gravatar_single_post_color);
		update_option('bruk_gravatar_single_box_css', $gravatar_single_box_css);
		update_option('bruk_gravatar_single_img_css', $gravatar_single_img_css);
		update_option('bruk_gravatar_single_img_size', $gravatar_single_img_size);
		update_option('bruk_gravatar_single_img_size_author', $gravatar_single_img_size_author);
		update_option('bruk_gravatar_author_archive_link', $gravatar_author_archive_link);
		update_option('bruk_gravatar_url', $gravatar_url);
		update_option('bruk_gravatar_css', $gravatar_css);
		update_option('bruk_gravatar_url_follow', $gravatar_url_follow);
		update_option('bruk_gravatar_home_url', $gravatar_home_url);
		update_option('bruk_gravatar_favico', $gravatar_favico);
		update_option('default_gravatar', $default_gravatar);
		update_option('default_profilepage', $default_profilepage);
		update_option('bruk_gravatar_uid', $gravatar_uid);
		update_option('bruk_mbl_ikon', $use_mbl);
		update_option('bruk_own_default', $own_default);
		update_option('bruk_wavatar_default', $wavatar_default);
		update_option('bruk_identicon_default', $identicon_default);
		update_option('bruk_monsterid_default', $monsterid_default);
		update_option('bruk_gravatar_pages', $gravatar_no_page);
		update_option('bruk_gravatar_admin', $gravatar_admin_page);
		update_option('bruk_gravatar_size', $gravatar_size);
		update_option('bruk_gravatar_rating', $gravatar_rating);
		update_option('bruk_gravatar_kudos', $gravatar_kudos);
	if (function_exists('add_meta_box')) {
	echo '<div id="message" class="updated fade"><p>Your choices has been updated - please press <a href="admin.php?page=gravatar">here</a> to see the changes!</p></div>';
	}else{
	echo '<div id="message" class="updated fade"><p>Your choices has been updated - please press <a href="themes.php?page=gravatar">here</a> to see the changes!</p></div>';
	}
	}

?>
<div class="wrap">
<h2><?php _e('Gravatars')?></h2>
<form action="" method="post">
<p class="submit">
	<input value="Update Gravatars &raquo;" type="submit" />
	<input name="updatinggravatar" value="true" type="hidden" />
	<input type="hidden" name="action" value="update" /></p>
<div class="wrap">
<?php if (function_exists('add_meta_box')) { ?>
<?php 
if (get_option('stylesheet') == 'prologue'){ ?>
<table class="form-table">
 <tr>
 	<th valign="top" scope="row">Gravatars?</th>
 	<td>
<p><label><input name="bruke_gravatar" value="gravatar" type="checkbox" <?php if ($gravatar) { ?> checked="checked" <?php } ?> /> Use Gravatars with your comments.</label></p>
<p><label>You're using the Prologue theme, and that means that your settings here will have no effect on the showing of Gravatars with your comments. If you like to use the other functions of this plugin, you have to leave this option <strong>on</strong>, as this is what makes the rest of the functions to work!</label></p>
</td>
 </tr>
</table>
<?php }?>
<?php if (get_option('stylesheet') != 'prologue'){ ?>
<table class="form-table">
 <tr>
 	<th valign="top" scope="row">Gravatars - MyBlogLog - OpenAvatar (<span class="givemesometips" title="Here you choose what you want to show!">?</span>)</th>
 	<td>
<p><label><input name="bruke_gravatar" value="gravatar" type="checkbox" <?php if ($gravatar) { ?> checked="checked" <?php } ?> /> Use <strong><span class="givemesometips" title="Use Gravatars with your comments">Gravatars</span></strong> with your comments.</label> </p>
<p><label><input name="bruke_openavatar" value="openavatar" type="checkbox" <?php if ($openavatar) { ?> checked="checked" <?php } ?> /> Use <a href="http://www.openvatar.com">OpenAvatar</a> with your comments.</label></p>
<p><label><input name="bruke_openavatar_show" value="openavatar_show" type="checkbox" <?php if ($openavatar_show) { ?> checked="checked" <?php } ?> /> Tell your visitors you are using OpenAvatar below the write comment field.</label></p>
<p><label><input name="bruk_mbl_ikon" value="use_mbl" type="checkbox" <?php if ($use_mbl) { ?> checked="checked" <?php } ?> /> Use MyBlogLog avatars with your comments. <small>This will override your sites default Gravatar with MyBlogLog's default Avatar.</small></label></p>
<p><label><input name="bruk_gravatar_favico" value="gravatar_favico" type="checkbox" <?php if ($gravatar_favico) { ?> checked="checked" <?php } ?> /> Replace the sites standard Gravatar with the users websites <em>favico.ico</em> image. If the site does not have a <em>favico.ico</em> file, the sites standard Gravatar will be used. <br/> <small>The use of this option <em><strong>WILL</strong></em> slow down the loading of single pages/posts and the front page and is not recommended.</small></label></p>
<br/>
<p><label><?php _e('Default Gravatar to use (complete URI (eg <em>' . $home_link . '/default.jpg</em>)&nbsp;<input type="text" name="default_gravatar" value="' . $default_gravatar_temp . '" size="50"/>')?><br/>
<?php _e('<small>Current default Gravatar : ' . $default_gravatar_temp . ' <img src="' . $default_gravatar_temp . '" width="30px" height="30px"/></small>')?></label></p>
<?php } ?>
<h3>Choose your sites default Gravatar</h3>
<p><small>Choose only one of the options - if more than one is checked <?php _e(' <img src="' . $default_gravatar_temp . '" width="15px" height="15px"/>')?> will be used.</small></p>
<p><label><input name="bruk_own_default" value="use_own" type="checkbox" <?php if ($use_own) { ?> checked="checked" <?php } ?> /> Use your own default Gravatar for users without Gravatars. As you see above!</label></p>
<p><label><input name="bruk_wavatar_default" value="use_wavatar" type="checkbox" <?php if ($use_wavatar) { ?> checked="checked" <?php } ?> /> Use a <a href="http://www.shamusyoung.com/twentysidedtale/?p=1462">Wavatar</a> as default Gravatar for users without Gravatars.</label></p>
<p><label><input name="bruk_identicon_default" value="use_identicon" type="checkbox" <?php if ($use_identicon) { ?> checked="checked" <?php } ?> /> Use a <a href="http://scott.sherrillmix.com/blog/blogger/wp_identicon/">Identicon</a> as default Gravatar for users without Gravatars.</label></p>
<p><label><input name="bruk_monsterid_default" value="use_monsterid" type="checkbox" <?php if ($use_monsterid) { ?> checked="checked" <?php } ?> /> Use a <a href="http://scott.sherrillmix.com/blog/blogger/wp_monsterid/">MonsterID</a> as default Gravatar for users without Gravatars.</label></p>

</td>
 </tr>
</table>
<table class="form-table">
 <tr>
 	<th valign="top" scope="row">Links</th>
 	<td>
<?php 
if (get_option('stylesheet') == 'prologue'){ ?>
<div class="wrap">
<h4><?php _e('Automattics Prologue theme');?></h4>
<p><label>Your using Automattics Prologue theme, and the options usually found here has no effect on this theme! When you change your theme, they will come back!</label></p>
</td>
 </tr>
</table>
<?php } ?>
<?php if (get_option('stylesheet') != 'prologue'){ ?>
<p><label><input name="bruk_gravatar_home_url" value="gravatar_home_url" type="checkbox" <?php if ($gravatar_home_url) { ?> checked="checked" <?php } ?> /> Gravatars and name will link back to commenters site</em></label></p>
<p><label><input name="bruk_gravatar_url" value="gravatar_url" type="checkbox" <?php if ($gravatar_url) { ?> checked="checked" <?php } ?> /> Gravatars and name for users with no given blog/url link will be linked back to:  <em><?php echo get_option('home'); ?></em></label></p>
<p><label><input name="bruk_gravatar_url_follow" value="gravatar_url_follow" type="checkbox" <?php if ($gravatar_url_follow) { ?> checked="checked" <?php } ?> /> Use &lt;<em>rel=external nofollow</em>&gt; with links to commenters sites.</label></p>
<?php } ?>
</td>
 </tr>
</table>
<table class="form-table">
 <tr>
 	<th valign="top" scope="row">Alignment/Placement and Size</th>
 	<td>
<?php if (get_option('stylesheet') != 'prologue'){
?>
<p><label><input name="bruk_gravatar_post" value="gravatar_post" type="checkbox" <?php if ($gravatar_post) { ?> checked="checked" <?php } ?> /> Use your Gravatar with your blog posts. This will always be on the left side, before your content.</label></p>
<?php } 
if (get_option('bruk_gravatar_post') == true && get_option('stylesheet') == 'prologue') { ?>
<h4><?php _e('Automattic Prologue theme');?></h4>
<p><label>You are using Automattic's Prologue Theme. And you've chosen to use Gravatrs with each post. To get your theme to work as it should, turn this off...</label></p>
<p><label><input name="bruk_gravatar_post" value="gravatar_post" type="checkbox" <?php if ($gravatar_post) { ?> checked="checked" <?php } ?> /> Use your Gravatar with your blog posts. This will always be on the left side, before your content.</label></p>
</td>
 </tr>
</table>
<?php }
?>

<?php 
if (get_option('stylesheet') == 'prologue'){ ?>

<h4><?php _e('Automattics Prologue theme');?></h4>
<p><label>Your using Automattics Prologue theme, and the options usually found here has no effect on this theme! When you change your theme, they will come back!</label></p>

<?php } ?>
<?php if (get_option('stylesheet') != 'prologue'){ ?>
<p><label><?php _e('Gravatar CSS <input type="text" name="bruk_gravatar_css" value="' . $bruk_gravatar_css_temp . '" size="80"/>&nbsp;<small>(used as typed, does only affect the comment section)</small>')?></label></p>
<p><label><input name="bruk_gravatar_pages" value="gravatar_no_page" type="checkbox" <?php if ($gravatar_no_page) { ?> checked="checked" <?php } ?> /> Exclude Gravatars, OpenAvatar, MyBlogLog and Favico from <a href="http://codex.wordpress.org/Pages" target="_blank"><em>Pages</em></a>&nbsp;&nbsp;<small>(Link opens a new window)</small>.</label></p>
<p><label><?php _e('<input type="text" name="gravatar_size" value="' . $default_gravatar_size_temp . '" size="2"/>&nbsp;Size of Gravatars, OpenAvatar, MyBlogLog and Favico in Comments&nbsp;')?></label></p>
<p><label><?php _e('Show Gravatars with this rating or lower') ?>&nbsp;&nbsp;
<select name="gravatar_rating" id="gravatar_rating">
<?php
$ratings = array( 'G' => _c('G|rating'), 'PG' => _c('PG|Rating'), 'R' => _c('R|Rating'), 'X' => _c('X|Rating'));
foreach ($ratings as $key => $rating) :
	$selected = ($default_gravatar_rating_temp == $key) ? 'selected="selected"' : '';
	echo "\n\t<option value='$key' $selected>$rating</option>";
endforeach;
?>
</select></p>
<?php } ?>
<p><label><input name="bruk_gravatar_admin" value="gravatar_admin_page" type="checkbox" <?php if ($gravatar_admin_page) { ?> checked="checked" <?php } ?> /> Show Gravatars, OpenAvatar and MyBlogLog avatars in the  <a href="edit-comments.php" target="_self"><em>Edit Comments</em></a> section.</label></p>
</td>
 </tr>
</table>
<table class="form-table">
 <tr>
 	<th valign="top" scope="row">Author Profile Box</th>
 	<td>
<p><label><input name="bruk_gravatar_single_post" value="gravatar_single_post" type="checkbox" <?php if ($gravatar_single_post) { ?> checked="checked" <?php } ?> /> Place an <em>about</em> (the author) box with every post when viewed as a single page.<small>(this will override the <em>use of gravatars with your blog post option</em>)</small></label></p>
<p><label><input name="bruk_gravatar_single_post_top" value="gravatar_single_post_top" type="checkbox" <?php if ($gravatar_single_post_top) { ?> checked="checked" <?php } ?> /> Places the <em>about</em> box before the post (default is after the post).</label></p>
<p><label><?php _e('Text to display before author profile.<br/><textarea name="bruk_gravatar_single_post_pre" id="bruk_gravatar_single_post_pre" cols="50%" rows="5">' . $default_gravatar_single_post_pre_temp . ' </textarea>&nbsp;<br/>&nbsp;')?></label></p>
<p><label><input name="bruk_gravatar_author_archive" value="gravatar_author_archive" type="checkbox" <?php if ($gravatar_author_archive) { ?> checked="checked" <?php } ?> /> Link to author archive. &nbsp;</label><label><?php _e('Link text to use <input type="text" name="bruk_gravatar_author_archive_link" value="' . $bruk_gravatar_author_archive_link_temp . '" size="50"/>&nbsp;<small>(used as typed)</small>')?></label></p>
<p><label><?php _e('Textcolor to use (in hex) #<input type="text" name="bruk_gravatar_single_post_color" value="' . $bruk_gravatar_single_post_color_temp . '" size="6"/>&nbsp;&nbsp;')?></label></p>
<p><label><?php _e('Size of image <input type="text" name="bruk_gravatar_single_img_size" value="' . $bruk_gravatar_single_img_size_temp . '" size="2"/>&nbsp;&nbsp;')?></label></p>
<p><label><?php _e('CSS box tag <input type="text" name="bruk_gravatar_single_box_css" value="' . $bruk_gravatar_single_post_box_css_temp . '" size="80"/>&nbsp;&nbsp;')?></label></p>
<p><label><?php _e('CSS img tag <input type="text" name="bruk_gravatar_single_img_css" value="' . $bruk_gravatar_single_post_img_css_temp . '" size="80"/>&nbsp;&nbsp;')?></label></p>
</td>
 </tr>
</table>
<table class="form-table">
 <tr>
 	<th valign="top" scope="row">Widgets</th>
 	<td>
<p><label><input name="bruke_gravatar_profil" value="gravatar_profil" type="checkbox" <?php if ($gravatar_profil) { ?> checked="checked" <?php } ?> /> Use the <strong>Author Profile</strong> widget (you have to activate the widget from the widget page).</label>
<label><?php _e('User ID for show with profile widget (eg <em>1</em>)&nbsp;<input type="text" name="bruk_gravatar_uid" value="' . $temp_uid . '" size="2"/>&nbsp;(<small>Your user ID is <strong><em>' . $current_user . '</em></strong></small>)')?></label></p>
<p><label><?php _e('Size of profile picture <input type="text" name="bruk_gravatar_single_img_size_author" value="' . $bruk_gravatar_single_img_size_author_temp . '" size="2"/>&nbsp;&nbsp;')?></label></p>
<p><label><?php _e('Page that profilepicture links to &nbsp;<input type="text" name="default_profilepage" value="' . $default_profilepage_temp . '" size="30"/>&nbsp;<small>(eg <em>' . $home_link . '/about/</em>)</small>')?><br/>
<?php _e('<small>Current page : ' . $home_link . '/' . $default_profilepage_temp . '/</small>')?></label></p>
<p><label>If your theme does not support widgets, you can place <em>&lt;?php ShowGravatar(x);?&gt;</em> in to your <em>sidebar.php</em>. Replace the <em><strong>x</strong></em> with the author number to show. You can place as many <em>&lt;?php ShowGravatar(x);?&gt;</em> as you want.</label></p>
</td>
 </tr>
</table>
<table class="form-table">
 <tr>
 	<th valign="top" scope="row">Support</th>
 	<td>
<p><label><input name="bruk_gravatar_kudos" value="gravatar_kudos" type="checkbox" <?php if ($gravatar_kudos) { ?> checked="checked" <?php } ?> /> Give WP-Gravatars some kudos by showing of that you're using it in your footer.</label></p>
<p><?php _e('If you do not have a Gravatar, you can get your very own over at the <a href="http://site.gravatar.com/signup">Gravatar</a> site.')?></p>
<p><label>If you need to revert to standard CSS settings and standard TEXT, just delete the text in the <strong>CSS</strong> and/or <strong>TEXT</strong> fields and press <em>Update</em></label></p>
<p><label>For support, please visit <a href="http://gravatar.bloggs.be/">The WP-Gravatar support forum</a>.</label></p>
<p><?php _e('<small>&copy; <a href="http://gravatar.bloggs.be">Rune G</a> You are using version :<strong>' . $version . '</strong> of WP-Gravatar</small>')?></p>
<p> <a href="http://www.amazon.com/gp/registry/wishlist/1K51U8VX047NY/ref=wl_web"><img src="http://g-ecx.images-amazon.com/images/G/01/gifts/registries/wishlist/v2/web/wl-btn-129-b._V46776269_.gif" width="129" alt="My Amazon.com Wish List" height="42" border="0" /></a></p>
<? if (get_option('stylesheet') == 'prologue') { ?>
<h4><?php _e('Automattic Prologue theme');?></h4>
<p><label>You are using Automattic's Prologue Theme. Some of the options on this page will have no effect on this theme, like the size of the Gravatar can not be changed unless you change it in the <em>functions.php</em> file in the themes directory. The same goes for the default Gravatar to show.</label></p>
</td>
 </tr>
</table>
<?php }
?>
</td>
 </tr>
</table>
<?php } else { //Not using WP25 - okay heres the version for pre 2.5 ?>
<h4><?php _e('Gravatars - OpenAvatar - MyBlogLog - Favico?');?></h4>
<?php 
if (get_option('stylesheet') == 'prologue'){ ?>
<div class="wrap">
<h4><?php _e('Automattics Prologue theme');?></h4>
<p><label><input name="bruke_gravatar" value="gravatar" type="checkbox" <?php if ($gravatar) { ?> checked="checked" <?php } ?> /> Use Gravatars with your comments.</label></p>
<p><label>You're using the Prologue theme, and that means that your settings here will have no effect on the showing of Gravatars with your comments. If you like to use the other functions of this plugin, you have to leave this option <strong>on</strong>, as this is what makes the rest of the functions to work!</label></p>
</div>
<?php }?>
<?php if (get_option('stylesheet') != 'prologue'){ ?>
<p><label><input name="bruke_gravatar" value="gravatar" type="checkbox" <?php if ($gravatar) { ?> checked="checked" <?php } ?> /> Use Gravatars with your comments.</label></p>
<p><label><input name="bruke_openavatar" value="openavatar" type="checkbox" <?php if ($openavatar) { ?> checked="checked" <?php } ?> /> Use <a href="http://www.openvatar.com">OpenAvatar</a> with your comments.</label></p>
<p><label><input name="bruke_openavatar_show" value="openavatar_show" type="checkbox" <?php if ($openavatar_show) { ?> checked="checked" <?php } ?> /> Tell your visitors you are using OpenAvatar below the write comment field.</label></p>
<p><label><input name="bruk_mbl_ikon" value="use_mbl" type="checkbox" <?php if ($use_mbl) { ?> checked="checked" <?php } ?> /> Use MyBlogLog avatars with your comments. <small>This will override your sites default Gravatar with MyBlogLog's default Avatar.</small></label></p>
<p><label><input name="bruk_gravatar_favico" value="gravatar_favico" type="checkbox" <?php if ($gravatar_favico) { ?> checked="checked" <?php } ?> /> Replace the sites standard Gravatar with the users websites <em>favico.ico</em> image. If the site does not have a <em>favico.ico</em> file, the sites standard Gravatar will be used. <br/> <small>The use of this option <em><strong>WILL</strong></em> slow down the loading of single pages/posts and the front page and is not recommended.</small></label></p>
<br/>
<p><label><?php _e('Default Gravatar to use (complete URI (eg <em>' . $home_link . '/default.jpg</em>)&nbsp;<input type="text" name="default_gravatar" value="' . $default_gravatar_temp . '" size="50"/>')?><br/>
<?php _e('<small>Current default Gravatar : ' . $default_gravatar_temp . ' <img src="' . $default_gravatar_temp . '" width="30px" height="30px"/></small>')?></label></p>
<?php } ?>
<h3>Choose your sites default Gravatar</h3>
<p><small>Choose only one of the options - if more than one is checked <?php _e(' <img src="' . $default_gravatar_temp . '" width="15px" height="15px"/>')?> will be used.</small></p>
<p><label><input name="bruk_own_default" value="use_own" type="checkbox" <?php if ($use_own) { ?> checked="checked" <?php } ?> /> Use your own default Gravatar for users without Gravatars. As you see above!</label></p>
<p><label><input name="bruk_wavatar_default" value="use_wavatar" type="checkbox" <?php if ($use_wavatar) { ?> checked="checked" <?php } ?> /> Use a <a href="http://www.shamusyoung.com/twentysidedtale/?p=1462">Wavatar</a> as default Gravatar for users without Gravatars.</label></p>
<p><label><input name="bruk_identicon_default" value="use_identicon" type="checkbox" <?php if ($use_identicon) { ?> checked="checked" <?php } ?> /> Use a <a href="http://scott.sherrillmix.com/blog/blogger/wp_identicon/">Identicon</a> as default Gravatar for users without Gravatars.</label></p>
<p><label><input name="bruk_monsterid_default" value="use_monsterid" type="checkbox" <?php if ($use_monsterid) { ?> checked="checked" <?php } ?> /> Use a <a href="http://scott.sherrillmix.com/blog/blogger/wp_monsterid/">MonsterID</a> as default Gravatar for users without Gravatars.</label></p>
</div>
<div class="wrap">
<h4><?php _e('Links');?></h4>
<?php 
if (get_option('stylesheet') == 'prologue'){ ?>
<div class="wrap">
<h4><?php _e('Automattics Prologue theme');?></h4>
<p><label>Your using Automattics Prologue theme, and the options usually found here has no effect on this theme! When you change your theme, they will come back!</label></p>
</div>
<?php } ?>
<?php if (get_option('stylesheet') != 'prologue'){ ?>
<p><label><input name="bruk_gravatar_home_url" value="gravatar_home_url" type="checkbox" <?php if ($gravatar_home_url) { ?> checked="checked" <?php } ?> /> Gravatars and name will link back to commenters site</em></label></p>
<p><label><input name="bruk_gravatar_url" value="gravatar_url" type="checkbox" <?php if ($gravatar_url) { ?> checked="checked" <?php } ?> /> Gravatars and name for users with no given blog/url link will be linked back to:  <em><?php echo get_option('home'); ?></em></label></p>
<p><label><input name="bruk_gravatar_url_follow" value="gravatar_url_follow" type="checkbox" <?php if ($gravatar_url_follow) { ?> checked="checked" <?php } ?> /> Use &lt;<em>rel=external nofollow</em>&gt; with links to commenters sites.</label></p>
<?php } ?>
</div>
<div class="wrap">
<h4><?php _e('Alignment/Placement and Size');?></h4>
<?php if (get_option('stylesheet') != 'prologue'){
?>
<p><label><input name="bruk_gravatar_post" value="gravatar_post" type="checkbox" <?php if ($gravatar_post) { ?> checked="checked" <?php } ?> /> Use your Gravatar with your blog posts. This will always be on the left side, before your content.</label></p>
<?php } 
if (get_option('bruk_gravatar_post') == true && get_option('stylesheet') == 'prologue') { ?>
<div class="wrap">
<h4><?php _e('Automattic Prologue theme');?></h4>
<p><label>You are using Automattic's Prologue Theme. And you've chosen to use Gravatrs with each post. To get your theme to work as it should, turn this off...</label></p>
<p><label><input name="bruk_gravatar_post" value="gravatar_post" type="checkbox" <?php if ($gravatar_post) { ?> checked="checked" <?php } ?> /> Use your Gravatar with your blog posts. This will always be on the left side, before your content.</label></p>
</div>
<?php }
?>
<?php 
if (get_option('stylesheet') == 'prologue'){ ?>
<div class="wrap">
<h4><?php _e('Automattics Prologue theme');?></h4>
<p><label>Your using Automattics Prologue theme, and the options usually found here has no effect on this theme! When you change your theme, they will come back!</label></p>
</div>
<?php } ?>
<?php if (get_option('stylesheet') != 'prologue'){ ?>
<p><label><?php _e('Gravatar CSS <input type="text" name="bruk_gravatar_css" value="' . $bruk_gravatar_css_temp . '" size="80"/>&nbsp;<small>(used as typed, does only affect the comment section)</small>')?></label></p>
<p><label><input name="bruk_gravatar_pages" value="gravatar_no_page" type="checkbox" <?php if ($gravatar_no_page) { ?> checked="checked" <?php } ?> /> Exclude Gravatars, OpenAvatar, MyBlogLog and Favico from <a href="http://codex.wordpress.org/Pages" target="_blank"><em>Pages</em></a>&nbsp;&nbsp;<small>(Link opens a new window)</small>.</label></p>
<p><label><?php _e('<input type="text" name="gravatar_size" value="' . $default_gravatar_size_temp . '" size="2"/>&nbsp;Size of Gravatars, Favico and MyBlogLog in Comments&nbsp;')?></label></p>
<p><label><?php _e('Show Gravatars with this rating or lower') ?>&nbsp;&nbsp;
<select name="gravatar_rating" id="gravatar_rating">
<?php
$ratings = array( 'G' => _c('G|rating'), 'PG' => _c('PG|Rating'), 'R' => _c('R|Rating'), 'X' => _c('X|Rating'));
foreach ($ratings as $key => $rating) :
	$selected = ($default_gravatar_rating_temp == $key) ? 'selected="selected"' : '';
	echo "\n\t<option value='$key' $selected>$rating</option>";
endforeach;
?>
</select></p>
<?php } ?>
<p><label><input name="bruk_gravatar_admin" value="gravatar_admin_page" type="checkbox" <?php if ($gravatar_admin_page) { ?> checked="checked" <?php } ?> /> Show Gravatar, OpenAvatar and MyBlogLog avatars in the  <a href="edit-comments.php" target="_self"><em>Edit Comments</em></a> section.</label></p>
</div>
<div class="wrap">
<h4><?php _e('Author Profile Box');?></h4>
<p><label><input name="bruk_gravatar_single_post" value="gravatar_single_post" type="checkbox" <?php if ($gravatar_single_post) { ?> checked="checked" <?php } ?> /> Place an <em>about</em> (the author) box with every post when viewed as a single page.<small>(this will override the <em>use of gravatars with your blog post option</em>)</small></label></p>
<p><label><input name="bruk_gravatar_single_post_top" value="gravatar_single_post_top" type="checkbox" <?php if ($gravatar_single_post_top) { ?> checked="checked" <?php } ?> /> Places the <em>about</em> box before the post (default is after the post).</label></p>
<p><label><?php _e('Text to display before author profile.<br/><textarea name="bruk_gravatar_single_post_pre" id="bruk_gravatar_single_post_pre" cols="50%" rows="5">' . $default_gravatar_single_post_pre_temp . ' </textarea>&nbsp;<br/>&nbsp;')?></label></p>
<p><label><input name="bruk_gravatar_author_archive" value="gravatar_author_archive" type="checkbox" <?php if ($gravatar_author_archive) { ?> checked="checked" <?php } ?> /> Link to author archive. &nbsp;</label><label><?php _e('Link text to use <input type="text" name="bruk_gravatar_author_archive_link" value="' . $bruk_gravatar_author_archive_link_temp . '" size="50"/>&nbsp;<small>(used as typed)</small>')?></label></p>
<p><label><?php _e('Textcolor to use (in hex) #<input type="text" name="bruk_gravatar_single_post_color" value="' . $bruk_gravatar_single_post_color_temp . '" size="6"/>&nbsp;&nbsp;')?></label></p>
<p><label><?php _e('Size of image <input type="text" name="bruk_gravatar_single_img_size" value="' . $bruk_gravatar_single_img_size_temp . '" size="2"/>&nbsp;&nbsp;')?></label></p>
<p><label><?php _e('CSS box tag <input type="text" name="bruk_gravatar_single_box_css" value="' . $bruk_gravatar_single_post_box_css_temp . '" size="80"/>&nbsp;&nbsp;')?></label></p>
<p><label><?php _e('CSS img tag <input type="text" name="bruk_gravatar_single_img_css" value="' . $bruk_gravatar_single_post_img_css_temp . '" size="80"/>&nbsp;&nbsp;')?></label></p>
</div>
<div class="wrap">
<h4><?php _e('Widgets');?></h4>
<p><label><input name="bruke_gravatar_profil" value="gravatar_profil" type="checkbox" <?php if ($gravatar_profil) { ?> checked="checked" <?php } ?> /> Use the <strong>Author Profile</strong> widget (you have to activate the widget from the widget page).</label>
<label><?php _e('User ID for show with profile widget (eg <em>1</em>)&nbsp;<input type="text" name="bruk_gravatar_uid" value="' . $temp_uid . '" size="2"/>&nbsp;(<small>Your user ID is <strong><em>' . $current_user . '</em></strong></small>)')?></label></p>
<p><label><?php _e('Size of profile picture <input type="text" name="bruk_gravatar_single_img_size_author" value="' . $bruk_gravatar_single_img_size_author_temp . '" size="2"/>&nbsp;&nbsp;')?></label></p>
<p><label><?php _e('Page that profilepicture links to &nbsp;<input type="text" name="default_profilepage" value="' . $default_profilepage_temp . '" size="30"/>&nbsp;<small>(eg <em>' . $home_link . '/about/</em>)</small>')?><br/>
<?php _e('<small>Current page : ' . $home_link . '/' . $default_profilepage_temp . '/</small>')?></label></p>
<p><label>If your theme does not support widgets, you can place <em>&lt;?php ShowGravatar(x);?&gt;</em> in to your <em>sidebar.php</em>. Replace the <em><strong>x</strong></em> with the author number to show. You can place as many <em>&lt;?php ShowGravatar(x);?&gt;</em> as you want.</label></p>
</div>
<div class="wrap">
<h4><?php _e('Support');?></h4>
<p><label><input name="bruk_gravatar_kudos" value="gravatar_kudos" type="checkbox" <?php if ($gravatar_kudos) { ?> checked="checked" <?php } ?> /> Give WP-Gravatars some kudos by showing of that you're using it in your footer.</label></p>
<p><?php _e('If you do not have a Gravatar, you can get your very own over at the <a href="http://site.gravatar.com/signup">Gravatar</a> site.')?></p>
<p><label>If you need to revert to standard CSS settings and standard TEXT, just delete the text in the <strong>CSS</strong> and/or <strong>TEXT</strong> fields and press <em>Update</em></label></p>
<p><label>For support, please visit <a href="http://gravatar.bloggs.be/">The WP-Gravatar support forum</a>.</label></p>
<p><?php _e('<small>&copy; <a href="http://gravatar.bloggs.be">Rune G</a> You are using version :<strong>' . $version . '</strong> of WP-Gravatar</small>')?></p>
<? if (get_option('stylesheet') == 'prologue') { ?>
<div class="wrap">
<h4><?php _e('Automattic Prologue theme');?></h4>
<p><label>You are using Automattic's Prologue Theme. Some of the options on this page will have no effect on this theme, like the size of the Gravatar can not be changed unless you change it in the <em>functions.php</em> file in the themes directory. The same goes for the default Gravatar to show.</label></p>
</div>
<?php }
?>
<?php } ?>
<p class="submit">
	<input value="Update Gravatars &raquo;" type="submit" />
	<input name="updatinggravatar" value="true" type="hidden" />
	<input type="hidden" name="action" value="update" /></p>
</form>

</div>
<?php
}

function gravatar_single_post($s){
global $post, $wpdb, $wp_query;
$post_single_gravatar = get_option('bruk_gravatar_single_post');
$gravatar_single_post_top = get_option('bruk_gravatar_single_post_top');
$pre_text = get_option('bruk_gravatar_single_post_pre');
$gravatar_text_color = get_option('bruk_gravatar_single_post_color');
$default = get_option('default_gravatar');
$use_mbl = get_option('bruk_mbl_ikon');
$gravatar_author_archive = get_option('bruk_gravatar_author_archive');
$gravatar_author_archive_link = get_option('bruk_gravatar_author_archive_link');
$profile_box_css_temp = get_option('bruk_gravatar_single_box_css');
$profile_img_css_temp = get_option('bruk_gravatar_single_img_css');
		if ($pre_text != '') {
			$pre_text_temp = $pre_text;
			}else{
			$pre_text_temp = "This is some text prior to the author information. You can change this text from the admin section of WP-Gravatar";
			}
		
		if ($gravatar_text_color != '') {
			$gravatar_text_color_temp = $gravatar_text_color;
			}else{
			$gravatar_text_color_temp = "c3c5c3";
			}
$bruk_gravatar_single_img_size = get_option('bruk_gravatar_single_img_size');
		if ($bruk_gravatar_single_img_size == '' || $bruk_gravatar_single_img_size == ' ') {
			$bruk_gravatar_single_img_size = "30";
			}else{
			$bruk_gravatar_single_img_size = $bruk_gravatar_single_img_size;
			}
$before_profile_box = "<hr style='width:100%;'/>";
if ($profile_box_css_temp == '' || $profile_box_css_temp == ' '){
		$profile_box_css = "<p style='font-size:9px; text-align: left;";
		$profile_box_css .= "color:#";
		$profile_box_css .= $gravatar_text_color_temp;
		$profile_box_css .= ";'/>";
		}else{
		$profile_box_css = "<p style='";
		$profile_box_css .= $profile_box_css_temp;
		$profile_box_css .= "color:#";
		$profile_box_css .= $gravatar_text_color_temp;
		$profile_box_css .= ";'/>";
		}
if ($profile_img_css_temp == '' || $profile_img_css_temp == ' '){
		$profile_img_css = "style='float: right; border: none;'";
		}else{
		$profile_img_css = "style='";
		$profile_img_css .= $profile_img_css_temp;
		$profile_img_css .= "'";
		}
$bruk_gravatar_single_img_size_temp = "'";
$bruk_gravatar_single_img_size_temp .= $bruk_gravatar_single_img_size;
$bruk_gravatar_single_img_size_temp .= "px'";
$after_profile_box = "</p><hr style='width:100%;'/>";
	if($post_single_gravatar == true && is_single()){
       	$epost = get_the_author_email();
       	$gravatar_user_id = get_the_author_id();
       	$userdata = get_userdata($gravatar_user_id);
       	if ($userdata->description == '') { 
			$user_info = "To change this standard text, you have to enter some information about your self in the <em>Dashboard</em> -> <em>Users</em> -> <em>Your Profile</em> box.";
			}else{
			$user_info = $userdata->description; 
			}
		if ($use_mbl == true && $default == get_option('default_gravatar')){
        	$default = "http://pub.mybloglog.com/coiserv.php?href=mailto:" . $lowercase . "&amp;n=". $lowercase;
        	}
        $lowercase = strtolower($epost);
        $md5 = md5($lowercase);
        $content=$s;
        $author = get_the_author();
		$pre_author_text = "$pre_text_temp";
		$user_image = "<img $profile_img_css src='http://www.gravatar.com/avatar/$md5&amp;default=$default' alt='' width=$bruk_gravatar_single_img_size_temp height=$bruk_gravatar_single_img_size_temp/>";
		$s = "$before_profile_box $profile_box_css $user_image <strong>$pre_author_text</strong>&nbsp;$user_info ";
		if ($gravatar_author_archive == true){
			$s.= "<a href='/author/";
			$s.= $author;
			$s.= "/'>";
			$s.= $gravatar_author_archive_link;
			$s.= "</a>";
			$s.= $after_profile_box;
			}else{
			$s.= $after_profile_box;
			}
		if ($gravatar_single_post_top == false){
			$s="$content".$s;
		}else{
			$s=$s."$content";
		}
	}
return $s;



}

function widget_authdescription_init() {

	// Check for the required API functions
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;

	// This saves options and prints the widget's config form.
	function widget_authdescription_control() {
		$options = $newoptions = get_option('widget_authdescription');
		if ( $_POST['authdescription-submit'] ) {
			$newoptions['title'] = strip_tags(stripslashes($_POST['authdescription-title']));
			$newoptions['alignall'] = strip_tags(stripslashes($_POST['authdescription-alignall']));
					$alignall = $newoptions['alignall'];
					if ($alignall == "left")       {$imgalign = 'float:left;margin:5px;';}
					elseif ($alignall == "center") {$imgalign = 'display:block;margin:5px auto 0 auto;';}
					elseif ($alignall == "right")  {$imgalign = 'float:right;margin:5px;';}
					else echo 'Pick alignment again...';
				$newoptions['imgalign'] = $imgalign;
			$newoptions['bordercolor'] = strip_tags(stripslashes($_POST['authdescription2-bordercolor']));
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('widget_authdescription', $options);
		}
		$imgalign = htmlspecialchars($options['imgalign'], ENT_QUOTES);
		$bordercolor = htmlspecialchars($options['bordercolor'], ENT_QUOTES);
	?>
				<div style="text-align:right">
				<label for="authdescription-title" style="line-height:35px;display:block;">Titel: <input type="text" id="authdescription-title" name="authdescription-title" value="<?php echo htmlspecialchars($options['title']); ?>" /></label>
				<input type="hidden" name="authdescription-submit" id="authdescription-submit" value="1" />
				</div>
	<?php
	}

	// This prints the widget
	function widget_authdescription($args) {
	global $wp_query, $blogownerid, $wpdb, $blog_id;
		extract($args);
		$defaults = array('count' => 10, 'username' => 'wordpress');
		$options = (array) get_option('widget_authdescription');
		$bordercolor = $options['bordercolor'];
		foreach ( $defaults as $key => $value )
			if ( !isset($options[$key]) )
				$options[$key] = $defaults[$key];
?>
		<?php echo $before_widget; ?>
	
<h2><?php echo $options['title']?></h2>
<?php	
	$gravatar_uid = get_option('bruk_gravatar_uid');
	if ($gravatar_uid != ' '){
		$temp_uid = $gravatar_uid;
		}else{
		$temp_uid = '1';
		}
	$blogownerid = $temp_uid;
	$userdata = get_userdata($blogownerid); 
 if ($userdata->description != '') { 
	$profile_data = $userdata->description; 
	} else {
	$profile_data = 'This is the default text. To change this, add some info about you in the Admin area';
	}
	$default = get_option('default_gravatar');
	$gravatar_uid = get_option('bruk_gravatar_uid');
	if ($gravatar_uid != ' '){
		$temp_uid = $gravatar_uid;
		}else{
		$temp_uid = '1';
		}
	$blogownerid = $temp_uid;
	$epost = $wpdb->get_var("SELECT user_email FROM $wpdb->users WHERE ID=".$blogownerid."");
	$lowercase = strtolower($epost);
	$md5 = md5($lowercase);
	$author_img_size = get_option('bruk_gravatar_single_img_size_author');
	$gravatar_profil = get_option('bruk_gravatar_profil');
	$profile_url = get_bloginfo('url');
	$profile_url .= '/';
	$profile_url .= get_option('default_profilepage');
	$profile_url .= '/';
	if($gravatar_profil == true){
	echo $before_widget . $before_title . $title . $after_title . "<ul>\n";
	echo "<a href='$profile_url'><img style='float: left; margin-right: 10px; border: none;' src='http://www.gravatar.com/avatar/$md5?size=$author_img_size&amp;default=$default' alt='' /></a>";
	}
	echo $profile_data;
	echo "</ul>\n" . $after_widget;	
	}

	// Tell Dynamic Sidebar about our new widget and its control
	register_sidebar_widget('Author Profile', 'widget_authdescription');
	register_widget_control('Author Profile', 'widget_authdescription_control');

}

 //Widget for recent comments with Gravatars
 
 function widget_recent_comments_gravatars($args) {
	global $wpdb, $comments, $comment;
	extract($args);
	$openavatar = get_option('bruk_openavatar');
	$options = get_option('widget_recent_comments_gravatars');
	$default = get_option('default_gravatar');
	$use_favico = get_option('bruk_gravatar_favico');
	$use_mbl = get_option('bruk_mbl_ikon');
	$gravatar_home_url = get_option('bruk_gravatar_home_url');
	$gravatar_url = get_option('bruk_gravatar_url');
	$gravatar_rating = get_option('bruk_gravatar_rating');
	if ($gravatar_rating == '' || $gravatar_rating == ' ') {
			$gravatar_rating = "X";
			}else{
			$gravatar_rating = $gravatar_rating;
			}
	$title = empty($options['title']) ? __('Recent Comments Gravatars') : $options['title'];
	if ( !$number = (int) $options['number'] )
		$number = 5;
	else if ( $number < 1 )
		$number = 1;
	else if ( $number > 15 )
		$number = 15;

		$comments = $wpdb->get_results("SELECT comment_author, comment_author_email, comment_author_url, comment_ID, comment_post_ID FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date_gmt DESC LIMIT $number");
	
?>

		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul id="recentcomments_gravs"><?php
			if ( $comments ) : foreach ($comments as $comment) :
				global $comment;
				$default = get_option('default_gravatar');
				$epost = $comment->comment_author_email;
				$lowercase = strtolower($epost);
				$lenke_temp = $comment->comment_author_url;
						if ( $lenke_temp == 'http://' || $lenke_temp == '') {
        					$lenke = get_option('home');
        				}else{
        				$lenke = $comment->comment_author_url;
        		
        			if ($use_favico == true){
        				$favicon_url = getFavicon($lenke);
    						$default = $favicon_url;
    					if ($default == '')
    						$default = get_option('default_gravatar');
    					}
        		
        		}
        		
				
        		 
        		if ($use_mbl == true && $default == get_option('default_gravatar') && get_option('bruk_openavatar') == false){
        		$default = "http://pub.mybloglog.com/coiserv.php?href=mailto:" . $lowercase . "&amp;n=". $lowercase;
        			}
       
		//OpenAvatar section
        if ( $default = get_option('default_gravatar') && $openavatar == true) {
        if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
        	$comment_url = '';
        	}else{
        	$comment_url = $comment->comment_author_url;
        	}
        	if (parse_url($comment_url, PHP_URL_PATH)=='')
        	{
			if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
			$default = get_option('default_gravatar');
			}else{
			$com_url = $comment->comment_author_url;
			if (stristr($com_url, 'myopenid') == true) {
			$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  			}else {
  			$default = get_option('default_garvatar');
  			}}}
		else
 			{
 			if ( $comment->comment_author_url == 'http://' || $comment->comment_author_url == '') {
			$default = get_option('default_gravatar');
			}else{
			$com_url = $comment->comment_author_url;
			if (stristr($com_url, 'myopenid') == true) {
			$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  			}else {
  			$default = get_option('default_garvatar');
  			}}}
        if ($use_mbl == true && $default == get_option('default_gravatar')){
        	$default = "http://pub.mybloglog.com/coiserv.php?href=mailto:" . $lowercase . "&amp;n=". $lowercase;
        	}
        	}
        // End of OpenAvatar Section
         		if (get_option('bruk_wavatar_default') == true){
         		if (stristr($com_url, 'myopenid') == true) {
				$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  				}else {
  				$default = 'wavatar';
				}}
			if (get_option('bruk_identicon_default') == true){
				if (stristr($com_url, 'myopenid') == true) {
				$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  				}else {
  				$default = 'identicon';
				}}
			if (get_option('bruk_monsterid_default') == true){
				if (stristr($com_url, 'myopenid') == true) {
				$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  				}else {
  				$default = 'monsterid';
				}}
			if (get_option('bruk_own_default') == true){
				if (stristr($com_url, 'myopenid') == true) {
				$default = "http://www.openvatar.com/avatar.php?openvatar_id=".md5($comment->comment_author_url);
  				}else {
  				$default = get_option('default_gravatar');
				}}
			$lenke2 = '<a href="'.$lenke.'">'.$comment->comment_author.'</a>';
				if ($gravatar_url == false && $gravatar_home_url == true){
					if ($lenke == get_option('home')){
						$lenke2 = $comment->comment_author;}
			if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback'){
						$default = $default;}
					echo  '<li class="recentcomments_gravs"><img style="float: left; margin-right: 10px; border: none; size: 10px" src="http://www.gravatar.com/avatar/' . md5($lowercase) . '?rating=' . $gravatar_rating . '&default='.$default.'"&amp;size=20 height="20px" width="20px" alt=""/>' . sprintf(__('%1$s on %2$s'), $lenke2 , '<a href="'. get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
					
				}else{
				if ($gravatar_home_url == false){
					$lenke2 = $comment->comment_author;}
					if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
						$default = $default;}
					echo  '<li class="recentcomments_gravs"><img style="float: left; margin-right: 10px; border: none; size: 10px" src="http://www.gravatar.com/avatar/' . md5($lowercase) . '?rating=' . $gravatar_rating . '&amp;size=20&amp;default=' . $default . ' height="20px" width="20px" alt=""/>' . sprintf(__('%1$s on %2$s'), $lenke2 , '<a href="'. get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
				}
			endforeach; endif;?></ul>
		<?php echo $after_widget; ?>
<?php
}

function wp_delete_recent_comments_cache_gravatars() {
	wp_cache_delete( 'recent_comments_gravatars', 'widget' );
}

function widget_recent_comments_control_gravatars() {
	$options = $newoptions = get_option('widget_recent_comments_gravatars');
	if ( $_POST["recent-comments-submit_gravatars"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["recent-comments-title_gravatars"]));
		$newoptions['number'] = (int) $_POST["recent-comments-number_gravatars"];
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_recent_comments_gravatars', $options);
		wp_delete_recent_comments_cache();
	}
	$title = attribute_escape($options['title']);
	if ( !$number = (int) $options['number'] )
		$number = 5;
?>
			<p><label for="recent-comments-title_gravatars"><?php _e('Title:'); ?> <input style="width: 250px;" id="recent-comments-title_gravatars" name="recent-comments-title_gravatars" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="recent-comments-number_gravatars"><?php _e('Number of comments to show:'); ?> <input style="width: 25px; text-align: center;" id="recent-comments-number_gravatars" name="recent-comments-number_gravatars" type="text" value="<?php echo $number; ?>" /></label> <?php _e('(at most 15)'); ?></p>
			<input type="hidden" id="recent-comments-submit_gravatars" name="recent-comments-submit_gravatars" value="1" />
<?php
}

function widget_recent_comments_style_gravatars() {
?>
<style type="text/css">.recentcomments_gravs a{display:inline; !important;padding: -2em; !important;margin: 0; !important;} </style>
<?php
}

function widget_recent_comments_gravatars_register() {
global $wp_version;
if (!function_exists('register_sidebar_widget')) {
		return;
	}
	$width = 320;
	$height = 90;
	if ( '2.1' == $wp_version || '2.2' == $wp_version || (!function_exists( 'wp_register_sidebar_widget' ))) {
		register_sidebar_widget('Recent Comments Gravatars', 'widget_recent_comments_gravatars');
		register_widget_control('Recent Comments Gravatars', 'widget_recent_comments_control_gravatars', $width, $height);
	} else {
		// v2.2.1+

	$dims = array('width' => 320, 'height' => 90);
	$class = array('classname' => 'widget_recent_comments_gravatars');
	wp_register_sidebar_widget('recent-comments_gravatars', __('Recent Comments Gravatars'), 'widget_recent_comments_gravatars', $class);
	wp_register_widget_control('recent-comments_gravatars', __('Recent Comments Gravatars'), 'widget_recent_comments_control_gravatars', $dims);
}
	if ( is_active_widget('widget_recent_comments_gravatars') )
		add_action('wp_head', 'widget_recent_comments_style_gravatars');
}

// End of widget for Recent Comments with Gravatars

//Trying to use favico.ico if no Gravatar exists and the user has left an URL to use

function comment_favicon($before='<img src="', $after='" alt="" />') {
	global $comment, $wpdb;
    
     $posters_url = $wpdb->get_var("SELECT comment_author_url FROM `$wpdb->comments` WHERE `comment_ID` = '$comment_ID'");
	//$favicon_url = $wpdb->get_var("SELECT comment_favicon_url FROM `$wpdb->comments` WHERE `comment_ID` = '$comment->comment_ID'");
	if(!empty($posters_url))  
		if( $favicon_url = getFavicon($posters_url) )
    
    if(!empty($favicon_url))
		echo($before . $favicon_url . $after);
}



function getFavicon($url) {

	// start by fetching the contents of the URL they left...
	if( $html = @file_get_contents($url) ) {

		if (preg_match('/<link[^>]+rel="(?:shortcut )?icon"[^>]+?href="([^"]+?)"/si', $html, $matches)) {
			// Attempt to grab a favicon link from their webpage url

			$linkUrl = html_entity_decode($matches[1]);
			if (substr($linkUrl, 0, 1) == '/') {
				$urlParts = parse_url($url);
				$faviconURL = $urlParts['scheme'].'://'.$urlParts['host'].$linkUrl;
			} else if (substr($linkUrl, 0, 7) == 'http://') {
				$faviconURL = $linkUrl;
			} else if (substr($url, -1, 1) == '/') {
				$faviconURL = $url.$linkUrl;
			} else {
				$faviconURL = $url.'/'.$linkUrl;
			}

		} else {
			// If unsuccessful, attempt to "guess" the favicon location

			$urlParts = parse_url($url);
			$faviconURL = $urlParts['scheme'].'://'.$urlParts['host'].'/favicon.ico';

		}

		// Run a test to see if what we have attempted to get actually exists.
		if( $faviconURL_exists = url_validate($faviconURL) )
			return $faviconURL;

	} 

	// Finally, if we haven't 'returned' yet then there is nothing to see here.
	return false;
}

//Trying to validate the URL

function url_validate( $link ) {
		
	$url_parts = @parse_url( $link );

	if ( empty( $url_parts["host"] ) )
		return false;

	if ( !empty( $url_parts["path"] ) ) {
		$documentpath = $url_parts["path"];
	} else {
		$documentpath = "/";
	}

	if ( !empty( $url_parts["query"] ) )
		$documentpath .= "?" . $url_parts["query"];

	$host = $url_parts["host"];
	$port = $url_parts["port"];
	
	if ( empty($port) )
		$port = "80";

	$socket = @fsockopen( $host, $port, $errno, $errstr, 30 );
	
	if ( !$socket )
		return false;
		
	fwrite ($socket, "HEAD ".$documentpath." HTTP/1.0\r\nHost: $host\r\n\r\n");

	$http_response = fgets( $socket, 22 );

	$responses = "/(200 OK)|(30[0-9] Moved)/";
	if ( preg_match($responses, $http_response) ) {
		fclose($socket);
		return true;
	} else {
		return false;
	}

}

function ShowGravatar($id) {
	global $wp_query, $wpdb;
	$userdata = get_userdata($id); 
		 if ($userdata->description != '') { 
			$user_info = $userdata->description; 
			}else{
			$user_info = "To change this standard text, you have to enter some information about your self in the <em>Dashboard</em> -> <em>Users</em> -> <em>Your Profile</em>.";
			}
	$epost = $wpdb->get_var("SELECT user_email FROM $wpdb->users WHERE ID=".$id."");
	$lowercase = strtolower($epost);
	$md5 = md5($lowercase);
	$author_img_size = get_option('bruk_gravatar_single_img_size_author');
	$avatar = "<img style='float: left; margin-right: 10px; border: none;' src='http://www.gravatar.com/avatar/$md5?size=$author_img_size&amp;default=$default' alt='' />";
	echo "<br/><div class='title'><ul>\n $avatar $user_info</div></ul>\n<br/>";
}
	

//remove_filter('comment_text','');
$show_gravatar_placement = 'comment_text';
add_action('admin_menu', 'gravatar_admin_menu');
add_filter('get_comment_author_link', 'show_gravatar',9);
add_filter('the_content', 'show_gravatar_post',10);
if (is_admin() && get_option('bruk_gravatar_admin') == true){
add_filter('comment_text', 'show_gravatar_edit',1);
}

if (get_option('bruk_gravatar_kudos') == true && get_option('bruk_gravatar') == true){
	add_filter('wp_footer', 'gravatar_footer',9);
}
add_filter('the_content', 'gravatar_single_post',10);
add_action('plugins_loaded', 'widget_authdescription_init');
add_action('plugins_loaded', 'widget_recent_comments_gravatars_register', 1);
if (get_option('bruk_openavatar')==true && get_option('bruk_openavatar_show')==true){
add_filter('comment_form', 'show_openid',10 );
}

?>