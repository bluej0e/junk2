<?php get_header('prueba1');/* Template Name: MATCHES*/  ?>
<div class="row">
  <div class="twelve columns">

    <div class="buttons" style="text-align: center;">
<?php       ButtonGeneratorHome();  ?>
</div>

      <?php 
      $d = mktime();
      $partidoz = new WP_Query( array(
        'post_type'     => 'match',
        'orderby'       => 'meta_value',
        'meta_key'      => 'datecomp',
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

      if ( $partidoz->have_posts() ) :
        while ( $partidoz->have_posts() ) : $partidoz->the_post(); 
          $torneo = get_post_meta(get_the_ID(), 'tournament', true);

          $title_array = explode(" – ", get_the_title());
          $title_date = substr($title_array[1], -10);
          $gametype = get_post_meta(get_the_ID(), 'gametype', true);
          $eltime = get_post_meta(get_the_ID(), 'time', true);
          $torneo_array[$torneo][] = array(
            'title'=>  $title_array[0],
            'url' => get_permalink(),
            'gametype' => $gametype,
            'date' => str_replace("-".date("Y"),"",$title_date),
            'time' => substr($eltime, 11, -7)
          );

        endwhile;
      endif; 

      TorSep($torneo_array);

      function TorSep($tor_array){
        $gta = gta();
        $gametypeTor = array();

        foreach ($gta as $gtaVal) {
          foreach ($tor_array as $torName => $torsVal) {
            $torsByGametype = array_filter($torsVal, function($tor) use ($gtaVal, $torName) {
              return $tor['gametype'] == $gtaVal;
            });

            if (!empty($torsByGametype)) {
              $gametypeTor[$gtaVal][$torName] = $torsByGametype;
            }
          }
        }

        foreach ($gametypeTor as $gametype => $tors) {
          foreach ($tors as $key=>$tor){
            $currentTor = current($tor);

            echo '<div class="torneogroup '. seoUrl($currentTor['gametype']) .'"  id="'. seoUrl($key) .'" value="'. $currentTor['gametype'] .'">';
            echo '<a href="http://www.bet-esport.com/tournament/'.seoUrl($currentTor['gametype'])."-".seoUrl($key).'" ><img alt="'.$key.'"src="/i/p/'. seoUrl($currentTor['gametype']).'-50.png" style="height:40px; vertical-align:text-bottom; margin-left:20px; display:inline-block;"/><h2 style="display:inline-block; width:80%;">'. $key .'</h2></a>';
            echo '<div class="matchgroups">';
            Ttor($tor);
            echo '</div>';
            echo '<br></div>';  
          }
        }
      }

      function Ttor($thor){
        foreach( $thor as $t){
          echo '<a href="'.$t['url'].'" class="clickable-row" data="'. $t['date'] .'" ><i class="fa fa-gamepad" aria-hidden="true"></i> &nbsp; ' .$t['title'].'<div style="float:right"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;'. $t['date'] .'</div><div class="hide-for-small" style="float:right"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;'. $t['time'] .'&nbsp;&nbsp;&nbsp;&nbsp;</div></a>';
        }
      }



      wp_reset_query(); ?>
      <div id="nonehere" style="display:none">No matches for this game type</div>
      <br />




    </div> 

  </div>
  <hr>
  <?php get_footer('prueba1'); ?>
  <script>
    $(document).ready(function() {
      $(".clickable-row").click(function() {
        window.document.location = $(this).find('a').attr("href");
      });

      $('.showsinglegame').click(function(){
        if($(this).val() == 'all'){ 
          $('.torneogroup').show();
        } else{ 
          $('.torneogroup').show();
          $('.torneogroup:not(.'+$(this).val()+')').hide();
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