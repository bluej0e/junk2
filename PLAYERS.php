<?php get_header(); /* Template Name: PLAYERS*/     ?>


<div class="row">

	<div class="twelve columns">

		<div class="row"> 

			<div class="eight columns">
				<h1><?php echo get_the_title(); ?></h1>

				<script>
					$(document).ready(function (){ 
						$('.showall').click(function(){
							$('.targetDiv').fadeIn();
						});
						$('.showSingle').click(function(){
							$('.targetDiv').fadeOut();
							$('#div'+$(this).attr('target')).fadeIn();
						});
					}); 
				</script>


			<div class="buttons">
				<button  class="showall btn btn-8 btn-8b"><img alt="Show All" src="http://www.bet-esport.com/i/showall.png"></button>
				<button  class="showSingle btn btn-8 btn-8b" target="1"><img alt="League of Legends" src="http://www.bet-esport.com/i/lol_300.png"></button>
				<button  class="showSingle btn btn-8 btn-8b" target="2"><img alt="Dota" src="http://www.bet-esport.com/i/dota_300.png"></button>
				<button  class="showSingle btn btn-8 btn-8b" target="3"><img alt="CS:GO" src="http://www.bet-esport.com/i/csgo_300.png"></button>
				<!--a  class="showSingle" target="4">Div 4</a-->
			</div>

				<?php //------------------------------------------------------------------------League--?>
			<div id="div1" class="targetDiv">
				<div class="grid_12">
					<h2>League of Legends Players</h2>
					<?php
					$args = array(
						'post_type' 		=> 'page',
						'posts_per_page' 	=> 300,
						'orderby'       	=> 'teamcode',
						'order'        	    => 'ASC',
						'meta_query' 		=> array

						(
							array(
								'key' => 'gametype',
								'value' => 'lol'),  

							array(
								'key' => 'pagetype',
								'value' => 'player'),

							array(
								'key' => 'teamcode'),
							)
						);


					$teams = new WP_Query( $args );

					if ( $teams->have_posts() ) {
						while ( $teams->have_posts() ) {		
							$teams->the_post();
							?>

							<a href="<?php the_permalink(); ?>">
								<table id="players"><tr><td width="120" height="145" align="center" valign="top">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('104');
									}
									?>
									<span class="textbox">
										<img width="16px"  src="http://www.bet-esport.com/i/lol-50.png"/> 
										<img width="19px"  src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("teamcode"); echo $values[0]; ?>-32x32.png"/> 
										<img width="15px"  src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("role"); echo $values[0]; ?>-18.png"/> 
										<img width="18px"  src="http://www.bet-esport.com/i/flags/32/<?php $values = get_post_custom_values("fullcountryname"); echo $values[0]; ?>-flag.png"/>  
										<br>  <strong><?php the_title();?></strong></span></td>
								</tr>
							</table>

						</a> 
						<?php	
					}
				} else {

					echo 'No Players found for League of Legends';	
				}
				wp_reset_postdata();
				?>
				<div style="clear:both"></div>
			</div>

</div>


<div id="div2" class="targetDiv">
			<?php //--------------------------------------------------------------------------dota--?>
			<div class="grid_12">
				<h2>Dota 2 Players</h2>

				<?php 

				$args = array(
					'post_type'         => 'page',
					'posts_per_page'    => 300,
					'meta_key'          => 'teamcode', 
					'orderby'           => 'meta_value',
					'order'             => 'ASC',
					'meta_query' 		=> array

					(
						array(
							'key' => 'gametype',
							'value' => 'dota'),  
						array(
							'key' => 'pagetype',
							'value' => 'player'),

						array(
							'key' => 'teamcode')

					//	array(
					//		'key' => 'role')

						)
					);

				$teams = new WP_Query( $args );

				if ( $teams->have_posts() ) {
					while ( $teams->have_posts() ) {		
						$teams->the_post();



						?>


						<a href="<?php the_permalink(); ?>">
							<table id="players"><tr><td width="120" height="145" align="center" valign="top">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('104');
									}
								?>
								<span class="textbox">
									<img width="16px"  src="http://www.bet-esport.com/i/dota-50.png"/> 
									<img width="19px"  src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("teamcode"); echo $values[0]; ?>-32x32.png"/> 
									<img width="15px"  src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("role"); echo $values[0]; ?>-18.png"/> 
									<img width="18px"  src="http://www.bet-esport.com/i/flags/32/<?php $values = get_post_custom_values("fullcountryname"); echo $values[0]; ?>-flag.png"/>  
									<br>  
									<strong><?php $values = get_post_custom_values("playerusername"); echo $values[0]; ?></strong></span></td>
							</tr>
						</table>

					</a> 
					<?php	
				}
			} else {

				echo 'No Teams found for Dota';	
			}
			wp_reset_postdata();
			?>
			<div style="clear:both"></div>
		</div>

</div>

<div id="div3" class="targetDiv">
				<div class="grid_12">
					<h2>CS:GO Players</h2>
					<?php
					$args = array(
						'post_type' 		=> 'page',
						'posts_per_page'   	=> 300,
						'orderby'          	=> 'teamcode',
						'order'            	=> 'ASC',
						'meta_query' 		=> array

						(
							array(
								'key' => 'gametype',
								'value' => 'csgo'),  

							array(
								'key' => 'pagetype',
								'value' => 'player'),

							array(
								'key' => 'teamcode'),
							)
						);


					$teams = new WP_Query( $args );

					if ( $teams->have_posts() ) {
						while ( $teams->have_posts() ) {		
							$teams->the_post();
							?>

							<a href="<?php the_permalink(); ?>">
								<table id="players"><tr><td width="120" height="145" align="center" valign="top">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('104');
									}
									?>
									<span class="textbox">
										<img width="16px"  src="http://www.bet-esport.com/i/csgo-50.png"/> 
										<img width="19px"  src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("teamcode"); echo $values[0]; ?>-32x32.png"/> 
										<img width="15px"  src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("role"); echo $values[0]; ?>-18.png"/> 
										<img width="18px"  src="http://www.bet-esport.com/i/flags/32/<?php $values = get_post_custom_values("fullcountryname"); echo $values[0]; ?>-flag.png"/>  
										<br>  <strong><?php the_title();?></strong></span></td>
								</tr>
							</table>

						</a> 
						<?php	
					}
				} else {

					echo 'Players for Counter Strike: Global Offensive coming soon!';	
				}
				wp_reset_postdata();
				?>
				<div style="clear:both"></div>
			</div>


</div>
<hr>

		</div>

		<div class="four columns">

			<?php include ('side.php'); ?>

		</div>

	</div>

</div> 

</div>

<?php get_footer(); ?>