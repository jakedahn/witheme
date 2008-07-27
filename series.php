<?php
/*
Template Name: Series
*/
?>

<?php get_header(); ?>

<div id="content" class="narrowcolumn">

<?php

 $querystr = "
    SELECT wposts.* 
    FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
    WHERE wposts.ID = wpostmeta.post_id 
    AND wpostmeta.meta_key = 'tag' 
    AND wpostmeta.meta_value = 'email' 
    AND wposts.post_status = 'publish' 
    AND wposts.post_type = 'post' 
    AND wposts.post_date < NOW() 
    ORDER BY wposts.post_date DESC
 ";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?>
 <?php if ($pageposts): ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

    <div class="post" id="post-<?php the_ID(); ?>">
      <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
      <?php the_title(); ?></a></h2>
      <small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>
      <div class="entry">
         <?php the_content('Read the rest of this entry »'); ?>
      </div>
  
      <p class="postmetadata">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  
      <?php comments_popup_link('No Comments »', '1 Comment »', '% Comments »'); ?></p>
    </div>
  <?php endforeach; ?>
  
  <?php else : ?>
    <h2 class="center">Not Found</h2>
    <p class="center">Sorry, but you are looking for something that isn't here.</p>
    <?php include (TEMPLATEPATH . "/searchform.php"); ?>
 <?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
