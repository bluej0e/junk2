<?php get_header(); ?>
<div class="row">

	<div class="twelve columns">
    
		<div class="row"> 

			<div class="eight columns">

				<h1><img src="http://www.bet-esport.com/i/<?php echo single_cat_title(); ?>-cat.png"  <?php single_cat_title(''); ?> </h1>
				<p><?php echo category_description(); ?></p>
				<hr />

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<a href="<?php the_permalink(); ?>">

					<div>

					<?php
					if ( has_post_thumbnail() ) {
					    the_post_thumbnail();
					}
					?>

					</div>

				<h2><?php the_title();?></h2>
				<?php the_excerpt(); ?>
				</a> 

				<hr />
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

					<div>

						<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>

						<div class="prev"><h3><?php next_posts_link(__( '&laquo; Older posts', 'zen' )) ?></h3></div>

						<div class="next"><h3><?php previous_posts_link(__( 'Newer posts &raquo;', 'zen' )) ?></h3></div>

						<?php } ?>

					</div>

			</div>

			<div class="four columns">
          		<?php include ('side.php'); ?>
          	</div>

		</div>

	</div> 

</div>

<?php get_footer(); ?>