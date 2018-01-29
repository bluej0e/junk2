<?php get_header();  /* Template Name: light list */?>
<div class="row">
  <div class="twelve columns">
    <div class="row">
      <div class="eight columns">
        <br>
        <div class="buttons">
          <button class="showsinglegame btn btn-8 btn-8b" value="all" ><img alt="Show All" src="http://www.bet-esport.com/i/showall_300.png"></button>
          <button class="showsinglegame btn btn-8 btn-8b" value="league-of-legends" target="1"><img alt="League of Legends" src="http://www.bet-esport.com/i/lol_300.png"></button>
          <button class="showsinglegame btn btn-8 btn-8b" value="dota-2" target="2"><img alt="Dota 2" src="http://www.bet-esport.com/i/dota_300.png"></button>
          <button class="showsinglegame btn btn-8 btn-8b" value="cs-go" target="3"><img alt="CS GO" src="http://www.bet-esport.com/i/csgo_300.png"></button>
          <div style="margin:-20px"></div>
          <button class="showsinglegame btn btn-8 btn-8b" value="hearthstone" target="4"><img alt="HS" src="http://www.bet-esport.com/i/hearthstone_300.png"></button>
          <button class="showsinglegame btn btn-8 btn-8b" value="heroes-of-the-storm" target="5"><img alt="HotS" src="http://www.bet-esport.com/i/hots_300.png"></button>
          <button class="showsinglegame btn btn-8 btn-8b" value="starcraft" target="6"><img alt="SC" src="http://www.bet-esport.com/i/sc_300.png"></button>
          <button class="showsinglegame btn btn-8 btn-8b" value="others" target="7"><img alt="Other games" src="http://www.bet-esport.com/i/others_300.png"></button>
        </div>                
        <br>
        <style>.torneogroup{display:hidden}</style>

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
          $torneo_array[$torneo][] = array(
            'title'=>  $title_array[0],
            'url' => get_permalink(),
            'gametype' => $gametype,
            'date' => str_replace("-2017","",$title_date),
            'time' => substr($eltime, 11, -7)
          );

        endwhile; endif; 

        TorSep($torneo_array);

        function TorSep($tor_array){
          foreach ($tor_array as $key=>$tor){
            echo '<div class="torneogroup '. seoUrl($tor[0]['data']) .'"  id="'. seoUrl($key) .'" value="'. $tor[0]['data'] .'">';
            echo '<a href="www.bet-esport.com/tournament/'.seoUrl($key).'"><img alt="'.$key.'" src="/i/p/'. seoUrl($tor[0]['data']).'-50.png" style="height:40px; vertical-align:text-bottom; margin-left:20px; display:inline-block;"/><h2 style="display:inline-block; width:80%;">&nbsp;&nbsp;&nbsp;&nbsp;'. $key .'</h2></a>';
            echo '<div class="torneogroups">';
            Ttor($tor);
            echo '</div>';
            echo '</div>';  
          }
        }

        function Ttor($thor){
          foreach( $thor as $t){
            echo '<a href="'.$t['url'].'" class="clickable-row" data="'. $t['date'] .'" ><i class="fa fa-gamepad" aria-hidden="true"></i> &nbsp; ' .$t['title'].'<div class="hide-for-small" style="float:right"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;'. $t['date'] .'</div><div class="hide-for-small" style="float:right"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;'. $t['time'] .'&nbsp;&nbsp;&nbsp;&nbsp;</div></a>';
          }
        }

        wp_reset_query(); ?>
        <div id="nonehere" style="display:none">No matches for this game type</div>
        <br />

      </div>
      <div class="four columns">
        <?php include ('side.php'); ?>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(".clickable-row").click(function() {
      window.document.location = $(this).find('a').attr("href");
    });

    var other_games = ["league-of-legends", "dota-2", "cs-go", "hearthstone", "heroes-of-the-storm", "starcraft"];

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

  }); 
</script>

<?php get_footer(); ?>