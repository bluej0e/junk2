<?php get_header('prueba1'); /* Template Name: TOURNAMENTS */?>
<div class="row">
	<div class="twelve columns">
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
		<style>
		@media only screen and (max-width:767px) {
			.targetDiv{
				text-align: center;
			}
		}
	</style>
	<button  class="showall gamebutton"><img alt="Show All" src="http://www.bet-esport.com/i/showall_300.png"></button>
	<button  class="showSingle gamebutton" target="3"><img alt="League of Legends" src="http://www.bet-esport.com/i/lol_300.png"></button>
	<button  class="showSingle gamebutton" target="1"><img alt="Dota" src="http://www.bet-esport.com/i/dota_300.png"></button>
	<button  class="showSingle gamebutton" target="2"><img alt="CS:GO" src="http://www.bet-esport.com/i/csgo_300.png"></button>
	<!--a  class="showSingle" target="4">Div 4</a-->
</div>
<br>
<div style="margin:0 auto;">
	<?php 
	$times4 = array('Dota 2', 'CS GO', 'League of Legends', 'Other');
	foreach ($times4 as $key => $value) {
		echo '<div id="div'. ++$key .'" class="targetDiv"><div class="gametype-head"style="background: url(/i/'. seoUrl($value).'-header.jpg) no-repeat center center"> <div class="gametype-head-inner"><h2 style="width:70%; margin: 0 auto;">'.$value.' Tournaments</h2></div><div style="clear:both"></div></div>';
		GameFetcherT($value);
		echo '<div style="clear:both"></div><br><br></div>';
	}
	?>
	<hr>
	<?php get_footer('prueba1'); ?>

