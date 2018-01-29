<?php /* Template Name: team */  get_header();  ?>

<div class="row">

	<div class="twelve columns">

		<div class="row"> 

			<div class="eight columns">
			

<?php
$values = get_post_custom_values("teamcode"); $values[0];

            $teamname =     	 	get_post_custom_values("teamname")[0];
            $teamcode = 	   	 	get_post_custom_values("teamcode")[0];
			$country=       		get_post_custom_values("country")[0];
            $flagname=              get_post_custom_values("flagname")[0];
			$gametype= 	        	get_post_custom_values("gametype")[0];
;
wp_reset_postdata();
?>   

		

							<div class="team">
                                <img alt="<?php $values = get_post_custom_values("teamcode"); echo $values[0]; ?>" src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("teamcode"); echo $values[0]; ?>.png" />
                    </div>
							<div class="teaminfo">
								<h1><?php echo $teamname ?></h1>
								<h3>
                                    <img pad src="http://www.bet-esport.com/i/flags/48/<?php echo $country; ?>-flag.png"/> 
                                    <a href="http://www.bet-esport.com/<?php echo $gametype; ?>/">
                                        <img  src="http://www.bet-esport.com/i/<?php echo $gametype; ?>_300.png"/>
                                    </a>
                                </h3>
								

<?php
					$args = array(
					'post_type'          => 'page',
					'key' 				 => 'player',
					'meta_key' 			=> 'role',

					'meta_query' => array( 
						array(
							'key' => 'pagetype',
							'value' => 'player'),
						array(
								'key' => 'role'),
								'value' =>  get_post_custom_values("role"),
						array(	
								'key' => 'teamcode',
								'value' =>  get_post_custom_values("teamcode")       
							)
				
					)
					);
					$teammates = new WP_Query( $args );
					
						if ( $teammates->have_posts() ) {
							while ( $teammates->have_posts() ) {		
								$teammates->the_post();  
															
 echo "<h3>".get_post_meta($teammates->post->ID, 'role')[0].": ".get_post_meta($teammates->post->ID, 'playerusername')[0]."</h3>";
									}
								}
		 ?>

		
							</div>

				

				<!-- ------------------------------------------------------------------------------------------------------------- -->


				<div class="grid_12" style="display:inline-block;">

					<?php
					$title = get_the_title();
					$args = array(
						'post_type' => 'page',
						'orderby'   => 'title',
						'order'	    => 'ASC',

						'meta_query' => array(
							array(
								'key' => 'teamcode',
								'value' =>  get_post_custom_values("teamcode"),       
								),
	        
							array(
								'key' => 'pagetype',
								'value' => 'player'),
							)
						);

					$players = new WP_Query( $args );

					if ( $players->have_posts() ) {
						while ( $players->have_posts() ) {		
							$players->the_post();

							?>

							<a href="<?php the_permalink(); ?>">

								<table id="players"><tr><td width="120" height="145" align="center" valign="top">

									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail();
									}
									?>
									<span class="textbox">
										<img width="16px"  src="http://www.bet-esport.com/i/<?php echo $gametype ?>-50.png"/> 
										<img width="16px"  src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("teamcode"); echo $values[0]; ?>-32x32.png"/> 
										<img width="16px"  src="http://www.bet-esport.com/i/flags/32/<?php $values = get_post_custom_values("fullcountryname"); echo $values[0]; ?>-flag.png"/>
										<br>  <strong><?php the_title();?></strong></span></td>
								</tr>
							</table>

						</a> 
						<?php	
					}
				} else {

					echo 'No players for '; echo get_the_title($ID);	
				}
				wp_reset_postdata();
				?>
				<div style="clear:both"></div>
			</div>


			<div style="clear:both"></div>


			<!-- --------------------------------------------------------------------------------------------------------------- -->    

			<hr>



			<?php the_post(); ?>
			<?php the_content(); ?>
			<br />
		</section>
		<aside>

        
            
           
            	</div>
		<div class="four columns">

			<?php include ('side.php'); ?>

		</div>

	</div>

</div> 

</div>

<?php get_footer(); ?> 