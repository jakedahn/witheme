<div id="randompost">
  <?php random_posts(); ?>
</div>

<div id="categorylistings">
  <div class="column" id="firstcol">
    <h3 id="culture">Culture</h3>
    <ul id="culture">
      <?php c2c_get_recent_posts($num_posts=5,  $format = "<li><span class=\"highlightlink\"><img src=\"http://looce.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png\" alt=\"link\" />  %post_URL%</span><br /> %post_excerpt_short%</li>", $categories = '11'); ?>
    </ul>
  </div>
  
  <div class="column">
    <h3 id="politics">Politics</h3>
    <ul id="politics">
       <?php c2c_get_recent_posts(); ?>
    </ul>
  </div>
  
  <div class="column">
    <h3 id="music">Music</h3>
    <ul id="music">
       <?php c2c_get_recent_posts($num_posts=5,  $format = "<li><span class=\"highlightlink\"><img src=\"http://looce.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png\" alt=\"link\" />  %post_URL%</span><br /> %post_excerpt_short%</li>", $categories = '9'); ?>
    </ul>
  </div>
  
  <div class="column">
    <h3 id="lifestories">Life Stories</h3>
    <ul id="lifestories">
       <?php c2c_get_recent_posts($num_posts=5,  $format = "<li><span class=\"highlightlink\"><img src=\"http://looce.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png\" alt=\"link\" />  %post_URL%</span><br /> %post_excerpt_short%</li>", $categories = '6'); ?>
    </ul>
  </div>
</div>