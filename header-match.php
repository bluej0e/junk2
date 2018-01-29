<!DOCTYPE html>
<html lang="en">
<head>
	<?php 

	$zdate = explode(" ", get_post_custom_values('time')[0]); 
	$fk = explode(":", $zdate[1]); 
	$fg = explode("/",$zdate[0]); 
	$fecha_actual = mktime(0, 0, 0); 
	$diferencia = 260000; 
	$game_date = mktime($fk[0], $fk[1], $fk[2], $fg[1], $fg[2], $fg[0]);

	$robocop = ($fecha_actual - $diferencia) > $game_date ? 'noindex,follow' : 'index,follow'; ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo get_post_custom_values('seo_title')[0]; ?></title>
	<meta name="description" content="<?php echo get_post_custom_values('seo_description')[0]; ?>" />
	<meta name="keywords" content="<?php echo get_post_custom_values('seo_keywords')[0]; ?>" />
	<meta name="robots" content="<?php echo $robocop; ?>" />
	<meta name="googlebot" content="<?php echo $robocop; ?>" />
	<meta name="revisit-after" content="2 days" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="//my.hellobar.com/bea66eed0652618cc7b8aa9d4847fd4dcc5990fb.js" type="text/javascript" charset="utf-8" async="async"></script>
	<link rel="stylesheet" type="text/css" href="/s2.css">
	<link rel="stylesheet" type="text/css" href="/s2m.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="/js/jquery.simple.timer.js"></script>



<!-- 	<script type="text/javascript" src="/js/moment-with-locales.min.js"></script>
 --><!-- 	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
 -->	<!--?php wp_head(); ?-->
</head>

<body>
	<!-- Google Tag Manager -->
	<noscript>
		<iframe src="//www.googletagmanager.com/ns.html?id=GTM-P48WKL" height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
	<script>
		(function (w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime()
				, event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0]
			, j = d.createElement(s)
			, dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-P48WKL');
	</script>
	<!-- End Google Tag Manager -->
	<div id="fixed-div">
		<?php edit_post_link('<i class="fa fa-pencil-square fa-3x" aria-hidden="true"></i>
'); ?>
	</div>
	
	<?php include('menubar.php'); ?>
	