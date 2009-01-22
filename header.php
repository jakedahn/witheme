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
        <div id="headcontainer">
          <div id="header">

            <h1 id="blog-title"><a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
            <p id="blog-description">AWAKE <span>AND</span> LISTENING</p>
        
          </div>
      
          <div id="search">
              <h2>Search for:</h2>
              <form id="search" method="get" action="<?php bloginfo('home'); ?>/">
      	
          		<input id="s" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" tabindex="1" size="20" />
          		<input id="searchsubmit" name="searchsubmit" type="submit" value="Search" tabindex="2" />

              </form>
          </div>
      
          <div id="headerimage">
            <img src="http://wakingideas.com/wordpress/wp-content/images/h2.jpg" alt="" />
          </div>
        </div>
      