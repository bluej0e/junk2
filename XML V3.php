<?php
	/* Template Name: XML TABLE V3 */
	get_header();

	$feedUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=12';
	$credentials = base64_encode("AFF4626:M1l1c0s@");

	$header[] = 'Content-length: 0';
	$header[] = 'Content-type: application/json';
	$header[] = 'Authorization: Basic ' . $credentials;
	$httpChannel = curl_init();

	curl_setopt($httpChannel, CURLOPT_URL, $feedUrl);
	curl_setopt($httpChannel, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($httpChannel, CURLOPT_HTTPHEADER, $header);
	curl_setopt($httpChannel, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)' );
	curl_setopt($httpChannel, CURLOPT_SSL_VERIFYPEER, false);
	$initialFeed = curl_exec($httpChannel);
?>
		
	
<script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<div class="row">
	<div class="twelve columns">
		<div class="row"> 
			<div class="eight columns">       
				<h1>eSport Betting Odds</h1>
				<div class="panel-body">
					<div id="pinnacleDiv" class="ui-widget">
						<div class="loading"></div>
						<div id="calcbox">  
							<div id="calcbtn">ODDS CALCULATOR</div>
							<div class="sidecalc" >
								<div name="calculator">
									<div class="calc-boxes">
										<calctext>Stake</calctext>
										<input placeholder="0" type="number" name="STAKE" id="input" class="input-list style-4 clearfix calculatethis" maxlength="4">
									</div>
									<div class="calc-boxes">
										<calctext>Odds</calctext>
										<input placeholder="0" type="number" name="ODDS" id="input" class="input-list style-4 clearfix calculatethis" maxlength="4">
									</div>
									<div class="calc-boxes">
										<calctext>% Win</calctext>
										<input readonly placeholder="0" type="number" name="CHANCE" id="output" class="input-list style-4 clearfix" maxlength="4">
									</div>
									<div class="calc-boxes">
										<calctext>Return</calctext>
										<input readonly placeholder="0" type="number" name="TOTAL" id="output" class="input-list style-4 clearfix" maxlength="4">
									</div>
									<div class="calc-boxes">
										<calctext>Profit</calctext>
										<input readonly placeholder="0" type="number" name="WIN" id="output" class="input-list style-4 clearfix" maxlength="4">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="four columns">
				<?php include ('side.php'); ?>                  
			</div>
		</div>
	</div> 
</div>

<script type="text/javascript">

	//Calculator function
	function calculate() {
		var ODDS =  $('.sidecalc input[name="ODDS"]').val();
		var STAKE =  $('.sidecalc input[name="STAKE"]').val();
		var CALC1 = STAKE*ODDS;
		var CALC2 = CALC1-STAKE;
		var CALC3 = ((1/ODDS)*100);
		$('.sidecalc input[name="CHANCE"]').val(CALC3.toString().substring(0,5));
		$('.sidecalc input[name="TOTAL"]').val(CALC1.toString().substring(0,5));
		$('.sidecalc input[name="WIN"]').val(CALC2.toString().substring(0,5));
	}
	//Create pinnacle link
	var referDeepUrl_pinnacle =  "http://affiliates.pinnaclesports.com/processing/clickthrgh.asp?btag=a_13738b_2&language=British&LExt=bri";
	function betlink_pinnacle(t) {
		document.location = referDeepUrl_pinnacle + "&leagueid=" + t + "&periodnumber=0"
	}

	/*
	function pinOdds() {
		$.ajax({
			type: "GET",
			url: url_pinnacle,
			dataType: "xml",
			cache: !1,
			success: pinnacleXmlToTable
		});
	}
	*/
	function pinnacleXmlToTable(xml) {
		var pinnacleArray = {};
		$('#pinnacleDiv').append("<div id='pinnacle-loadbar' class='buttons'></div><hr><div id='pinnacle-leaguebar' class='buttons'></div><div id='table-holder'></div>");
		$(xml).find("league").each(function() {
			var leagueId = $(this).find("id").first().text()
			var currentHeading = $(document.createElement("h2"));
			$.ajax({
				type: "GET",
				url: url_pinnacle2,
				dataType: "xml",
				cache: !1,
				success: function(t) {
					$(t).find("league").each(function() {
						$(this).attr("id") == leagueId && currentHeading.append($(this).text());
						if($(this).attr("id") == leagueId){
							var tempStringArray = $(this).text().split('-');
							if(!pinnacleArray[tempStringArray[0]]){
								pinnacleArray[tempStringArray[0]] = [];
							}
							pinnacleArray[tempStringArray[0]].push({name:tempStringArray[1], id:leagueId});
						}
					})
				},
				error: function(xhr, status, error) {
					alert(xhr), alert(status), alert(error);
					var err = eval("(" + xhr.responseText + ")");
					alert(err.Message)
				}
			});
			var currentTable = $(document.createElement("table")).attr("class","oddstable").attr("id", "tblPinnacle")
			var currentTableHead = $(document.createElement("thead")).attr("class","oddstable");
			currentTableHead.append("<tr><th colspan='2'>Team 1</th><th>Date</th><th colspan='2'>Team 2</th></tr>");
			var currentTableBody = $(document.createElement("tbody")).attr("class","oddstable");
			currentTable.append(currentTableBody);
			var htmln = "";
			var skipMe = ['actually live before wagering.', 'Please make sure that your feed is', 'Live networth graph can be found on', 'http://www.dota2.com/watch', 'Due to coming from upper bracket', 'Orgless has 1-0 map advantage', '"Most ESL One Manila matches will'];
			$(this).find("event").each(function() {
				if (skipMe.indexOf($(this).find("homeTeam").find("name").text().split(/\(([^)]+)\)/)[0]) == -1) {
					var tempteam = ""; 
					if($(this).find("homeTeam").find("name").text().split(/\(([^)]+)\)/)[1]){
						tempteam = $(this).find("homeTeam").find("name").text().split(/\(([^)]+)\)/)[1];
					}
					if(!tempteam){
						tempteam = "vs";
					}
					var t = $(this).find("startDateTime").text();
					currentTableBody.append("<tr class='tablerow1' id='pinnacle_line' data-league='" + leagueId + "' onClick='betlink_pinnacle(" + leagueId.toString() + ")'><td rowspan='2'>" + "<img width='80px' alt='" + $(this).find("homeTeam").find("name").text().split('(')[0].trim() + "' src='/i/logos/" + $(this).find("homeTeam").find("name").text().split('(')[0].trim().split(" ").join("-").toLowerCase() + "-104x104.png'/>" + "</td><td class='tableteamname'>" + $(this).find("homeTeam").find("name").text().split('(')[0] + "</td><td class='tablemaptype'>" + tempteam + "</td><td class='tableteamname'>" + $(this).find("awayTeam").find("name").text().split('(')[0] + "</td><td rowspan='2'>" + "<img width='80px' alt='" + $(this).find("awayTeam").find("name").text().split('(')[0].trim()+ "' src='/i/logos/" + $(this).find("awayTeam").find("name").text().split('(')[0].trim().split(" ").join("-").toLowerCase() + "-104x104.png'/>" + "</td></tr>");
					currentTableBody.append("<tr class='tablerow2' id='pinnacle_line' data-league='" +leagueId + "' onClick='betlink_pinnacle(" + leagueId.toString() + ")'><td class='tableteamodds'>"  + $(this).find("moneyLine").find("homePrice").text() + "</td><td class='tabletdate'>" + t.split("T")[0] + " " + t.split("T")[1].split(":00Z")[0] + " GMT" + "</td><td class='tableteamodds'>" + $(this).find("moneyLine").find("awayPrice").text() +  "</td></tr>");
				}
			});
			$('#table-holder').append("<div id='"+leagueId+"'></div>");
			$('#'+leagueId).hide();
			$('#'+leagueId).append(currentHeading);
			$('#'+leagueId).append(currentTable);
		});

		$(document).ajaxStop(function() {
			$('.tablerow2').hover(function(){
				$(this).attr('data-prevcolor',$(this).css('background-color'));
				$(this).prev().css('background-color','#e7671b');
				$(this).css('background-color','#e7671b');
			},function(){ 
				$(this).prev().css('background-color', $(this).data('prevcolor'));
				$(this).css('background-color', $(this).data('prevcolor'));
			});
			for (var key in pinnacleArray) {
				$('#pinnacle-loadbar').append('<div class="game-key btn btn-1 btn-1a" data-id="'+key+'">'+key+'</div>');
			};
			$('#pinnacle-loadbar').append('<div class="game-key btn btn-1 btn-1a" data-id="all">All</div>');
			$('.game-key').click(function (){
				$.each($('.game-key'),function(i,value){
					$(value).css('background-color','#343434'); 
				});
				$(this).css('background-color','#e7671b');
				$('#pinnacle-leaguebar').html('');
				if($(this).data('id') == 'all'){
					$('#table-holder div').show();
				}else{
					for (var key in pinnacleArray[$(this).data('id')]) {
						$('#pinnacle-leaguebar').append('<div class="game-key-league btn btn-1 btn-1a" data-id="'+pinnacleArray[$(this).data('id')][key].id+'">'+pinnacleArray[$(this).data('id')][key].name+'</div>');
					};
					$('.game-key-league').click(function (){
						$.each($('.game-key-league'),function(i,value){
							$(value).css('background-color','#343434'); 
						});
						$(this).css('background-color','#e7671b');
						$('#table-holder div').hide();
						$('#'+$(this).data('id')).show();
					});
				}
			});
			$('.loading').hide();
		});
	}
	var url_pinnacle = "http://www.bet-esport.com/xmlfeed/";
	var url_pinnacle2 = "http://www.bet-esport.com/xmlleague/";

	//When document loads
	$(document).ready(function(){
		//php to JSON TEST
		var jsoninfo = JSON.parse('<?php echo $initialFeed; ?>');
		console.log(jsoninfo, "TESTING JSON DATA 1");

		//php to JSON TEST 2
		$.ajax({
			type: "GET",
			url: 'https://api.pinnaclesports.com/v1/fixtures?sportid=12',
			dataType: "json",
			beforeSend: function (xhr) {
				xhr.setRequestHeader ("Authorization", "Basic " + btoa("AFF4626:M1l1c0s@"));
			},
			success: function (data){
				console.log(data, 'TESTING JSON DATA 2');
			}
		});

		$('.loading').show();
		// pinOdds();

		//Calculator related
		$(window).on('resize', function(){
			$('#calcbox').width($('#pinnacleDiv').width());
		});
		$('#calcbox').width($('#pinnacleDiv').width());
		$('#calcbtn').click(function (){
			$('.sidecalc').slideToggle("slow");
		});
		$('.calculatethis').change(function(){
			if($('.sidecalc input[name="ODDS"]').val() && $('.sidecalc input[name="STAKE"]').val()){
				calculate();    
			}
		});
	});

</script>

<?php get_footer(); ?>