<?php get_header(); ?>
	
	<div id="container">

		<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php $attachment_link = get_the_attachment_link($post->ID, true, array(450, 800)); ?>
<?php $_post = &get_post($post->ID); $classname = ($_post->iconsize[0] <= 128 ? 'small' : '') . 'attachment'; ?>

			<div id="post-<?php the_ID(); ?>" class="post">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<p>Attachment from <cite><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment" title="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a></cite></p>
				<div class="post-entry">
					<p class="<?php echo $classname; ?>"><?php echo $attachment_link; ?></p>
					<p class="<?php echo $classname; ?>-filename">Click above for the file <?php echo basename($post->guid); ?></p>
					<?php the_content(); ?>	
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