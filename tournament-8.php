<?php get_header('prueba1');  /* Template Name: Tournament*/ ?>

<div class="row">
  <div class="twelve columns">
    <h1><?php echo get_the_title(); ?></h1>
    <?php the_post(); 
    the_content(); ?>


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
          'key'       => 'tournament',
          'value'     => get_the_title(),
          'compare'   => '='
        ),
      ),  
    )
  );  
    $torneo_array = array();

    if ( $partidoz->have_posts() ) : while ( $partidoz->have_posts() ) : $partidoz->the_post(); 
      $torneo = get_post_meta(get_the_ID(), 'tournament', true);

      $match_info = unserialize(unserialize(get_post_custom_values('match_info')[0]));

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
      $fechaH= strftime("%d %b %Y",$fechahumana->getTimestamp()); 


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
        't1winna' => round((1/$t1odds)*100)-4,
        't2winna' => round((1/$t2odds)*100)-4,
        'linkouturl' => $match_info['quicklink']."/?s=bfp109554",
      );

    endwhile; endif; 

    TorSep($torneo_array);

    function TorSep($tor_array){
      foreach ($tor_array as $key=>$tor){
        echo '<div class="torneogroup '. seoUrl($tor[0]['data']) .'"  id="'. seoUrl($key) .'" value="'. $tor[0]['data'] .'">';
        // echo '<h2>'. $key .'</h2>';
        echo '<div class="torneogroups">';
        Ttor($tor);
        echo '</div>';
        echo '</div>';  
      }
    }
    function Ttor($thor){
      foreach( $thor as $t){
        echo '<div class="partido"><div class="timebar tourname"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;' . $t['day'] . '<div class="timebox">'. $t['time'] . '&nbsp;UTC&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i></div></div><div class="leftbox redtext"><div class="team1"><img onerror=this.src="/i/default_sheild.png" src="/i/logos/100/' .seoUrl($t['t1name']). '.png" alt="' .$t['t1name']. '"/></div><div class="h11textspace"><span class="h11">' .$t['t1name']. '</span><br><div style="float:left;" class="h7 redtext">' .$t['t1odds']. '<br>' .$t['t1winna'].'%</div></div></div><div class="centerbox"><div class="vsvs"> vs </div><br><div class="h7"></div></div><div class="rightbox greentext"><div class="team2"><img onerror=this.src="/i/default_sheild.png" src="/i/logos/100/' .seoUrl($t['t2name']). '.png" alt="' .$t['t2name']. '"/></div><div class="h11textspace"><span class="h11">' .$t['t2name']. '</span><br><div style="float:right;" class="h7 greentext">' .$t['t2odds']. '<br>' .$t['t2winna']. '%</div></div></div><div class="gamebar"><div class="gamebarfull" style="width:'.$t['t1winna'].'%"></div></div><a href="'.$t['url'].'" class="moinfo">more info</a><a href="'.$t['linkouturl'].'" target="_blank" class="betbutton">bet now</a></div>'.$t['matchrank'];
      }
    }

    wp_reset_query(); ?>
    <div id="nonehere" style="display:none">No <?php echo $gamepage; ?> matches at the moment.</div>
    <br />
    <hr> 
  </div>
</div>
<?php get_footer('prueba1'); ?>