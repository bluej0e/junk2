<?php get_header(); /* Template Name: dota */?>

<div class="row">

	<div class="twelve columns">
	    
		<div class="row"> 

			<div class="eight columns">

<br>

<h1>DOTA</h1>


<br>
<br>

				<hr />


				<h3>More Stories:</h3>
				<?php
				$args = array(
					'posts_per_page'   => 3,
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'post_status'      => 'publish',
				);
				 
				$ultimos = new WP_Query( $args );
				 
				if ( $ultimos->have_posts() ) {
					while ( $ultimos->have_posts() ) {		
						$ultimos->the_post();
				?>
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

				<?php	
					}
				} else {
					
				echo 'No more posts.';	
				}
				wp_reset_postdata();
				?>

			</div>


				            
			<div class="four columns">
				          
				<?php include ('side.php'); ?>

			</div>

		</div>

	</div> 

</div>

<?php get_footer(); ?>