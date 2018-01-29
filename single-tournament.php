<?php 
/*
Template Name: Tournament
Template Post Type: Tournament
*/
get_header('prueba1');  
$currentgtype = get_post_custom_values('gametype')[0];
?>

<div class="row">
	<div class="twelve columns">
		<div class="tournament-head" style="background: url(/i/<?php echo seoUrl($currentgtype); ?>-header.jpg) no-repeat center center" class="gametype-head">
			<div class="gametype-head-inner">
				<h1><?php echo RemoveGameType(get_the_title()); ?></h1>
			</div>
		</div>
		<!-- <h1>< ?php echo RemoveGameType(get_the_title()); ?></h1> -->
		<?php the_post(); 
		the_content(); ?>

		<!-- <center><h4>Current and Upcoming Games</h4></center> -->
		<div class="panel-body"> </div>

		<?php
		function TorSep($tor_array){
			foreach ($tor_array as $key => $tor){
				echo '<div class="torneogroup '. seoUrl($tor[0]['gametype']) .'"  id="'. seoUrl($key) .'" value="'. $tor[0]['gametype'] .'">';
				echo '<div class="torneogroups">';
				MatchBoxes($tor);
				echo '</div>';
				echo '</div>';  
			}
		}
		$d = mktime();		
		$partidoz = new WP_Query( 
			array(
				'post_type'     => 'match',
				// 'orderby'       => 'meta_value',
				'order'         => 'ASC',
				'showposts'     => 100000,
				'meta_query'    => array(
					array(
						'key'       => 'datecomp',
						'value'     => $d,
						'compare'   => '>='
					),
					array(
						'key'       => 'tournament',
						'value'     => RemoveGameType(get_the_title()),
						'compare'   => '='
					),
					array(
						'key'		=> 'gametype',
						'value'		=> $currentgtype,
						'compare'	=> '='
					),
				),  
			)
		);  
		$torneo_array = array();

		if ( $partidoz->have_posts() ) : while ( $partidoz->have_posts() ) : $partidoz->the_post(); 
			$torneo = get_post_meta(get_the_ID(), 'tournament', true);

			$match_info = unserialize(unserialize(get_post_custom_values('match_info')[0]));

			$title_array = explode(" – ", get_the_title());
			$title_date = substr($title_array[1], -10);
			$gametype = get_post_meta(get_the_ID(), 'gametype', true);
			$eltime = get_post_meta(get_the_ID(), 'time', true);
			$t1name = get_post_meta(get_the_ID(), 't1name', true);
			$t1odds = get_post_meta(get_the_ID(), 't1odds', true);
			$t2name = get_post_meta(get_the_ID(), 't2name', true);
			$t2odds = get_post_meta(get_the_ID(), 't2odds', true);

			setlocale(LC_ALL,"en_EN");
			$fechahumana = DateTime::createFromFormat("Y/m/d", explode(" ", get_post_custom_values('time')[0])[0]);
			$fechaH= strftime("%d %b %Y",$fechahumana->getTimestamp()); 

			$torneo_array[$torneo][] = array(
				'title' =>  $title_array[0],
				'url' => get_permalink(),
				'gametype' => $gametype,
				'day' => $fechaH,
				'month' => $monthName,
				'time' => substr($eltime, 11, -7),
				't1name' => $t1name,
				't1odds' => $t1odds,
				't2name' => $t2name,
				't2odds' => $t2odds,
				't1winna' => round((1/$t1odds)*100)-4,
				't2winna' => round((1/$t2odds)*100)-4,
				'linkouturl' => $match_info['quicklink']."/?s=bfp109554",
			);

		endwhile; endif; 

		TorSep($torneo_array);

		wp_reset_query(); 
		?>
		<div id="nonehere" style="display:none">No matches at the moment.</div>
		<br>
		<hr> 
	</div>
</div>
<?php get_footer('prueba1'); ?>