
<style>
.showsinglegame img{
	height: auto;
	width: auto;
	max-width:150px;
	max-height: 50px;

}
</style>

<?php 
// function ButtonGeneratorHome($gameType){
// 	$d = mktime();
// 	$games = new WP_Query( 
// 		array(
// 			'post_type'     => 'match',
// 			'orderby'       => 'meta_value',
// 			'order'         => 'ASC',
// 			'showposts'     => 30000,
// 			'meta_query'    => array(
// 				array(
// 					'key'       => 'datecomp',
// 					'value'     => $d,
// 					'compare'   => '>='
// 				),
// 			),  
// 		)
// 	); 
// 	$torneo_array = array();

// 	if ( $games->have_posts() ) :
// 		while ( $games->have_posts() ) : $games->the_post(); 
// 			$gtype = get_post_meta(get_the_ID(), 'gametype', true);

// 			$torneo_array[$gtype][] = array(
// 				'gametype' => $gtype,
// 			);
// 		endwhile;
// 	endif; 

// 	ButtonMaker($torneo_array);
// 	wp_reset_query();
// }

// function ButtonMaker($torneo_arrayB){
// 	$buttonExclude = array('Dota 2', 'CS GO', 'League of Legends');

// 	echo '<div class="buttons" style="text-align: center;"><button id="opendiv" class="gamebutton" ><img alt="Show All" src="http://www.bet-esport.com/i/showall_300.png"></button><button class="showsinglegame gamebutton" value="league-of-legends" target="1"><img alt="League of Legends" src="http://www.bet-esport.com/i/league-of-legends_300.png"></button><button class="showsinglegame gamebutton" value="dota-2" target="2"><img alt="Dota 2" src="http://www.bet-esport.com/i/dota-2_300.png"></button><button class="showsinglegame gamebutton" value="cs-go" target="3"><img alt="CS GO" src="http://www.bet-esport.com/i/cs-go_300.png"></button><div id="hiddenmenu" style="display:none"><button class="showsinglegame gamebutton" value="all" ><img alt="Show All" src="http://www.bet-esport.com/i/showall_300.png"></button>';

// 	foreach ($torneo_arrayB as $key => $ppp) {
// 		if (!in_array($key, $buttonExclude)){
// 			echo '<button class="showsinglegame gamebutton" value="'.seoUrl($key).'" target="99"><img alt="'.$key.'" src="http://www.bet-esport.com/i/'.seoUrl($key).'_300.png"></button>';
// 		}
// 	}
// 	echo '<button class="showsinglegame gamebutton" value="all" ><img alt="Others" src="http://www.bet-esport.com/i/others_300.png"></button>';
// 	echo '</div></div><br>';
// }

?>




<script>
	$(document).ready(function() {
		$(".clickable-row").click(function() {
			window.document.location = $(this).find('a').attr("href");
		});

		var other_games = [ "dota-2", "cs-go", "league-of-legends", "starcraft-2", "starcraft", "warcraft-iii", "hearthstone", "overwatch", "call-of-duty", "black-ops", "warcraft", "world-of-tanks", "world-of-warcraft", "rocket-league", "pubg", "heroes-of-the-storm"];

		$('.showsinglegame').click(function(){
			if($(this).val() == 'all'){ 
				$('.torneogroup').show();
			}else if (other_games.indexOf($(this).val()) != -1 ) {
				$('.torneogroup').show();
				$('.torneogroup:not(.'+$(this).val()+')').hide();
			} else { 
				$('.torneogroup').show();
				for(var i = 0; i < other_games.length; i++){
					$('.'+ other_games[i] ).hide();
				}
			}
		} 
		);

		if($('.torneogroup').is(':hidden')){
			$('#nonehere').show();
		}else{
			$('#nonehere').hide();
		}

		$("#opendiv").click(function(){
			$("#hiddenmenu").toggle();
		})

	}); 
</script>
