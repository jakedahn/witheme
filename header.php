<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head profile="http://gmpg.org/xfn/11">
  <title><?php wp_title(''); ?> <?php if ( !( is_404() ) && ( is_single() ) or ( is_page() ) or ( is_archive() ) ) { ?> &middot; <?php } ?> <?php bloginfo('name'); ?></title>
  <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="description" content="<?php bloginfo('description'); ?>" />
  <meta name="Robots" content="index,all" />
  <link rel="stylesheet"  href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
  <link rel="start" href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>" />
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  </head>

  <body>
  
    <div id="wrapper">
      <div id="header">
        <h1 id="blog-title"><a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
        <p id="blog-description">AWAKE <span>AND</span> LISTENING</p>
        <div id="weeklytopic">
          <p id="wtopic">WEEKLY TOPIC</p>
          <p class="topicname">The 'Still Fresh' Effect That Gets To Us All:</p>
          <p class="topiclink"><a href="#">C'mon you know what I'm talkin' about</a></p>
        </div>
      </div>
      <div id="headerimage">
        <img src="http://wakingideas.com/wordpress/wp-content/images/header/h2.jpg" alt="" />
      </div>