    <div id="middlebar">
      <ul id="catnav">
        <li class="active"><a href="#">The Front Page</a><a href="<?php echo get_settings('home'); ?>"><img src="http://looce.com/wordpress/wp-content/themes/wakingideas/images/feedicon.png" alt="Subscribe to RSS"</a></li>
      	<?php wp_list_categories('sort_column=id&exclude=9,10&title_li='); ?>
      </ul>
      <h3>Issue Highlights</h3>
      <ul id="highlights">
        <?php c2c_get_recent_posts($num_posts=3,  $format = "<li><span class=\"highlightlink\"><img src=\"http://looce.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png\" alt=\"link\" />  %post_URL%</span><br /> %post_excerpt_short%</li>"); ?>
      </ul>    
    </div>

    <div id="sidebar">
      <h3>Outside the Box</h3>
      <ul>
      <?php c2c_get_recent_posts($num_posts=3,  $format = "<li><span class=\"linkauthor\">%post_author%</span> <br /> <div class=\"linkdesc\"><img src=\"http://looce.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png\" alt=\"link\" /> %post_content%</div></li>", $categories = '9'); ?>
      </ul>
    </div>
