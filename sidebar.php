    <div id="middlebar">
      <ul id="catnav">
        <li<?php if (is_home()) { echo " class=\"active\"";}?>><a href="<?php echo get_settings('home'); ?>">The Front Page</a><a href="<?php echo get_settings('home'); ?>"><a href="<?php bloginfo('rss2_url'); ?>"><img style="margin-top: -25px;" src="http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/feedicon.png" alt="Subscribe to RSS" /></a></a></li>
        
        <li<?php if (is_category('6')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('6');?> ">Life Stories</a></li>
        <li<?php if (is_category('8')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('8');?> ">Music</a></li>
        <li<?php if (is_category('9')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('9');?> ">Photography</a></li>
        <li<?php if (is_category('10')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('10');?> ">Politics</a></li>
        <li<?php if (is_category('11')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('11');?> ">Popular Culture</a></li>

        
      </ul>
      <h3>Recent Articles</h3>
      <ul id="highlights">
        <?php query_posts("showposts=7"); ?>
              <?php while (have_posts()) : the_post(); ?>    
            <li>
              <span class="highlightlink"><img src="http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png" alt="link" /> <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
              </span>
              <?php the_content_rss('', TRUE, '', 30); ?>
            </li>
          <?php endwhile; ?>
      </ul>    
    </div>

    <div id="sidebar"> 
      <h3>Outside the Box</h3>
      <ul>
      <?php c2c_get_recent_posts($num_posts=5,  $format = "<li><span class=\"linkauthor\">%post_author%</span> <br /> <div class=\"linkdesc\"><img src=\"http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png\" alt=\"link\" /> %post_content%</div></li>", $categories = '7'); ?>
      </ul>
    </div>
