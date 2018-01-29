<?php /* Template Name: table iframe */?>

<!DOCTYPE html>
<html lang="en">
<head>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300,400italic' rel='stylesheet' type='text/css'>
    
<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/js/jquery.bracket.min.js"></script>
<script type="text/javascript"  src="/js/moment-with-locales.min.js"></script>
<link rel="stylesheet" href="http://www.bet-esport.com/css/reset.css"> <!-- CSS reset -->
<link rel="stylesheet" id="font-awesome-css" href="/css/font-awesome.min.css" type="text/css" media="all">
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
                        
                        
   
    </div>     
    </div>           
    
    </body>
 
 <script>

function OpenInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }
    Number.prototype.padLeft = function (base, chr) {
        var len = (String(base || 10).length - String(this).length) + 1;
        return len > 0 ? new Array(len).join(chr || '0') + this : this;
    } 


    var xmlURL = "http://feeds.betway.com/events?key=BD70EBBA&keywords=esports";
    var xmlURL2 = "https://cors-anywhere.herokuapp.com/http://feeds.betway.com/events?key=BD70EBBA&keywords=esports";
    var reflink = "?s=bw38578";
  
    $(document).ready(function () {
      $.ajax({
        type: "GET"
        , url: xmlURL2
        , crossDomain: true
        , dataType: "xml"
        , cache: !1
        , success: function xmlLoader(xml) {
          $(xml).find("EventList").each(function () {
            
            $(this).find("Event").each(function () {          
                    
              var dateD = $(this).attr("start_at").split(" ")[0];
              var dateH = $(this).attr("start_at").split(" ")[1];
              var fechaD = moment(dateD, "YYYY/MM/DD").format('MM/DD');
              var fechaH = moment.utc(dateH, "HH:mm:ss +0000").local().format('H:mm');
              var fecha = '<i class="fa fa-calendar" aria-hidden="true"></i> &nbsp' + fechaD + ' &nbsp&nbsp <i class="fa fa-clock-o" aria-hidden="true"></i> ' + fechaH;
            
            $(this).find('Market[cname="match-winner"][type_cname="to-win"]').each(function (t) {
              
              var t1name = $(this).find("Outcome[index=1]").find("Name").text();
              var t2name = $(this).find("Outcome[index=2]").find("Name").text();
              var t1odds = $(this).find("Outcome[index=1]").attr("price_dec");
              var t2odds = $(this).find("Outcome[index=2]").attr("price_dec");
              var t1img = t1name.trim().split(" ").join("-").toLowerCase();
              var t2img = t2name.trim().split(" ").join("-").toLowerCase();
              var t1linkout = $(this).find("Outcome[index=1]").find("Quicklink").text();
              var t2linkout = $(this).find("Outcome[index=2]").find("Quicklink").text();
              
              console.log(t2linkout);
                           
              $('.panel-body').append('<div class="partido"><div class="timebar"><div class="timebox">' + fecha + '</div></div><div onclick="OpenInNewTab(' + "'" + t1linkout + "'" + ');" class="leftbox"><div class="team1"><img onerror="this.style.visibility=\'hidden\';" src="/i/logos/' + t1img + '-104x104.png" alt="' + t1name + '"/></div><div style="white-space: nowrap;"><div class="h11">' + t1name + '</div><br><div class="h7">' + t1odds + '</div></div></div><div class="centerbox" style="height:8em;"><div class="h11"> x </div><br><div class="h7"></div></div><div onclick="OpenInNewTab(' + "'" + t2linkout + "'" + ');" class="rightbox"><div class="team2"><img onerror="this.style.visibility=\'hidden\';"  src="/i/logos/' + t2img + '-104x104.png" alt="' + t2name + '"/></div><div style="white-space: nowrap;"><div class="h11">' + t2name + '</div><br><div class="h7">' + t2odds + '</div></div></div></div>');
              
              //original// $('.panel-body').append('<div class="partido"><div class="timebar"><div class="timebox">' + fecha + '</div></div><div onclick="OpenInNewTab(' + "'" + t1linkout + "'" + ');" class="leftbox"><div class="team1"><img onerror="this.style.visibility=\'hidden\';"  src="/i/' + t1img + '-100.png" alt="' + t1name + '"/></div><div style="white-space: nowrap;"><div class="h11">' + t1name + '</div><br><div class="h7">' + t1odds + '</div></div></div><div onclick="OpenInNewTab(' + "'" + tielinkout + "'" + ');" class="centerbox" style="height:8em;"><div class="h11"> x </div><br><div class="h7">' + tieodds + '</div></div><div onclick="OpenInNewTab(' + "'" + t2linkout + "'" + ');" class="rightbox"><div class="team2"><img onerror="this.style.visibility=\'hidden\';"  src="/i/' + t2img + '-100.png" alt="' + t2name + '"/></div><div style="white-space: nowrap;"><div class="h11">' + t2name + '</div><br><div class="h7">' + t2odds + '</div></div></div></div>');
            });
          });
        });
    }
      });
    });
  </script>