<?php get_header(); ?>
	
	<div id="container">

		<div id="content">

<?php if (have_posts()) : ?>

<?php $post = $posts[0]; // HACK FROM KUBRICK ?>
<?php /* IF CATEGORY ARCHIVE */ if (is_category()) { ?>				
			<span class="series"><img src="http://looce.com/wordpress/wp-content/themes/wakingideas/images/topicblock.png" alt="" /> <?php echo single_cat_title(); ?> Archive</span>
<?php /* IF MONTHY ARCHIVE */ } elseif (is_date()) { ?>
			<h2 class="page-title">Monthly Archives: <?php the_time('F Y'); ?></h2>
<?php /* IF ANOTHER PAGE OF ARCHIVES */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2 class="page-title">Blog Archives</h2>
<?php } ?>

<?php while (have_posts()) : the_post(); ?>
      <div id="post-<?php the_ID(); ?>" class="post">
        <h2 class="post-title"><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <p class="post-date">Written by <strong><?php the_author(); ?></strong>. Posted on <strong><?php the_time('F jS Y') ?></strong></p>
        <div class="post-entry">
          <?php the_excerpt('<span class="more-link">Continue Reading &raquo;</span>'); ?>
          <a href="<?php the_permalink(); ?>" title="Read More">Read More »</a>
        </div><!-- END POST-ENTRY -->

	
<?php endwhile; ?>

			<div class="navigation">
				<div class="nav-left"><?php next_posts_link('&laquo; Older posts') ?></div>
				<div class="nav-right"><?php previous_posts_link('Newer posts &raquo;') ?></div>
			</div><!-- END NAVIGATION -->
	
<?php else : ?>

			<div id="post-error" class="post">
				<h2 class="post-title">Not Found</h2>
				<div class="post-entry">
					<p>Apologies. But something you were looking for just can't be found. Please have a look around or try searching for what you're looking for.</p>
				</div><!-- END POST-ENTRY  -->
			</div><!-- END POST -->

<?php endif; ?>
		
		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>