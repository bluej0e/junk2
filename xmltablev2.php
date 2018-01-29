<?php get_header(); /* Template Name: XML TABLE V2 */?>
  <div class="row">
    <div class="twelve columns">
      <div class="row">
        <div class="eight columns">
          <h1>eSport Betting Odds</h1>
          <div class="panel-body"> </div>
        </div>
        <div class="four columns">
          <?php include ('side.php'); ?>
        </div>
      </div>
    </div>
  </div>
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
    var reflink = "/?s=bfp109554";
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
              var fechaD = moment(dateD, "YYYY/MM/DD").format('MM/DD/YYYY');
              var fechaH = moment.utc(dateH, "HH:mm:ss +0000").local().format('h:mm');
              var fecha = '<i class="fa fa-calendar" aria-hidden="true"></i> &nbsp' + fechaD + ' &nbsp&nbsp <i class="fa fa-clock-o" aria-hidden="true"></i> ' + fechaH;
              var tourname = $(this).find("Keywords").find('Keyword[type_cname="league"]').text().slice(1, -1);
              var tournament =  '<i class="fa fa-trophy" aria-hidden="true"></i> &nbsp' + tourname;

              $(this).find('Market[cname="match-winner"][type_cname="to-win"]').each(function (t) {
                var t1name = $(this).find("Outcome[index=1]").find("Name").text();
                var t2name = $(this).find("Outcome[index=2]").find("Name").text();
                var t1odds = $(this).find("Outcome[index=1]").attr("price_dec");
                var t2odds = $(this).find("Outcome[index=2]").attr("price_dec");
                var t1img = t1name.trim().split(" ").join("-").toLowerCase();
                var t2img = t2name.trim().split(" ").join("-").toLowerCase();
                var t1linkout = $(this).find("Outcome[index=1]").find("Quicklink").text() + reflink;
                var t2linkout = $(this).find("Outcome[index=2]").find("Quicklink").text() + reflink;
                
                $('.panel-body').append('<div class="partido"><div class="timebar tourname">' + tournament + '<div class="timebox">' + fecha + '</div></div><div onclick="OpenInNewTab(' + "'" + t1linkout + "'" + ');" class="leftbox"><div class="team1"><img onerror=\'this.src="/i/default_sheild.png"\' src="/i/logos/100/' + t1img + '.png" alt="' + t1name + '"/></div><div style="white-space: nowrap;"><div class="h11">' + t1name + '</div><br><div class="h7">' + t1odds + '</div></div></div><div class="centerbox" style="height:8em;"><div class="h11"> x </div><br><div class="h7"></div></div><div onclick="OpenInNewTab(' + "'" + t2linkout + "'" + ');" class="rightbox"><div class="team2"><img onerror=\'this.src="/i/default_sheild.png"\' src="/i/logos/100/' + t2img + '.png" alt="' + t2name + '"/></div><div style="white-space: nowrap;"><div class="h11">' + t2name + '</div><br><div class="h7">' + t2odds + '</div></div></div></div>');
               
              });
            });
          });
        }
      });
    });
  </script>
  <?php get_footer(); ?>