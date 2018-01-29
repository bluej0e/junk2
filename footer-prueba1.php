<style>
a.side_help{
	float: left;
	display: inline-block;
	text-align: center;
	width: 100%;
	height: 50px;
	font-size: 1.3em;
	line-height: 50px;
	overflow: hidden;
	background-color: #B71C1C;
	cursor: pointer;
	-webkit-transition: all 0.12s ease-in-out;
	-moz-transition: all 0.12s ease-in-out;
	-o-transition: all 0.12s ease-in-out;
	-ms-transition: all 0.12s ease-in-out;
	font-family: Anton;
	font-size: 2em;
	margin-bottom: 1px;
}
a.side_help:hover{
	font-weight: 500;
	background-color: #C62828;
}
.sh1{
	border-radius: 15px 15px 0px 0px;
}
.sh4{
	border-radius: 0px 0px 15px 15px;\
}
</style>

<div class="row">
	<div class="four columns">
		<h3>Follow us on Facebook</h3>
		<br>
		<div class="fb-page" data-href="https://www.facebook.com/betesportcom/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" hide_cta="true" data-show-facepile="true">
			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="https://www.facebook.com/betesportcom/">
					<a href="https://www.facebook.com/betesportcom/">Bet eSport</a>
				</blockquote>
			</div>
		</div>
	</div>
	<div class="four columns">
		<h3>New to eSports betting?</h3>
		<br>
		<a class="tournaments" style="width:100%;clear:both;" href="http://www.bet-esport.com/so-youre-looking-to-bet-money-on-esports/" title="WHAT ARE ESPORTS?">WHAT ARE ESPORTS?</a>
		<a class="tournaments" style="width:100%;clear:both;" href="http://www.bet-esport.com/how-to-bet-on-esports/" title="HOW TO BET ON ESPORTS">HOW TO BET ON ESPORTS</a>
		<a class="tournaments" style="width:100%;clear:both;" href="http://www.bet-esport.com/esports-betting-houses/" title="ESPORTS BETTING HOUSES">ESPORTS BETTING HOUSES</a>
		<a class="tournaments" style="width:100%;clear:both;" href="http://www.bet-esport.com/esports-betting-tips/" title="ESPORTS BETTING TIPS">ESPORTS BETTING TIPS</a>
		<br>
	</div>
	<div class="four columns">
		<h4>Check out this video guide to understand how odds work</h4>
		<br>
		<div class="flex-video" style="height:150px!important; padding-bottom: 150px;">
			<iframe src="https://www.youtube.com/embed/seGEKQdzyYY?rel=0" frameborder="0" allowfullscreen="allowfullscreen">
			</iframe>
		</div>
	</div>
<div style="width:100%;clear:both;"></div>
	<div class="footer">
		<div class="twelve columns" >
			<center>    			
				<a href="https://www.facebook.com/betesportcom/" target="_blank">
					<i class="fa fa-facebook-official fa-3x">
					</i>
				</a>
				<a href="https://twitter.com/BetEsportCom" target="_blank">
					<i class="fa fa-twitter fa-3x">
					</i> 
				</a>
				<a href="https://www.youtube.com/channel/UC_7AsMpmxsT1veTjqLO5RTg" target="_blank">
					<i class="fa fa-youtube-play fa-3x">
					</i>
				</a>
				<a href="https://plus.google.com/+Betesports" target="_blank">
					<i class="fa fa-google-plus fa-3x">
					</i> 
				</a>
				<a href="http://feeds.feedburner.com/###o/" target="_blank">
					<i class="fa fa-rss-square fa-3x">
					</i> 
				</a>
			</center>

		</div>
	</div>
	<div>
		<center>
			<p>&nbsp;<br> Copyright © 2017 bet-esport.com</p> <a href="http://www.bet-esport.com/map/">Sitemap</a> | <a href="http://www.bet-esport.com/contact/">Contact</a> </p>
		</center>
	</div>
	<div style="height: 30px;"></div>
</div>

</body> 
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
<script>
	(function () {
		var allimgs = document.images;
		for (var i = 0; i < allimgs.length; i++) {
			allimgs[i].onerror = function () {
				this.src='/i/default_sheild.png';
			}
		}
	})();
	$(window).load(function () {
		$("img").each(function () {
			var image = $(this);
			if (image.context.naturalWidth == 0 || image.readyState == 'uninitialized') {
				$(image).unbind("error").hide();
			}
		});
	});
</script>
</html>