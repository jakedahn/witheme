<?php
/*
TEMPLATE NAME: Links
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
<?php $link_cats = $wpdb->get_results("SELECT cat_id, cat_name FROM $wpdb->linkcategories"); foreach ($link_cats as $link_cat) { ?>
					<div id="linkcat-<?php echo $link_cat->cat_id; ?>">
						<h3 style="margin-bottom:0;"><?php echo $link_cat->cat_name; ?></h3>
						<ul>
							<?php wp_get_links($link_cat->cat_id); ?>
						</ul>
					</div>
<?php } ?>
					<!-- <?php trackback_rdf(); ?> -->
				</div><!-- END POST-ENTRY -->
			</div><!-- END POST -->

<?php endwhile; endif; ?>

		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>