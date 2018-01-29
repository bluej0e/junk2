<?php /* Template Name: side table iframe */?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300,400italic' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="/js/jquery.bracket.min.js"></script>
		<script type="text/javascript" src="/js/classie.js"></script>
		<script type="text/javascript" src="/js/modernizr.custom.js"></script>
		<link rel="stylesheet" type="text/css" href="/js/jquery.bracket.min.css" />
		<!--link rel="stylesheet" type="text/css" href="/js/component.css" /-->
		<link rel="stylesheet" type="text/css" href="/js/default.css" />
		<link rel="stylesheet" href="/css/reset.css">
		<!-- CSS reset -->
		<link rel="stylesheet" href="/css/style.css">
		<!-- Gem style -->
		<script src="/js/modernizr.js"></script>
		<!-- Modernizr -->
		<script src="/js/main.js"></script>
		<!-- Gem jQuery -->
		<script type='text/javascript' src='http://www.bet-esport.com/wp-includes/js/jquery/jquery.js?ver=1.11.3'></script>
		<script type='text/javascript' src='http://www.bet-esport.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
		<link rel='https://api.w.org/' href='http://www.bet-esport.com/wp-json/' />
		<link rel="canonical" href="http://www.bet-esport.com/2190-2/" />
		<link rel="alternate" type="application/json+oembed" href="http://www.bet-esport.com/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fwww.bet-esport.com%2F2190-2%2F" />
		<link rel="alternate" type="text/xml+oembed" href="http://www.bet-esport.com/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fwww.bet-esport.com%2F2190-2%2F&#038;format=xml" />
		<link rel="stylesheet" href="http://www.bet-esport.com/s.css" />
	
		<style>
html {
    overflow: scroll;
    overflow-x: hidden;
}
::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
    </style>
		
		
		
		</head>

	<body style="background:url(/i/151515.jpg) repeat !important;">
		<div class="panel-body">
			<div id="pinnacleDiv" class="ui-widget">
				<div class="loading"></div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		function betlink_pinnacle(t) {
			document.location = referDeepUrl_pinnacle + "&leagueid=" + t + "&periodnumber=0"
		}
		var referDeepUrl_pinnacle = "http://affiliates.pinnaclesports.com/processing/clickthrgh.asp?btag=a_13738b_2&language=British&LExt=bri";
		var pinnacleArray;

		function pinOdds() {
			$.ajax({
				type: "GET"
				, url: url_pinnacle
				, dataType: "xml"
				, cache: !1
				, success: pinnacleXmlToTable
			});
		}

		function pinnacleXmlToTable(xml) {
			var pinnacleArray = {};
			$(xml).find("league").each(function () {
				var leagueId = $(this).find("id").first().text()
					, currentHeading = $(document.createElement("h4"));
				$.ajax({
					type: "GET"
					, url: url_pinnacle2
					, dataType: "xml"
					, cache: !1
					, success: function (t) {
						$(t).find("league").each(function () {
							$(this).attr("id") == leagueId && currentHeading.append($(this).text())
						})
					}
				, });
				$("#pinnacleDiv").append(currentHeading);
				var currentTable = $(document.createElement("table")).attr("class", "sideoddstable").attr("id", "tblPinnacle")
					, currentTableHead = $(document.createElement("thead")).attr("class", "sideoddstable");
				currentTableHead.append("<tr><th colspan='1' width='45%'>Team 1</th><th width='10%'>Date</th><th colspan='2' width='45%'>Team 2</th></tr>");
				var currentTableBody = $(document.createElement("tbody")).attr("class", "sideoddstable");
				currentTable.append(currentTableBody);
				var htmln = "";
				var skipMe = ['actually live before wagering.', 'Please make sure that your feed is', 'Live networth graph can be found on', 'http://www.dota2.com/watch', 'Due to coming from upper bracket', 'Orgless has 1-0 map advantage'];
				$(this).find("event").each(function () {
					if (skipMe.indexOf($(this).find("homeTeam").find("name").text().split(/\(([^)]+)\)/)[0]) == -1) {
						var tempteam = "";
						if ($(this).find("homeTeam").find("name").text().split(/\(([^)]+)\)/)[1]) {
							tempteam = $(this).find("homeTeam").find("name").text().split(/\(([^)]+)\)/)[1];
						}
						var t = $(this).find("startDateTime").text();
						currentTableBody.append("<tr class='sidetablerow1' data-league='" + leagueId + "' onClick='betlink_pinnacle(" + leagueId.toString() + ")'> <td>" + "<img alt='" + $(this).find("homeTeam").find("name").text().split('(')[0].trim() + "' src='/i/logos/" + $(this).find("homeTeam").find("name").text().split('(')[0].trim().split(" ").join("-").toLowerCase() + "-104x104.png'/><br/>" + $(this).find("moneyLine").find("homePrice").text() + "<br/>" + $(this).find("homeTeam").find("name").text().split('(')[0] + "</td> <td>VS</td> <td>" + "<img alt='" + $(this).find("awayTeam").find("name").text().split('(')[0].trim() + "' src='/i/logos/" + $(this).find("awayTeam").find("name").text().split('(')[0].trim().split(" ").join("-").toLowerCase() + "-104x104.png'/>" + "<br/>" + $(this).find("moneyLine").find("awayPrice").text() + "<br/>" + $(this).find("awayTeam").find("name").text().split('(')[0] + "</td></tr>")
					}
					$("#pinnacleDiv").append(currentTable)
				});
			});
			$(document).ajaxStop(function () {
				$('.loading').hide();
			});
		}
		var url_pinnacle = "http://www.bet-esport.com/xmlfeed/"
			, url_pinnacle2 = "http://www.bet-esport.com/xmlleague/";
		$(document).ready(function () {
			$(window).on('resize', function () {});
			pinOdds();
		});
	</script>