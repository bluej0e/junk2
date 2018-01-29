<style>
	.cs1, .cs2{
		width:30%!important;
		line-height: normal;
	}
	.cs1:hover {
		background: rgba(13, 71, 161, 0.5);
	}
	.cs2:hover {
		background: rgba(211, 47, 47, 0.5);
	}
	.txodds{
		margin: 1vw;
	    display: inline-block;
	    vertical-align: middle;		
	    line-height: normal;
		text-align: center;
		font-size: 2em;
		width: 65%;
	}
</style>
<?php 
$correct_score = unserialize(unserialize(substr(get_post_custom_values('correct_score')[0], 0, -1)));
$t120 = $correct_score['odds_20'];
$t121 = $correct_score['odds_21'];
$t220 = $correct_score['odds_02'];
$t221 = $correct_score['odds_12'];
?>
<div class="row">
	<div class="twelve columns">
		<!-- <h3 style="text-align:center">CORRECT SCORE</h3> -->
		<center><p style="margin-bottom:2px;">Select to bet on what you think the correct outcome will be.</p></center>
		<div class="oddsbox">
			<a class="az" style='width:50%; display:inline-block;' href="<?php echo "http://sports.betway.com/esports/". seoUrl($gametype)."/".$tournamentcode."/". seoUrl($t1name)."-". seoUrl($t2name)."/correct-score".$affme; ?>" target="blank_">
				<img class="barvatar bv1" src="/i/logos/100/<?php echo seoUrl($t1name); ?>.png" alt="<?php echo $t1name; ?>" />
				<div href="http://sports.betway.com/esports/<?php echo seoUrl($gametype).'/'.$tournamentcode.'/'.seoUrl($t1name).'-'.seoUrl($t2name).'/correct-score/2-0'?>" class="cs1 txodds t1odds">2-0<br>odds: <?php echo $t120; ?></div>
				<div href="http://sports.betway.com/esports/<?php echo seoUrl($gametype).'/'.$tournamentcode.'/'.seoUrl($t1name).'-'.seoUrl($t2name).'/correct-score/2-1'?>" class="cs1 txodds t2odds">2-1<br>odds: <?php echo $t121; ?></div>
			</a>
			<a class="za" style="width:50%; display:inline-block; float:right; " href="<?php echo "http://sports.betway.com/esports/". seoUrl($gametype)."/".$tournamentcode."/". seoUrl($t1name)."-". seoUrl($t2name)."/correct-score".$affme; ?>" target="blank_">
				<img class="barvatar bv2" src="/i/logos/100/<?php echo seoUrl($t2name); ?>.png" alt="<?php echo $t2name; ?>" />
				<div href="http://sports.betway.com/esports/<?php echo seoUrl($gametype).'/'.$tournamentcode.'/'.seoUrl($t1name).'-'.seoUrl($t2name).'/correct-score/1-2'?>" class="cs2 txodds t2odds">1-2<br>odds: <?php echo $t221; ?></div>
				<div href="http://sports.betway.com/esports/<?php echo seoUrl($gametype).'/'.$tournamentcode.'/'.seoUrl($t1name).'-'.seoUrl($t2name).'/correct-score/0-2'?>" class="cs2 txodds t2odds">0-2<br>odds: <?php echo $t220; ?></div>
			</a>
		</div>
		<div style="height:1em;"></div>
	</div>
</div>