<style>
.match_head {
	width: 100%;
	height: auto;
	max-height: 300px;
	max-width: 1000px;
	text-align: center;
	display: flex;
	justify-content: center; /* align horizontal */
	align-items: center; /* align vertical */
	font: 6vw white;
	font-family: Anton;
	-webkit-text-stroke: 1px black;
}
.match_head img {
	width: 100%;
	max-width: 200px;
	height: auto;
}
.logo_container {
	background-color: transparent;
	padding: 3vw 5vw;
	display: inline-block;
	width: 46%;
}
</style>


<!-- <div class="match_head" style="background:url('/i/m/< ?php echo seoUrl($gametype)."-".rand(1, 3); ?>.jpg') no-repeat; background-size: cover;" > -->
	<div class="match_head" style="background:url('/i/m/<?php echo seoUrl($gametype) ?>-bg.jpg') no-repeat center top; height:auto;" >
		<div class="logo_container lg1"> <img alt="bet on <?php echo $t1name; ?>" src="/i/logos/200/<?php echo seoUrl($t1name); ?>.png" />
		</div>
		vs
		<div class="logo_container lg2" style="float:right!important;"><img alt="bet on <?php echo $t2name; ?>" src="/i/logos/200/<?php echo seoUrl($t2name); ?>.png" />
		</div>
	</div>
