<?php get_header(); ?>

<div class="row">

	<div class="twelve columns">
	    
		<div class="row"> 

			<div class="eight columns">

				<h1><?php echo get_the_title(); ?></h1>
				<?php the_post(); ?>
				<?php the_content(); ?>
				<br />
				<br />

				<hr />
			                    
			</div>

			<div class="four columns">
			          
				<?php include ('side.php'); ?>
			                        
			</div>

		</div>

	</div> 

</div>

<?php get_footer(); ?>