
<h4>Betting on eSports</h4>
<nav id="secondary-navigation">
    <ul>
    <li><a href="http://www.bet-esport.com/so-youre-looking-to-bet-money-on-esports/"><img style="float:left; display:inline-block; margin-right:8px;" height="45px" width="45px" src="/i/whatis.png"/><h5> What are eSports</h5></a></li>
    <li><a href="http://www.bet-esport.com/how-to-bet-on-esports/"><img style="float:left; display:inline-block; margin-right:8px;" height="45px" width="45px" src="/i/betting.png"/><h5> How to Bet on eSports</h5></a></li>
    <li><a href="http://www.bet-esport.com/esports-betting-tips/"><img style="float:left; display:inline-block; margin-right:8px;" height="45px" width="45px"  src="/i/tips.png"/><h5> eSports Betting Tips</h5></a></li>
    <li><a href="http://www.bet-esport.com/esports-bet-odds/"><img style="float:left; display:inline-block; margin-right:8px;" height="45px" width="45px" src="/i/bookies.png"/><h5> eSports Bookmakers</h5></a></li> 

    </ul>
    </nav>


<hr>
<center>
        <a href="http://www.bet-esport.com/esports-bet-odds/"><img src="/i/betting-table-button.jpg" alt="Odds Tables" /></a>

    <hr>

        
        <a href="http://goo.gl/kILcl2" target="_blank"><img src="/i/pinnacle-1.gif" alt="Pinnacle Sports" /></a>

    
</center>
<hr>
<h4>Current Turnaments</h4>
	<center>
        <div id="div1" class="targetDiv">
            <div class="grid_4">
		
    <?php 
				$args = array(
					'post_type'			=> 'page',
					'posts_per_page'   	=> -1,
					'orderby'          	=> 'title',
					'order'            	=> 'ASC',      
					'meta_query' 		=> array

					(
						array(
							'key' => 'pagetype',
							'value' => 'tournament'),
						
                    array(
                            'key' => 'islive',
							'value' => '1')
                    
                    )    
					);
            
				$tournaments = new WP_Query( $args );

				if ( $tournaments->have_posts() ) {
					while ( $tournaments->have_posts() ) {		
						$tournaments->the_post();
                    ?>

						<a href="<?php the_permalink(); ?>">
							<table class="tournaments2">
								<tr>
									<td align="center" valign="top">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail();
										}
										?>
										<span class="textbox">
											<strong><?php the_title(); ?></strong></span>
										</td>
									</tr>
								</table>

							</a> 
                <?php }}?> 
            </div>
        </div>
        
	</center>
<br>
<hr />
<h4>Recent and Upcoming Matches</h4>
<center>
	<nav id="secondary-navigation">

		<ul>
			<li>
				<?php
				$args = array(
					'posts_per_page'   => 5,
					'category_name'    => 'match',
					'orderby'          => '',
					'order'            => '',
					'include'          => '',
					'exclude'          => '',
					'meta_key'         => '',
					'meta_value'       => '',
					'post_type'        => '',
					'post_mime_type'   => '',
					'post_status'      => 'publish',
                    
					);

				$match = new WP_Query( $args );

				if ( $match->have_posts() ) {
					while ( $match->have_posts() ) {		
						$match->the_post();
						?>
						<a href="<?php the_permalink(); ?>">
							<table width="100%" border="0" style="background: url('http://bet-esport.com/i/<?php $values = get_post_custom_values("gametype"); echo $values[0]; ?>-50.png') no-repeat right bottom; background-size: 25px 25px;">
                                <div style="position:absolute; right: 6%;"><img style="z-index:1;" width="25px" height="25px" src="/i/<?php $values = get_post_custom_values("tourcode"); echo $values[0]; ?>-32x32.png"></div>
								<tr>
									<td  width="114"align="left" valign="top" >
										<img width="50px" src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("team1"); echo $values[0]; ?>-50x50.png"> 
										<img width="50px" src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("team2"); echo $values[0]; ?>-50x50.png">
									</td>
									<td>
                                        
										<p class="textnews"><?php the_title();?> 
											<br><span id="date"><?php $values = get_post_custom_values("tournament"); echo $values[0]; ?></span>
										</br>
										<span id="date"><?php $values = get_post_custom_values("date"); echo $values[0]; ?></span>
                                            <!--img width="20px" src="http://bet-esport.com/i/<?php $values = get_post_custom_values("gametype"); echo $values[0]; ?>-50.png" style="display:block; bottom:0; right:0;"-->

                                    
									</td>
                            
								</tr>
							</table>
						</a> 
						<?php	
					}
				} else {

					echo 'There are no matches.';	
				}
				wp_reset_postdata();
				?>
			</li>
			<li class="current"><a href="http://www.bet-esport.com/matches/">MORE MATCHES</a></li>
		</ul>

	</center>

	<hr />

	<!--h4>Betting Sites</h4-->
	<center>
        <!--a href="http://record.affiliatelounge.com/_k3kXzD83yy3ZB_7rh7w1J3faGI-U7zhX/1" target="_blank"><img src="/i/250x300_betsafe.gif" alt="Betsafe" /></a-->
	<iframe scrolling='no' frameBorder='0' style='padding:0px; margin:0px; border:0px;border-style:none;border-style:none;' width='300' height='250' src="https://wlpinnaclesports.adsrv.eacdn.com/I.ashx?btag=a_13738b_8647c_&affid=14473&siteid=13738&adid=8647&c=" ></iframe>
        
    </center>

	<hr />



</center>
