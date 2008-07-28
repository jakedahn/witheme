    <div id="middlebar">
      <ul id="catnav">
        <li<?php if (is_home()) { echo " class=\"active\"";}?>><a href="<?php echo get_settings('home'); ?>">The Front Page</a><a href="<?php echo get_settings('home'); ?>"><img src="http://looce.com/wordpress/wp-content/themes/wakingideas/images/feedicon.png" alt="Subscribe to RSS" /></a></li>
        
        <li<?php if (is_category('6')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('6');?> ">Life Stories</a></li>
        <li<?php if (is_category('8')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('8');?> ">Music</a></li>
        <li<?php if (is_category('9')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('9');?> ">Photography</a></li>
        <li<?php if (is_category('10')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('10');?> ">Politics</a></li>
        <li<?php if (is_category('11')) { echo " class=\"active\"";}?>> <a href="<?php echo get_category_link('11');?> ">Popular Culture</a></li>

        
      </ul>
      <h3>Issue Highlights</h3>
      <ul id="highlights">
        <?php c2c_get_recent_posts($num_posts=5,  $format = "<li><span class=\"linkauthor\">%post_author%</span> <br /> <div class=\"linkdesc\"><img src=\"http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png\" alt=\"link\" /> %post_excerpt%</div></li>"); ?>
      </ul>    
    </div>

    <div id="sidebar"> 
      <h3>Outside the Box</h3>
      <ul>
      <?php c2c_get_recent_posts($num_posts=7,  $format = "<li><span class=\"linkauthor\">%post_author%</span> <br /> <div class=\"linkdesc\"><img src=\"http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png\" alt=\"link\" /> %post_content%</div></li>", $categories = '7'); ?>
      </ul>
    </div> 
