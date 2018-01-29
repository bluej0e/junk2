<?php get_header(); /* Template Name: other matches*/
$gamepage = 'Other Games' ?>
<div class="row">
  <div class="twelve columns">
    <div class="row">
      <div class="eight columns">
        <br>
        <h1><?php echo $gamepage; ?></h1>
        <h5>All current other games</h5>
        <hr/>
        <h4>Current and Upcoming Games</h4>
        <div class="panel-body"> </div>

        <?php
        $d = mktime();
        $partidoz = new WP_Query( array(
          'post_type'     => 'match',
          'orderby'       => 'meta_value',
          'order'         => 'ASC',
          'showposts'     => 100000,
          'meta_query'    => array(
            array(
              'key'       => 'datecomp',
              'value'     => $d,
              'compare'   => '>='
              ),
            array(
              'key'       => 'gametype',
              'value'     => 'Dota 2',
              'compare'   => '!='
              ),
            array(
              'key'       => 'gametype',
              'value'     => 'League of Legends',
              'compare'   => '!='
              ),
            array(
              'key'       => 'gametype',
              'value'     => 'CS GO',
              'compare'   => '!='
              ),
            ),  
          )
        );  
        $torneo_array = array();

        if ( $partidoz->have_posts() ) : while ( $partidoz->have_posts() ) : $partidoz->the_post(); 
        $torneo = get_post_meta(get_the_ID(), 'tournament', true);

        $title_array = explode(" – ", get_the_title());
        $title_date = substr($title_array[1], -10);
        $gametype = get_post_meta(get_the_ID(), 'gametype', true);
        $eltime = get_post_meta(get_the_ID(), 'time', true);
        $t1name = get_post_meta(get_the_ID(), 't1name', true);
        $t1odds = get_post_meta(get_the_ID(), 't1odds', true);
        $t2name = get_post_meta(get_the_ID(), 't2name', true);
        $t2odds = get_post_meta(get_the_ID(), 't2odds', true);

        setlocale(LC_ALL,"en_EN");
        $fechahumana = DateTime::createFromFormat("Y/m/d", explode(" ", get_post_custom_values('time')[0])[0]);
        $fechaH= strftime("%B %d, %Y",$fechahumana->getTimestamp()); 

        $torneo_array[$torneo][] = array(
          'title' =>  $title_array[0],
          'url' => get_permalink(),
          'data' => $gametype,
          'day' => $fechaH,
          'month' => $monthName,
          'time' => substr($eltime, 11, -7),
          't1name' => $t1name,
          't1odds' => $t1odds,
          't2name' => $t2name,
          't2odds' => $t2odds,
          );

        endwhile; endif; 

        TorSep($torneo_array);

        function TorSep($tor_array){
          foreach ($tor_array as $key=>$tor){
            echo '<div class="torneogroup '. seoUrl($tor[0]['data']) .'"  id="'. seoUrl($key) .'" value="'. $tor[0]['data'] .'">';
            echo '<img alt="Partidos de '.$key.'"src="/i/p/'. seoUrl($tor[0]['data']).'-50.png" style="height:40px; vertical-align:text-bottom; margin-left:20px; display:inline-block;"/><h2 style="display:inline-block; width:80%;">'. $key .'</h2>';
            echo '<div class="torneogroups">';
            Ttor($tor);
            echo '</div>';
            echo '</div>';  
          }
        }
        function Ttor($thor){
          foreach( $thor as $t){
            echo '<a href="'.$t['url'].'"><div class="partido"><div class="timebar tourname">' . $t['day'] . '<div class="timebox"></div></div><div class="leftbox"><div class="team1"><img onerror=this.src="/i/default_sheild.png" src="/i/logos/100/' .seoUrl($t['t1name']). '.png" alt="' .$t['t1name']. '"/></div><div style="white-space: nowrap;"><div class="h11">' .$t['t1name']. '</div><br><div class="h7">'  .$t['t1odds']. '</div></div></div><div class="centerbox" style="height:8em;"><div class="h11"> x </div><br><div class="h7"></div></div><div class="rightbox"><div class="team2"><img onerror=this.src="/i/default_sheild.png" src="/i/logos/100/' .seoUrl($t['t2name']). '.png" alt="' .$t['t2name']. '"/></div><div style="white-space: nowrap;"><div class="h11">' .$t['t2name']. '</div><br><div class="h7">' .$t['t2odds']. '</div></div></div></div></a>';
          }
        }
        wp_reset_query(); ?>
        <div id="nonehere" style="display:none">No <?php echo $gamepage; ?> matches at the moment.</div>
        <br />




        <!--script>
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
        </script-->


        <hr>

          <!--<h3>More Stories:</h3>
          < ?php
				$args = array(
					'posts_per_page'   => 3,
					'orderby'          => 'post_date',
          'category_name'    => 'News',
					'order'            => 'DESC',
					'post_status'      => 'publish',
               	);
				 
				$ultimos = new WP_Query( $args );
				 
				if ( $ultimos->have_posts() ) {
					while ( $ultimos->have_posts() ) {		
						$ultimos->the_post();
				?>
            <a href="< ?php the_permalink(); ?>">
              <div>
                < ?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					}
					?>
              </div>
              <h2>< ?php the_title();?></h2>
              < ?php the_excerpt(); ?>
            </a>
            <hr />
            < ?php	
					}
				} else {
					
				echo 'No more posts.';	
				}
				wp_reset_postdata();
				?>-->
      </div>
      <div class="four columns">
        <?php include ('side.php'); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>