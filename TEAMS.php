<?php get_header(); /* Template Name: TEAMS*/?>

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



			<div id="div1" class="targetDiv"><div class="grid_12">
				<h2>League of Legends Teams</h2>
				<?php
				$args = array(
					'post_type'			=> 'page',
					'posts_per_page'   	=> 100,
					'orderby'          	=> 'title',
					'order'            	=> 'ASC',
					'meta_query' 		=> array

					(
						array(
							'key' => 'gametype',
							'value' => 'lol'),  

						array(
							'key' => 'pagetype',
							'value' => 'team')
						)
					);


				$teamslol = new WP_Query( $args );

				if ( $teamslol->have_posts() ) {
					while ( $teamslol->have_posts() ) {		
						$teamslol->the_post();
						?>

						<a href="<?php the_permalink(); ?>">
							<table class="teams">
								<tr>
									<td width="120" height="145" align="center" valign="top">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail('137');
										}
										?>
										<span class="textbox">
											<strong><?php the_title();?></strong></span>
										</td>
									</tr>
								</table>

							</a> 
							<?php	
						}
					} else {

						echo 'No Teams found for League of Legends';	
					}
					wp_reset_postdata();
					?>
					<div style="clear:both"></div>
				</div></div>

			<div id="div2" class="targetDiv">
			<div class="grid_12">
					<h2>Dota 2 Teams</h2>

					<?php
					$args = array(
						'post_type' => 'page',
						'posts_per_page'   => 100,
						'orderby'          => 'title',
						'order'            => 'ASC',
						'meta_query' => array

						(
							array(
								'key' => 'gametype',
								'value' => 'dota',       
								),  


							array(
								'key' => 'pagetype',
								'value' => 'team'),
							)
						);


					$teamsdota = new WP_Query( $args );

					if ( $teamsdota->have_posts() ) {
						while ( $teamsdota->have_posts() ) {		
							$teamsdota->the_post();
							?>

							<a href="<?php the_permalink(); ?>">
								<table class="teams"><tr><td width="120" height="145" align="center" valign="top">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('137');
									}
									?>
									<span class="textbox"><strong><?php the_title();?></strong></span></td>
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
					<h2>CS:GO Teams</h2>

					<?php
					$args = array(
						'post_type' => 'page',
						'posts_per_page'   => 100,
						'orderby'          => 'title',
						'order'            => 'ASC',
						'meta_query' => array

						(
							array(
								'key' => 'gametype',
								'value' => 'csgo',       
								),  


							array(
								'key' => 'pagetype',
								'value' => 'team'),
							)
						);


					$teamscsgo = new WP_Query( $args );

					if ( $teamscsgo->have_posts() ) {
						while ( $teamscsgo->have_posts() ) {		
							$teamscsgo->the_post();
							?>

							<a href="<?php the_permalink(); ?>">
								<table class="teams"><tr><td width="120" height="145" align="center" valign="top">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('137');
									}
									?>
									<span class="textbox"><strong><?php the_title();?></strong></span></td>
								</tr>
							</table>

						</a> 
						<?php	
					}
				} else {

					echo 'Teams for Counter Strike: Global Offensive coming soon!';	
				}
				wp_reset_postdata();
				?>
				<div style="clear:both"></div>
			</div>
		</div>

			<!--div id="div4" class="targetDiv">Lorum Ipsum4</div-->




			<?php the_post(); ?>
			<?php the_content(); ?>
			<br />
			<br />
			<?php if(get_the_tag_list()) {
				echo get_the_tag_list('<ul class="buttonlink"><li class="buttonlink">','</li><li class="buttonlink">','</li>
			</ul>');
		} ?>

		<hr />

	</div>

	<div class="four columns">

		<?php include ('side.php'); ?>

	</div>

</div>

</div> 

</div>

<?php get_footer(); ?>