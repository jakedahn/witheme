<?php get_header(); ?>
<div id="content">
<?php if (have_posts()) : ?>
  <?php query_posts("cat=-7"); ?>
<?php while (have_posts()) : the_post(); ?>
  
  
        <div id="post-<?php the_ID(); ?>" class="post">
          <span class="series"><img src="http://wakingideas.com/wordpress/wp-content/themes/wakingideas/images/topicblock.png" alt="" /> Part of the <?php the_tags('', '', ''); ?> Series</span>
          <h2 class="post-title"><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
          <p class="post-date">Written by <strong><a href="<?php the_author_url(); ?>"><?php the_author(); ?></a></strong>. Posted on <strong><?php the_time('F jS Y') ?></strong></p>
          <div class="post-entry">
            <?php the_excerpt(); ?>
            <a class="more" href="<?php the_permalink(); ?>" title="Read More">Read and Comment »</a>
          </div><!-- END POST-ENTRY -->
         
        </div><!-- END POST -->

<?php comments_template(); ?>

<?php endwhile; ?>



<?php else : ?>

        <div id="post-error" class="post">
          <h2 class="post-title">Not Found</h2>
          <div class="post-entry">
            <p>Apologies. But something you were looking for just can't be found. Please have a look around or try searching for what you're looking for.</p>
          </div><!-- END POST-ENTRY  -->
        </div><!-- END POST -->

<?php endif; ?> 

    </div><!-- END CONTENT -->

<?php get_sidebar(); ?>
<?php include('belowfold.php') ?>
<?php get_footer(); ?>