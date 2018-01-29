<?php  get_header(); /* Template Name: Search*/ ?>

<div class="row">

	<div class="twelve columns">
	    
		<div class="row"> 

			<div class="eight columns">

				<h1>Search</h1>
				<h2>Search results for: "<?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e('" found '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h2>
				<hr />

				<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">

				<?php _e( 'Search', 'zen' ); ?>

				<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'zen' ); ?>" />

				<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'zen' ); ?>" />
				</form>

				<hr />

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h3><a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
				</a></h3>

				<hr />

				<?php endwhile; else: ?>
				<p><?php _e('Sorry, there is nothing to match your search'); ?></p>
				<?php endif; ?>

				<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>

				<div class="prev"><h4><?php next_posts_link(__( '&laquo; Previous Results', 'zen' )) ?></h4></div>

				<div class="next"><h4><?php previous_posts_link(__( 'Next Results &raquo;', 'zen' )) ?></h4></div>

				<?php } ?>

			</div>

			<br />
			<br />

			<div class="four columns">     
				<?php include ('side.php'); ?>
			</div>

		</div>
	</div>
</div>


<?php get_footer(); ?>
    
    
    
    