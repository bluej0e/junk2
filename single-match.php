<?php get_header('match')[0];
$match_info = unserialize(unserialize(get_post_custom_values('match_info')[0]));
$match_winner = unserialize(unserialize(get_post_custom_values('match_winner')[0]));
$betTypes = unserialize(unserialize(get_post_custom_values('betTypes')[0]));
$tarray = unserialize(unserialize(get_post_custom_values('tarray')[0]));

$t1name = get_post_custom_values('t1name')[0]; 
$t2name = get_post_custom_values('t2name')[0];
$tournament = get_post_custom_values('tournament')[0]; 
$t1odds = $match_winner['t1odds'];
$t2odds = $match_winner['t2odds'];
$t1ID = $match_info['t1id']; 
$t2ID = $match_info['t2id'];
$time = get_post_custom_values('time')[0];
$dateD = explode(" ", $time)[0]; 
$dateH = explode(" ", $time)[1]; 
$eventID = $match_info['eventID']; 
$gametype = get_post_custom_values('gametype')[0];
$quicklink = $match_info['quicklink']; 
$tournamentcode = $match_info['tournamentcode'];
$currentID = get_the_ID(); 
$affme = "/?s=bfp109554";

setlocale(LC_ALL,"en_EN");
$fechahumana = DateTime::createFromFormat("Y/m/d", $dateD);
$fechaH= strftime("%B %d, %Y",$fechahumana->getTimestamp()); 

$gametime = strtotime($time) - mktime();

?>
<script>
	$(function(){

		$('.timer-quick').startTimer();

		$('.timer').startTimer({
			onComplete: function(){
				console.log('Complete');
			}
		});

		$('.timer-pause').startTimer({
			onComplete: function(){
				console.log('Complete');
			},
			allowPause: true
		});
	})
</script>
     <script>dataLayer.push({'gameType': '<?php echo $gametype; ?>', 'pageType':'<?php echo get_post_type(); ?>', 'tournamentName': '<?php echo $tournament;?>','team1': '<?php echo $t1name; ?>','team2': '<?php echo $t2name; ?>' });</script>

<style>
.p0box{
	text-align:center; 
	font-size:1.8em; 
	font-style: oblique; 
	padding: 0 1em 1em 1em;
}
.texty{
	padding:1em;
}
.texty p{
	font-size: 1.3em;
	line-height: initial;
}
#t1, #t2{
	-webkit-transition: all .5s;
	-moz-transition: all .5s;
	transition: all .5s;
}

</style>
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Game","name":"<?php echo $t1name.'" vs "' .$t2name; ?>","image":"http://www.bet-esport.com/i/matchdefault.jpg","aggregateRating":{"@type":"AggregateRating","ratingValue":"4.<?php  echo substr($t1ID, -1); ?>","ratingCount":"<?php $rand = rand(200,2000); echo $rand; ?>"}}</script>
<div class="row">
	<?php include('match_head.php'); ?>

	<?php foreach($betTypes as $key){include $key;}?>
	<div class="row">
		<div class="twelve columns" style="text-align:center;">
			<h1><?php echo "Bet on {$t1name} vs {$t2name}"?></h1>
			<h2><?php echo "{$tournament} – {$fechaH}"?></h2>

		</div>
	</div>
	<div class="texty">
		<?php
		if($t1odds < $t2odds){
			$winner = $t1name;
			$loser = $t2name;
			$wodds = $t1odds;
			$lodds = $t2odds;
			$winperc = round(((1/$t1odds)*100)-4);
			$losperc = round(((1/$t2odds)*100)-4);
		}else{
			$winner = $t2name;
			$loser = $t1name;
			$wodds = $t2odds;
			$lodds = $t1odds;
			$winperc = round(((1/$t2odds)*100)-4);
			$losperc = round(((1/$t1odds)*100)-4);
		}

		$p0 = [
			"<div class='p0box'>The safe bet here is on <strong>{$winner}</strong> with a <strong>{$winperc}%</strong> chance of winning</div>",
			"<div class='p0box'>You can try a risky bet here on <strong>{$loser}</strong>. With their lower odds of <strong>{$lodds}</strong>, they have a much higher payout</div>",
			"<div class='p0box'><strong>{$winner}</strong> looks to be the stronger team in this matchup. Bet on them for a safer bet</div>"
		];
		$p0t = [
			"<div class='p0box'>This is a pretty even matchup. Bet on your favourite team on this one</div>",
			"<div class='p0box'>It's looking even in this one. Maybe bet on <strong>{$winner}</strong> since they are slightly favoured</div>",
			"<div class='p0box'>This one is looking even. Maybe bet on <strong>{$loser}</strong> since they pay out slightly more</div>"
		];
		$p1 = [
			"<p><strong>{$t1name}</strong> vs <strong>{$t2name}</strong> face off on {$fechaH}, in the <strong>{$tournament}</strong>.</p>", 
			"<p>On {$fechaH}, <strong>{$t1name}</strong> goes up against <strong>{$t2name}</strong> in the <strong>{$tournament}</strong>.</p>", 
			"<p><strong>{$t1name}</strong> is versing <strong>{$t2name}</strong> in the <strong>{$tournament}</strong>, on {$fechaH}.</p>", 
			"<p><strong>{$t1name}</strong> and <strong>{$t2name}</strong> face off against each other on {$fechaH} in the <strong>{$tournament}</strong>.</p>", 
			"<p>On {$fechaH}, <strong>{$t1name}</strong> plays against <strong>{$t2name}</strong> in the <strong>{$tournament}</strong>.</p>"
		];
		$p2 = [
			"<p><strong>{$winner}</strong> is looking like a better bet since they have a {$winperc}% chance of winning. This makes them the better bet although they pay out {$wodds}. This means that if you bet $10, you’ll win $". 10*$wodds .". Betting on <strong>{$loser}</strong>, whose odds are {$lodds}, will pay out much more if they win. With a {$losperc}% chance of winning they are the risky bet, but betting $10, will net you $". 10*$lodds ."!</p>",
			"<p>This matchup favors <strong>{$winner}</strong> who’s got a {$winperc}% of winning over <strong>{$loser}</strong>. Betting on <strong>{$winner}</strong> will be the safe bet netting $". 10*$wodds ." for every $10 you wager, but betting on <strong>{$loser}</strong> will make things more interesting since their odds of {$lodds} means you get a cool $". 10*$lodds ." for every $10 you wager.</p>",
			"<p>The winner for this one looks to be <strong>{$winner}</strong>. While <strong>{$loser}</strong> has a lower chance to win at {$losperc}% it makes for a much more interesting bet since they pay out higher. In a 10$ bet on <strong>{$loser}</strong> you’ll win $". 10*$lodds .". While taking the safer bet on <strong>{$winner}</strong> will net you $". 10*$wodds .".</p>"];
			$p2t = [
				"<p>This is a pretty even matchup with both teams having a fairly close chance at winning. <strong>{$winner}</strong> is looking a little better than <strong>{$loser}</strong> in this one. A bet on <strong>{$winner}</strong> will pay out $". 10*$wodds ." for every $10 you bet. While a bet on <strong>{$loser}</strong> pays $". 10*$lodds ." for the same bet amount.</p>",	
				"<p>This is going to be a really close game with <strong>{$winner}</strong> being slightly favoured with a {$winperc}% chance and <strong>{$loser}</strong> with a {$losperc}%. In this case you can probably just bet for your favourite team. Since <strong>{$loser}</strong> has a lower chance to win, they will pay out a bit better. For every $10 you bet on <strong>{$loser}</strong> you'll get back  $". 10*$lodds ." so it makes them a slightly more attractive bet.</p>",
				"<p>This matchup is really close with either team able to take the game. even though {$winner} is favoured its only by a small margin. In this case the best bet would be on the team you feel will win. {$winner} pays out {$wodds}, and {$loser} pays {$lodds}.</p>"
			];

			echo ((($winperc - $losperc) > 10) ? $p0[$tarray[0]] : $p0t[$tarray[0]])."<br>".$p1[$tarray[1]]."<br>".((($winperc - $losperc) > 10) ? $p2[$tarray[2]] : $p2t[$tarray[2]]);

			?>	
		</div>

		<div style="padding:em;">
			<?php include('tournament_loop.php'); ?>
		</div>
		<hr>
	</div>
	<?php get_footer('prueba1'); ?>