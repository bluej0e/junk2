<?php get_header(); /* Template Name: FEED TEST */?>
<div class="row">
	<div class="twelve columns">
		<div class="row">
			<div class="eight columns">
				<h1><?php echo get_the_title(); ?></h1>
				<?php the_post(); 
				the_content(); ?>

				<div id="iframediv">
					<iframe width="100%" height="300px" style="overflow:hidden;" src="http://www.bet-esport.com/table-iframe/"></iframe> 
				</div>	
				
				<!--div id="myInfoDiv" seamless="seamless" scrolling="no" style="width:100%; height: 100%; float: left; color: #FFF; background:#ed8719; line-height:100%; font-size:100%;" -->



			
            <div>
                </div>
            </div>
			<div class="four columns">
				<?php include ('side.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>