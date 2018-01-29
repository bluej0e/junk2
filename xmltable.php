<?php 	$feedUrl = 'https://api.pinnaclesports.com/v1/fixtures?sportid=12';
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
$initialFeed = curl_exec($httpChannel); ?>

<?php get_header(); /* Template Name: XML TABLE */?>

<div class="row">

	<div class="twelve columns">
	    
		<div class="row"> 

			<div class="eight columns">

  			<div class="loading" style="display: none;">
				<div class="loading">Loading&#8230;</div>
			</div>

                
				<h1>eSport Betting Odds</h1>
				
				<div>
				<?php echo $initialFeed; ?>
				</div>
				
    <div class="panel-body">

		<div id="pinnacleDiv" class="ui-widget">

			
	<div id="calcbox">	
	<div id="calcbtn">ODDS CALCULATOR</div>
	  <div class="sidecalc" >
                <div name="calculator">
                    <div class="calc-boxes">
                        <calctext>Stake</calctext> <input placeholder="0" type="number" name="STAKE" id="input" class="input-list style-4 clearfix calculatethis" maxlength="4">
                    </div>
                    <div class="calc-boxes">
                        <calctext>Odds</calctext> <input placeholder="0" type="number" name="ODDS" id="input" class="input-list style-4 clearfix calculatethis" maxlength="4">
                    </div>
                    <div class="calc-boxes">
                        <calctext>Return</calctext> <input readonly placeholder="0" type="number" name="TOTAL" id="output" class="input-list style-4 clearfix" maxlength="4">
                    </div>
                    <div class="calc-boxes">
                        <calctext>Profit</calctext> <input readonly placeholder="0" type="number" name="WIN" id="output" class="input-list style-4 clearfix" maxlength="4">
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

	var test = <?php echo json_encode($initialFeed); ?>;

	
    function betlink_pinnacle(t) {
    document.location = referDeepUrl_pinnacle + "&leagueid=" + t + "&periodnumber=0"
}

	
    var referDeepUrl_pinnacle =  "http://affiliates.pinnaclesports.com/processing/clickthrgh.asp?btag=a_13738b_2&language=British&LExt=bri";
    var pinnacleArray;
        
 /*   function pinOdds() {
            
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
                var leagueId = $(this).find("id").first().text(),
                    currentHeading = $(document.createElement("h2"));
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
                var currentTable = $(document.createElement("table")).attr("class","pinnacleodds").attr("id", "tblPinnacle"),
                    currentTableHead = $(document.createElement("thead")).attr("class","pinnacleodds");

                currentTableHead.append("<tr><th width='100'>Date</th><th width='250'>Team 1</th><th width='250'>Team 2</th><th width='70'>1</th><th width='70'>x</th><th width='70'>2</th></tr>"), currentTable.append(currentTableHead);

                var currentTableBody = $(document.createElement("tbody")).attr("class","pinnacleodds");
                currentTable.append(currentTableBody);
                var htmln = "";
                $(this).find("event").each(function() {
                    var t = $(this).find("startDateTime").text();
                    currentTableBody.append("<tr id='pinnacle_line' data-league='" +
                        leagueId + "' onClick='betlink_pinnacle(" + leagueId.toString() +
                        ")'><td nowrap='nowrap'>" + t.split("T")[0] + " " + t.split("T")[1]
                        .split(":00Z")[0] + "</td><td>" + $(this).find("homeTeam").find(
                            "name").text() + "</td><td>" + $(this).find("awayTeam").find(
                            "name").text() + "</td><td>" + $(this).find("moneyLine").find(
                            "homePrice").text() + "</td><td>" + $(this).find("moneyLine").find(
                            "drawPrice").text() + "</td><td>" + $(this).find("moneyLine").find(
                            "awayPrice").text() + "</td></tr>")
                });
                $('#table-holder').append("<div id='"+leagueId+"'></div>");
                $('#'+leagueId).hide();
                $('#'+leagueId).append(currentHeading);
                $('#'+leagueId).append(currentTable);
            });
            $(document).ajaxStop(function() {
                for (var key in pinnacleArray) {
                    $('#pinnacle-loadbar').append('<div class="game-key btn btn-1 btn-1a" data-id="'+key+'">'+key+'</div>');
                };
                $('#pinnacle-loadbar').append('<div class="game-key btn btn-1 btn-1a" data-id="all">All</div>');
                $('.game-key').click(function (){
                    $('#pinnacle-leaguebar').html('');
                    if($(this).data('id') == 'all'){
                        $('#table-holder div').show();
                    }else{
                        for (var key in pinnacleArray[$(this).data('id')]) {
                            $('#pinnacle-leaguebar').append('<div class="game-key-league btn btn-1 btn-1a" data-id="'+pinnacleArray[$(this).data('id')][key].id+'">'+pinnacleArray[$(this).data('id')][key].name+'</div>');
                        };
                        $('.game-key-league').click(function (){
                            $('#table-holder div').hide();
                            $('#'+$(this).data('id')).show();
                        });
                    }
                });
            });
        }
   
                var url_betway = "ing.eu/odds/betwaylines/",
                    url_betathome = "ing.eu/odds/betathomelines/",
                    url_pinnacle = "http://www.bet-esport.com/xmlfeed/",
                    url_pinnacle2 = "http://www.bet-esport.com/xmlleague/";
    
    
	$(document).ready(function(){
		
			console.log(test);
		
		
		$(window).on('resize', function(){
$('#calcbox').width($('#pinnacleDiv').width());
});
		$('#calcbox').width($('#pinnacleDiv').width());
		 $('#calcbtn').click(function (){
	 $('.sidecalc').slideToggle("slow");
 });
		
//		pinOdds();
	
$('.calculatethis').change(function(){
	if($('.sidecalc input[name="ODDS"]').val() && $('.sidecalc input[name="STAKE"]').val()){
	calculate();		
	}
});

	
	});
    
    
    
    
    function calculate() {
		var ODDS =  $('.sidecalc input[name="ODDS"]').val();
		var STAKE =  $('.sidecalc input[name="STAKE"]').val();
		var CALC1 = STAKE*ODDS;
		var CALC2 = CALC1-STAKE;
 		$('.sidecalc input[name="TOTAL"]').val(CALC1.toString().substring(0,4));
		$('.sidecalc input[name="WIN"]').val(CALC2.toString().substring(0,4));

        
}

</script>



<?php get_footer(); ?>