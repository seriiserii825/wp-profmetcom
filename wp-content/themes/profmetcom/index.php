<?php 
/**
 * Template Name: Все записи
 */
?>
<?php get_header(); ?>
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		  	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		  	<?php the_excerpt(); ?>
		  <?php endwhile; ?>
		  <!-- post navigation -->
		  <?php else: ?>
		  <!-- no posts found -->
		<?php endif; ?>
	</div>
<?php get_footer(); ?>