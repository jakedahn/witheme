<?php get_header(); ?>
	
	<div id="container">

		<div id="content">

<?php if (have_posts()) : ?>

			<h2 class="page-title">Search Results: &#8220;<?php echo wp_specialchars($s); ?>&#8221;</h2>
		
<?php while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="post">
				<h3 class="post-title"><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<p class="post-date"><?php the_time('F jS Y') ?></p>
				<div class="post-entry">
					<?php the_excerpt(); ?>
					<!-- <?php trackback_rdf(); ?> -->
				</div><!-- END POST-ENTRY -->
				<p class="post-footer">Posted in <?php the_category(', ') ?> | <a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="permalink">Permalink</a> | <?php edit_post_link('Edit', '', ' | '); ?> <?php comments_popup_link('Comments (0)', 'Comments (1)', 'Comments (%)'); ?></p>
			</div><!-- END POST -->

<?php endwhile; ?>

			<div class="navigation">
				<div class="nav-left"><?php next_posts_link('&laquo; Older posts') ?></div>
				<div class="nav-right"><?php previous_posts_link('Newer posts &raquo;') ?></div>
			</div><!-- END NAVIGATION -->

<?php else : ?>

			<div id="post-error" class="post">
				<h2 class="page-title" style="margin-bottom:0;">Nothing Found</h2>
				<div class="post-entry">
					<p>Sorry, but &#8220;<?php echo wp_specialchars($s); ?>&#8221; yielded 0 results. Please change your criteria and try your search again.</p>
					<form id="search-searchform" method="get" action="<?php bloginfo('home'); ?>/">
						<p><input id="search-s" name="search-s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" tabindex="1" size="20" /> <input id="search-searchsubmit" name="search-searchsubmit" type="submit" value="Find" tabindex="2" /></p>
					</form> 
				</div><!-- END POST-ENTRY  -->
			</div><!-- END POST -->

<?php endif; ?>

		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>