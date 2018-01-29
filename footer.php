<div class="row">

	<div class="footer">

		<div class="twelve columns" style="background-color:#151515 !important">
        <center>    			
			<a href="https://www.facebook.com/betesportcom/" target="_blank"><i class="fa fa-facebook-official fa-3x"></i> </a>
			<a href="https://twitter.com/BetEsportCom" target="_blank"><i class="fa fa-twitter fa-3x"></i> </a>
            <a href="https://www.youtube.com/channel/UC_7AsMpmxsT1veTjqLO5RTg" target="_blank">
                <i class="fa fa-youtube-play fa-3x"></i> </a>
            <a href="https://plus.google.com/+Betesports" target="_blank">
                <i class="fa fa-google-plus fa-3x"></i> </a>
            <a href="http://feeds.feedburner.com/###o/" target="_blank">
                <i class="fa fa-rss-square fa-3x"></i> </a>
        </center>

</div>
	</div>


	<div>
		<center>
			<p>&nbsp;
				<br> Copyright © 2017 bet-esport.com</p>
			<a href="http://www.bet-esport.com/map/">Sitemap</a> | 
			<a href="http://www.bet-esport.com/contact/">Contact</a></p>
		</center>
	</div>
</div>
</div>


<div style="height: 30px;"/>
	</body>

	<script>
(function () {
var allimgs = document.images;
for (var i = 0; i < allimgs.length; i++) {
allimgs[i].onerror = function () {
//	this.style.visibility = "hidden"; // Other elements aren't affected. 
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