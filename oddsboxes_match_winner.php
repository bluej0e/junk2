<style>
.oddsbox {
	width: 100%;
	display: inline-block;
	margin-left: 0;
}
.oddsbox a{
	text-transform: uppercase;
	font-size: 1em;

}
.txodds {
	margin: 1vw;
	display: inline-block;
	vertical-align: middle;		
	line-height: normal;
	text-align: center;
	font-size: 1.5em;
	width: 100%;
	transform: translate(-0.5em,0em);
}
.az, .za{
	width:47%; 
	display:inline-block;
	text-align: center;
	justify-content: center;
	align-items: center;
	background-color: rgba(61, 70, 88, 0.3);
	border: 1px solid #3D4658;
	padding: 1em;
	text-transform: uppercase;
	font-weight: 800;
	font-family: 'Quantico', sans-serif;
	overflow: visible;
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	transition: all 0.3s cubic-bezier(.25,.8,.25,1);∏
}
.az:hover, .za:hover{
	background-color: #252C3A!important;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
	cursor: pointer;
	border: 1px solid #676f81;

}





.az:hover > .lg1{
	transform: scale(1.1);
}
.za:hover > .lg2{
	transform: scale(1.1);

}
.team_name{
	font-size: 1.8em;
}
.gdiv{
	height:2.5em;
	/*transform: translate(0px, 2em);*/
}
.gdiv:hover > .matchbar{
	height:1.2em;
	-webkit-transition: all 0.4s ease-in-out;
	-moz-transition: all 0.4s ease-in-out;
	-o-transition: all 0.4s ease-in-out;
	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
	cursor: default;
}
.gdiv:hover > .timeholder{
	/*display: none;*/
	-webkit-transition: all 0.4s ease-in-out;
	-moz-transition: all 0.4s ease-in-out;
	-o-transition: all 0.4s ease-in-out;
}
.matchbar {
	display: block;
	margin: auto;
	width: 100%;
	height: 0.1em;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	background-color: #2196F3;
	overflow: hidden;
	text-align: left;
	font-weight: 800;
	font-family: 'Quantico', sans-serif;
	color: #f0f0f0;
	font-size: 1.9em;
	line-height: 1.25em;
	z-index: 999;
	position: relative;
}

.matchbarfull {
	display: block;
	margin: auto;
	width: 100%;
	height: 100%;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	float: left;
	overflow: hidden;
	background-color: #F44336;
	text-align: right;
	font:inherit;
}
.timeholder{
	width: 100%;
	text-align: center;
	display: flex;
	position: absolute;
	justify-content: center; /* align horizontal */
	align-items: center; /* align vertical */
	font-family: 'Quantico', sans-serif;
	color: #f0f0f0;
}
.jst-hours {
	float: left;
}
.jst-minutes {
	float: left;
}
.jst-seconds {
	float: left;
}
.jst-clearDiv {
	clear: both;
}
.jst-timeout {
	color: red;
}
.jst-hours,
.jst-minutes,
.jst-seconds{
	font-size: 1.9em;
	line-height: 1.25em;
}
@media only screen and (max-width: 1000px) {
	h1{
		font-size: 2em;
		padding: 10px;
	}
	h2{
		font-size: 1.5em;
	}
	h3{
		font-size: 1em;
	}
	.team_name{
		font-size: 1.5em;
	}
}
@media only screen and (max-width: 599px) {
	.oddsbox h3 {
		font-size: 4vw;
	}
}
</style>
<div class="row">
	<div class="gdiv">		
		<div class="timeholder">
			<div class="timer-quick" data-seconds-left="<?php echo $gametime;?>"></div>
		</div>
		<div class="matchbar">
			<div class="matchbarfull" style="width: <?php echo round((1/$t1odds)*100)-4; ?>%"><?php echo round((1/$t1odds)*100)-4; ?>%&nbsp;&nbsp;</div>&nbsp;&nbsp;<?php echo round((1/$t2odds)*100)-4; ?>%
		</div>
	</div>
	<div class="twelve columns">
		<div class="oddsbox">

			<a class="az" style="float:left;" href="<?php echo "http://sports.betway.com/esports/". seoUrl($gametype)."/".$tournamentcode."/". seoUrl($t1name)."-". seoUrl($t2name)."/match-winner/1".$affme; ?>" target="blank_">
				<div class="txodds"><div class="team_name"><?php echo $t1name; ?></div><br>Odds: <?php echo $t1odds; ?><br>Chance to Win <?php echo round((1/$t1odds)*100)-4; ?>%</div>
			</a>
			<a class="za" style="float:right;" href="<?php echo "http://sports.betway.com/esports/". seoUrl($gametype)."/".$tournamentcode."/". seoUrl($t1name)."-". seoUrl($t2name)."/match-winner/2".$affme; ?>" target="blank_">
				<div class="txodds"><div class="team_name"><?php echo $t2name; ?></div><br>Odds: <?php echo $t2odds; ?><br>Chance to Win <?php echo round((1/$t2odds)*100)-4; ?>%</div>
			</a>
		</div>
		<center><p style="margin-bottom:2px; font-size: 0.8em;">Select to bet on who you think will win the match</p></center>

		<div style="height:1em;"></div>
	</div>
</div>

