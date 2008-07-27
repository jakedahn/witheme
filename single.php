<?php get_header(); ?>
	
	<div id="container">

		<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			<div class="navigation">
				<div class="nav-left"><?php previous_post_link('&laquo; %link') ?></div>
				<div class="nav-right"><?php next_post_link('%link &raquo;') ?></div>
			</div><!-- END NAVIGATION -->

			<div id="post-<?php the_ID(); ?>" class="post">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<div class="post-entry">
					<?php the_content('<span class="more-link">Continue Reading &raquo;</span>'); ?>
					<?php link_pages('<p class="page-link">Pages: ', '</p>', 'number'); ?>
					<!-- <?php trackback_rdf(); ?> -->
				</div><!-- END POST-ENTRY -->
				<p id="single-post-footer">
					This entry was posted on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?> and is filed under <?php the_category(', ') ?>. You can follow any responses to this entry through the <?php comments_rss_link('RSS 2.0'); ?> feed.
<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) { // COMMENTS & PINGS OPEN ?>
					<a href="#respond">Post a comment</a> or leave a trackback: <a href="<?php trackback_url(true); ?>" rel="trackback">Trackback URI</a>.
<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) { // PINGS ONLY OPEN ?>
					Comments are closed, but you can leave a trackback: <a href="<?php trackback_url(true); ?>" rel="trackback">Trackback URI</a>.
<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { // COMMENTS OPEN ?>
					Trackbacks are closed, but you can <a href="#respond">post a comment</a>.
<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) { // NOTHING OPEN ?>
					Both comments and trackbacks are currently closed.			
<?php } edit_post_link('Edit this entry.','',''); ?>
				</p>
			</div><!-- END POST -->

<?php comments_template(); ?>

<?php endwhile; else: ?>

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