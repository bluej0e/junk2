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
				<?php if(get_the_tag_list()) {
				echo get_the_tag_list('<ul class="buttonlink"><li class="buttonlink">','</li><li class="buttonlink">','</li>
				</ul>');
				} ?>

				<hr />

				<div class="prev"><h4><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></h4></div>

				<div class="next"><h4><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></h4></div>
			                        
			</div>

			<div class="four columns">
			          
				<?php include ('side.php'); ?>

			</div>

		</div>

	</div> 

</div>

<?php get_footer(); ?>