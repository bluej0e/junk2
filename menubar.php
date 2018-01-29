<?php /* template name: menubar */ ?>
<div class="row" style="background-color: transparent;">	
	<div class="nav-tainer">
		<div class="nav-bar">
			<a href="http://www.bet-esport.com/">
				<div class="nav-bar-logo">
					<div class="hide-for-small"><img  alt="bet-esport logo" src="/i/logo2.png" />
						<br>
					</div><img alt="bet-esport logo" style="vertical-align:middle; height:48px" src="/i/logo_mob.png" /></div>
			</a>
			<a href="http://www.bet-esport.com/matches/">
				<div class="nav-bar-btn">
					<div class="h9 hide-for-small">MATCHES
						<br>
					</div><i class="nav-fa fa fa-gamepad " aria-hidden="true"></i></div>
			</a>
			<a href="http://www.bet-esport.com/tournaments/">
				<div class="nav-bar-btn">
					<div class="h9 hide-for-small">TOURNAMENTS
						<br>
					</div><i class="nav-fa fa fa-trophy " aria-hidden="true"></i></div>
			</a>
			<a href="http://www.bet-esport.com/how-to-bet-on-esports/">
				<div class="nav-bar-btn">
					<div class="h9 hide-for-small">TIPS
						<br>
					</div><i class="nav-fa fa fa-book " aria-hidden="true"></i></div>
			</a>
			<div class="nav-bar-btn nav-bar-search">
				<i id="loop" class="fa fa-search fa-1x" aria-hidden="true"></i>
				<i id="upsies" class="fa fa-chevron-up fa-1x" style="display:none;" aria-hidden="true"></i>
			</div>
		</div>
		<?php get_search_form(); ?>
		<div style="height: 50px"/>
		<?php include('top_ad.php'); ?>

        <script>
            $(document).ready(function(){
                $(".nav-bar-search").click(function(){
                    $("#search-form").slideToggle(500, "swing", function(){
                        $("#loop").toggle();
                        $("#upsies").toggle();            
                    });
                });
            });
        </script>