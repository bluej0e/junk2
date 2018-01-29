<?php 
$p0 = [
	"<div class='p0box'>The safe bet here is on <strong>{$winner}</strong> with a <strong>{$winperc}%</strong> chance of winning</div>",
	"<div class='p0box'>You can try a risky bet here on <strong>{$loser}</strong>. With their lowere odds of <strong>{$lodds}</strong>, they have a much higher payout</div>",
	"<div class='p0box'><strong>{$winner}</strong> looks to be the stronger team in this matchup. Bet on them for a safer bet</div>"
];
$p0t = [
	"<div class='p0box'>This is a pretty even matchup. Bet on your favourite team on this one</div>",
	"<div class='p0box'>It's looking even in this one. Maybe bet on <strong>{$winner}</strong> since they are slightly favoured</div>",
	"<div class='p0box'>This one is looking even. Maybe bet on <strong>{$loser}</strong> since they pay out slightly more</div>"
];

$p1 = [
	"<strong>{$t1name}</strong> vs <strong>{$t2name}</strong> face off on {$fechaH}, in the <strong>{$tournament}</strong>.", 
	"On {$fechaH}, <strong>{$t1name}</strong> goes up against <strong>{$t2name}</strong> in the <strong>{$tournament}</strong>.", 
	"<strong>{$t1name}</strong> is versing <strong>{$t2name}</strong> in the <strong>{$tournament}</strong>, on {$fechaH}.", 
	"<strong>{$t1name}</strong> and <strong>{$t2name}</strong> face off against each other on {$fechaH} in the <strong>{$tournament}</strong>.", 
	"On {$fechaH}, <strong>{$t1name}</strong> plays against <strong>{$t2name}</strong> in the <strong>{$tournament}</strong>."
];
	
$p2 = [
	"<strong>{$winner}</strong> is looking like a better bet since they have a {$winperc}% chance of winning. This makes them the better bet although they pay out {$wodds}. This means that if you bet $10, you’ll win $". 10*$wodds .". Betting on <strong>{$loser}</strong>, whose odds are {$lodds}, will pay out much more if they win. With a {$losperc}% chance of winning they are the risky bet, but betting $10, will net you $". 10*$lodds ."!",
	"This matchup favors <strong>{$winner}</strong> who’s got a {$winperc}% of winning over <strong>{$loser}</strong>. Betting on <strong>{$winner}</strong> will be the safe bet netting $". 10*$wodds ." for every $10 you wager, but betting on <strong>{$loser}</strong> will make things more interesting since their {$lodds} odds means you get a cool $". 10*$lodds ." for every $10 you wager.",
	"The winner for this one looks to be <strong>{$winner}</strong>. While <strong>{$loser}</strong> has a lower chance to win at {$losperc}% it makes for a much more interesting bet since they pay out higher. In a 10$ bet on <strong>{$loser}</strong> you’ll win $". 10*$lodds .". While taking the safer bet on <strong>{$winner}</strong> will net you $". 10*$wodds ."."
];

$p3 = [
"This is a pretty even matchup with both teams having a fairly close chance at winning. <strong>{$winner}</strong> is looking a little better than <strong>{$loser}</strong> in this one. A bet on <strong>{$winner}</strong> will pay out $". 10*$wodds .". for every $10 you bet. While a bet on <strong>{$loser}</strong> pays $". 10*$lodds ." for the same bet amount.",	
	"This is going to be a really close game with <strong>{$winner}</strong> being slightly favoured with a {$winperc}% chance and <strong>{$loser}</strong> with a {$losperc}%. In this case you can probably just bet for your favourite team. Since <strong>{$loser}</strong> has a lower chance to win, they will pay out a bit better. For every $10 you bet on <strong>{$loser}</strong> you'll get back  $". 10*$lodds ." so it makes them a slightly more attractive bet."
	
];
?>
<style>
	.texty{
		padding:1em;
	}
	.texty p{
		font-size: 1.3em;
		line-height: initial;
	}
</style>
<?php echo (($wodds - $lodds < 20) ? $p0[rand(0,2)] : $p0t[rand(0,2)]); ?>
<p><?php echo $p1[rand(0,4)]; ?></p>
<p><?php echo (($wodds - $lodds < 20) ? $p2[rand(0,2)] : $p3[rand(0,1)]); ?></p>
</div>





