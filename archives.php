<?php
/*
TEMPLATE NAME: Archives
*/
?>
<?php get_header(); ?>
	
	<div id="container">

		<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="post">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<div class="post-entry">
					<?php the_content(); ?>
					<h3 style="margin-bottom:0;">By Category</h3>
					<ul>
						<?php wp_list_cats(); ?>
					</ul>
					<h3 style="margin-bottom:0;">By Month</h3>
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					</ul>
					<!-- <?php trackback_rdf(); ?> -->
				</div><!-- END POST-ENTRY -->
			</div><!-- END POST -->

<?php endwhile; endif; ?>

		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>