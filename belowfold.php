<div id="randompost">
  <?php random_posts(); ?>
</div>

<div id="categorylistings">
  <div class="column" id="firstcol">
    <h3 id="culture">Culture</h3>
    <ul id="culture">
      <?php query_posts("showposts=3&cat=11"); ?>
            <?php while (have_posts()) : the_post(); ?>    
          <li>
            <span class="highlightlink"><img src="http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png" alt="link" /> <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </span>
            <?php the_excerpt()?>
          </li>
        <?php endwhile; ?>
    </ul>
  </div>
  
  <div class="column">
    <h3 id="politics">Politics</h3>
    <ul id="politics">
      <?php query_posts("showposts=3&cat=10"); ?>
            <?php while (have_posts()) : the_post(); ?>    
          <li>
            <span class="highlightlink"><img src="http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png" alt="link" /> <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </span>
            <?php the_excerpt()?>
          </li>
        <?php endwhile; ?>
    </ul>
  </div>
  
  <div class="column">
    <h3 id="music">Music</h3>
    <ul id="music">
      <?php query_posts("showposts=3&cat=8"); ?>
            <?php while (have_posts()) : the_post(); ?>    
          <li>
            <span class="highlightlink"><img src="http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png" alt="link" /> <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </span>
            <?php the_excerpt()?>
          </li>
        <?php endwhile; ?>
    </ul>
  </div>
  
  <div class="column">
    <h3 id="lifestories">Life Stories</h3>
    <ul id="lifestories">
      <?php query_posts("showposts=3&cat=6"); ?>
            <?php while (have_posts()) : the_post(); ?>    
          <li>
            <span class="highlightlink"><img src="http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/icon_track.png" alt="link" /> <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </span>
            <?php the_excerpt()?>
          </li>
        <?php endwhile; ?>
    </ul>
  </div>
</div>