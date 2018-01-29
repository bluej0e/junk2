<?php

function gta() {
  return array('Dota 2', 'CS GO', 'League of Legends', 'Starcraft 2', 'Starcraft', 'Warcraft III', 'Hearthstone', 'Overwatch', 'Call of Duty', 'Black Ops', 'Warcraft', 'World of Tanks', 'World Of Warcraft', 'Rocket League', 'PUBG', "Heroes Of The Storm");
}

/*makes string URL friendly*/
function seoUrl($string) {
  $char_map = array("Á" => "A", "É" => "E","Ê" => "E", "Í" => "I", "Ñ" => "N", "Ó" => "O", "Ú" => "U", "Ü" => "U", "á" => "a", "é" => "e", "ê" => "e", "í" => "i", "ñ" => "n", "ó" => "o", "ú" => "u", "ü" => "u", "ª" => "a");
  $newstring = strtr($string, $char_map);    
  $newstring = strtolower($newstring);
  $newstring = preg_replace("/[^a-z0-9_\s-]/", "", $newstring);
  $newstring = preg_replace("/[\s-]+/", " ", $newstring);
  $newstring = preg_replace("/[\s_]/", "-", $newstring);
  return $newstring;
}

/* SEARCHES ALL MATCHES */
function GameFetcher($gametype){
  $d = mktime();

  foreach ($gametype as $type) {

    $games = new WP_Query( array(
      'post_type'     => 'match',
      'orderby'       => 'meta_value',
      'meta_key'      => 'matchrank',
      'order'         => 'ASC',
      'showposts'     => 30000,
      'meta_query'    => array(
        array(
          'key'       => 'datecomp',
          'value'     => $d,
          'compare'   => '>='
        ),
        array(
          'key'       => 'gametype',
          'value'     => $type,
          'compare'   => '='
        ),
      ),  
    )
  );  
    $torneo_array = array();

    if ( $games->have_posts() ) : while ( $games->have_posts() ) : $games->the_post(); 
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
        'gametype' => $gametype,
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

    TournamentSep($torneo_array);

    wp_reset_query();
  }
}

/* CREATES TOURNAMENT DISPLAY */
function TournamentSep($tor_array){
  foreach ($tor_array as $key=>$tor){
    echo '<a href="/tournament/'.seoUrl($tor[0]['gametype']).'-'.seoUrl($key).'" class="torneogroup '. seoUrl($tor[0]['gametype']) .'"  id="'. seoUrl($key) .'" value="'. $tor[0]['gametype'] .'">';
    echo '<img alt="'.$tor[0]['gametype'].'" src="/i/p/'. seoUrl($tor[0]['gametype']).'-50.png" style="height:40px; vertical-align:text-bottom; margin-left:20px; display:inline-block;"/><h2 style="display:inline-block; width:80%;">'. $key .'</h2>';
    echo '<div class="torneogroups">';
    MatchBoxes($tor);
    echo '</div>';
    echo '</a>';  
  }
}

/* CREATES MATCH BOXES */
function MatchBoxes($thor){
  foreach($thor as $t){
    echo '<div class="partido" onClick="location.href='."'".$t['url']."'".'"><div class="timebar tourname"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;' . $t['day'] . '<div class="timebox">'. $t['time'] . '&nbsp;UTC&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i></div></div><div class="leftbox redtext"><div class="team1"><img onerror=this.src="/i/default_sheild.png" src="/i/logos/100/' .seoUrl($t['t1name']). '.png" alt="' .$t['t1name']. '"/></div><div class="h11textspace"><span class="h11">' .$t['t1name']. '</span><br><div style="float:left;" class="h7 redtext">' .$t['t1odds']. '<br>' .$t['t1winna'].'%</div></div></div><div class="centerbox"><div class="vsvs"> vs </div><br><div class="h7"></div></div><div class="rightbox greentext"><div class="team2"><img onerror=this.src="/i/default_sheild.png" src="/i/logos/100/' .seoUrl($t['t2name']). '.png" alt="' .$t['t2name']. '"/></div><div class="h11textspace"><span class="h11">' .$t['t2name']. '</span><br><div style="float:right;" class="h7 greentext">' .$t['t2odds']. '<br>' .$t['t2winna']. '%</div></div></div><div class="gamebar"><div class="gamebarfull" style="width:'.$t['t1winna'].'%"></div></div><a href="'.$t['url'].'" class="moinfo">more info</a><a href="'.$t['linkouturl'].'" target="_blank" class="betbutton">bet now</a></div>';
  }
}

/* CREATES GAMETYPE DISPLAY */
function GameFetcherHome($gametype){
  $d = mktime();
  foreach ($gametype as $type) {
    if($type != 'Other'){ 
      $games = new WP_Query( array(
        'post_type'     => 'match',
        'orderby'       => 'meta_value',
        'meta_key'      => 'matchrank',
        'order'         => 'ASC',
        'showposts'     => 6,
        'meta_query'    => array(
          array(
            'key'       => 'datecomp',
            'value'     => $d,
            'compare'   => '>='
          ),
          array(
            'key'       => 'gametype',
            'value'     => $type,
            'compare'   => '='
          ),
        ),  
      )
    );  
      $torneo_array = array();

      if ( $games->have_posts() ) : while ( $games->have_posts() ) : $games->the_post(); 
        $gtype = get_post_meta(get_the_ID(), 'gametype', true);

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

        $torneo_array[$gtype][] = array(
          'title' =>  $title_array[0],
          'url' => get_permalink(),
          'gametype' => $gametype,
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
      TournamentSepHome($torneo_array);
      wp_reset_query();
    }else{
      $games = new WP_Query( array(
        'post_type'     => 'match',
        'orderby'       => 'meta_value',
        'meta_key'      => 'matchrank',
        'order'         => 'ASC',
        'showposts'     => 6,
        'meta_query'    => array(
          array(
            'key'       => 'datecomp',
            'value'     => $d,
            'compare'   => '>='
          ),
          array(
            'key'       => 'gametype',
            'value'     => gta(),
            'compare'   => 'NOT IN'
          ),
        ),  
      )
    );  
      $torneo_array2 = array();

      if ( $games->have_posts() ) : while ( $games->have_posts() ) : $games->the_post(); 
        $gtype = get_post_meta(get_the_ID(), 'gametype', true);

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

        $torneo_array2[$gtype][] = array(
          'title' =>  $title_array[0],
          'url' => get_permalink(),
          'gametype' => $gametype,
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
      foreach ($torneo_array2 as $key=>$tor){
        echo '<div class="torneogroup other"  id="other" value="other">';
        echo '<a href="/'.seoUrl($tor[0]['gametype']).'-matches" ><div style="background: url(/i/'. seoUrl($tor[0]['gametype']).'-header.jpg) no-repeat center center" class="gametype-head"><div class="gametype-head-inner"><h2 style="width:70%; margin: 0 auto;">'. $key .'</h2></div></div></a>';
        MatchBoxes($tor);
        echo '<br><br></div>';
      }
      wp_reset_query();
    }
  }
}

/* CREATES TOURNAMENT DISPLAY FOR HOME */
function TournamentSepHome($tor_array){
  foreach ($tor_array as $key=>$tor){
    echo '<div class="torneogroup '. seoUrl($tor[0]['gametype']) .'"  id="'. seoUrl($key) .'" value="'. $tor[0]['gametype'] .'">';
    echo '<a href="/'.seoUrl($tor[0]['gametype']).'-matches" ><div style="background: url(/i/'. seoUrl($tor[0]['gametype']).'-header.jpg) no-repeat center center" class="gametype-head"><div class="gametype-head-inner"><h2 style="width:70%; margin: 0 auto;">'. $key .'</h2></div></div></a>';
    MatchBoxes($tor);
    echo '<br><br></div>';
  }
}

/* CREATES TOURNAMENT DISPLAY FOR HOME */
function old_TournamentSepHome($tor_array){

  foreach ($tor_array as $key=>$tor){
    echo '<div class="torneogroup '. seoUrl($tor[0]['gametype']) .'"  id="'. seoUrl($key) .'" value="'. $tor[0]['gametype'] .'">';
    echo '<a href="/'.seoUrl($tor[0]['gametype']).'-matches" ><img alt="'.$tor[0]['gametype'].'" src="/i/p/'. seoUrl($tor[0]['gametype']).'-50.png" style="height:40px; vertical-align:text-bottom; margin-left:20px; display:inline-block;"/><h2 style="display:inline-block; width:80%;">'. $key .'</h2></a>';
    MatchBoxes($tor);
    echo '</div>';
  }
}

/* SEARCHES ALL MATCHES */
function GameFetcherType($gametype){
  $d = mktime();
  $games = new WP_Query( array(
    'post_type'     => 'match',
    'orderby'       => 'meta_value',
    'order'         => 'ASC',
    'showposts'     => 30000,
    'meta_query'    => array(
      array(
        'key'       => 'datecomp',
        'value'     => $d,
        'compare'   => '>='
      ),
      array(
        'key'       => 'gametype',
        'value'     => $gametype,
        'compare'   => '='
      ),
    ),  
  ));  
  $torneo_array = array();

  if ( $games->have_posts() ) : while ( $games->have_posts() ) : $games->the_post(); 
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
      'gametype' => $gametype,
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
  TournamentSep($torneo_array);
  wp_reset_query();
}

/* SEARCHES ALL tournaments */
function GameFetcherT($gametype){
  $i = 0;        
  $d = mktime(); 
  $gta2 = array('Dota 2', 'CS GO', 'League of Legends');
  if($gametype != 'Other'){
    $games = new WP_Query( array(
      'post_type'     => 'match',
      'orderby'       => 'meta_value',
      'order'         => 'ASC',
      'showposts'     => 30000,
      'meta_query'    => array(
        array(
          'key'       => 'datecomp',
          'value'     => $d,
          'compare'   => '>='
        ),
        array(
          'key'       => 'gametype',
          'value'     => $gametype,
          'compare'   => '='
        ),
      ),  
    )
  );  
    $torneo_array = array();

    if ( $games->have_posts() ) : while ( $games->have_posts() ) : $games->the_post(); 
      $torneo = get_post_meta(get_the_ID(), 'tournament', true);

      $match_info = unserialize(unserialize(get_post_custom_values('match_info')[0]));

      $title_date = substr($title_array[1], -10);
      $gametype = get_post_meta(get_the_ID(), 'gametype', true);

      $torneo_array[$torneo][] = array(
        'url' => get_permalink(),
        'gametype' => $gametype,
      );

    endwhile; endif; 

    TournamentSepT($torneo_array);

    wp_reset_query();
  } else {
   $games = new WP_Query( array(
    'post_type'     => 'match',
    'orderby'       => 'meta_value',
    'meta_key'      => 'matchrank',
    'order'         => 'ASC',
    'showposts'     => 3000,
    'meta_query'    => array(
      array(
        'key'       => 'datecomp',
        'value'     => $d,
        'compare'   => '>='
      ),
    ),  
  )
 );  
   $torneo_array2 = array();

   if ( $games->have_posts() ) : while ( $games->have_posts() ) : $games->the_post(); 
    $torneo = get_post_meta(get_the_ID(), 'tournament', true);
    $gtype2 = get_post_meta(get_the_ID(), 'gametype', true);

    if(!in_array($gtype2, $gta2)){
     $match_info = unserialize(unserialize(get_post_custom_values('match_info')[0]));

     $torneo_array2[$torneo][] = array(
      'url'       => get_permalink(),
      'gametype'  => $gametype,
    );
   }
 endwhile; endif; 

 TournamentSepT($torneo_array2);

 wp_reset_query();}
}

/* CREATES TOURNAMENT DISPLAY */
function TournamentSepT($tor_array){
  foreach ($tor_array as $key=>$tor){
    echo '<a href="/tournament/'. seoUrl($tor[0]['gametype'])."-".seoUrl($key).'" class="tournaments '. seoUrl($tor[0]['gametype']) .'"  id="'. seoUrl($key) .'" value="'. $tor[0]['gametype'] .'">'. $key .'</a>';
  }
}

/* REMOVES GAMETYPE FROM STRING */
function RemoveGameType($gamename){
  $types = array('Dota 2', 'CS GO', 'League of Legends', 'Starcraft 2', 'Starcraft', 'Warcraft III', 'Hearthstone', 'Overwatch', 'Call of Duty', 'Black Ops', 'Warcraft', 'Starcraft II', 'World of Tanks', 'World of Warcraft', 'Rocket League', 'PUBG');
  return trim(str_replace($types, '', $gamename));
}

/* Generates the gametype buttons */
function ButtonGeneratorHome($gameType){
  $d = mktime();
  $games = new WP_Query( 
    array(
      'post_type'     => 'match',
      'orderby'       => 'meta_value',
      'order'         => 'ASC',
      'showposts'     => 30000,
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

  if ( $games->have_posts() ) :
    while ( $games->have_posts() ) : $games->the_post(); 
      $gtype = get_post_meta(get_the_ID(), 'gametype', true);

      $torneo_array[$gtype][] = array(
        'gametype' => $gtype,
      );
    endwhile;
  endif; 

  ButtonMaker($torneo_array);
  wp_reset_query();
}

/* Creates the html for the buttons */
function ButtonMaker($torneo_arrayB){
  $buttonExclude = array('Dota 2', 'CS GO', 'League of Legends');
  $allGames = gta();
  echo '<div class="buttons" style="text-align: center;"><button id="opendiv" class="gamebutton" ><img alt="Show All" src="http://www.bet-esport.com/i/more_300.png"></button><button class="showsinglegame gamebutton" value="league-of-legends" target="1"><img alt="League of Legends" src="http://www.bet-esport.com/i/league-of-legends_300.png"></button><button class="showsinglegame gamebutton" value="dota-2" target="2"><img alt="Dota 2" src="http://www.bet-esport.com/i/dota-2_300.png"></button><button class="showsinglegame gamebutton" value="cs-go" target="3"><img alt="CS GO" src="http://www.bet-esport.com/i/cs-go_300.png"></button><div id="hiddenmenu" style="display:none"><button class="showsinglegame gamebutton" value="all" ><img alt="Show All" src="http://www.bet-esport.com/i/showall_300.png"></button>';

  foreach ($torneo_arrayB as $key => $ppp) {
    if (!in_array($key, $buttonExclude)){
      $newKey = array_search($key,$allGames);
      echo '<button class="showsinglegame gamebutton" value="'.seoUrl($key).'" target="'. $newKey .'"><img alt="'.$key.'" src="http://www.bet-esport.com/i/'.seoUrl($key).'_300.png"></button>';
    }
  }
  echo '</div></div><br>';
}








// SACAR EMOJI
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// SE USA ESTO PARA SACAR LOS STYLES DE JETPACK

// First, make sure Jetpack doesn't concatenate all its CSS
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

// Then, remove each CSS file, one at a time
function jeherve_remove_all_jp_css() {
  wp_deregister_style( 'AtD_style' ); // After the Deadline
  wp_deregister_style( 'jetpack_likes' ); // Likes
  wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
  wp_deregister_style( 'jetpack-carousel' ); // Carousel
  wp_deregister_style( 'grunion.css' ); // Grunion contact form
  wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
  wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
  wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
  wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
  wp_deregister_style( 'noticons' ); // Notes
  wp_deregister_style( 'post-by-email' ); // Post by Email
  wp_deregister_style( 'publicize' ); // Publicize
  wp_deregister_style( 'sharedaddy' ); // Sharedaddy
  wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
  wp_deregister_style( 'stats_reports_css' ); // Stats
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
  wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
  wp_deregister_style( 'presentations' ); // Presentation shortcode
  wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
  wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
  wp_deregister_style( 'widget-conditions' ); // Widget Visibility
  wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
  wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
  wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
add_action('wp_print_styles', 'jeherve_remove_all_jp_css' );



// SE AGREGA ESTO PARA HABILITAR THUMBNAILS EN EL THEME
add_theme_support( 'post-thumbnails' );
// add_image_size( 'large', 300, 300 );
// add_image_size( '137', 137, 137 );
// add_image_size( '104', 104, 104 );
// add_image_size( '50', 50, 50 );
// add_image_size( '32', 32, 32 );


if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 640, 1500 );
}



// SE AGREGA ESTO PARA ACHICAR EL EXCREPT
// function new_excerpt_length($length) {
//   return 30;
// }
// add_filter('excerpt_length', 'new_excerpt_length');

// AGREGA EL LAS MER
function new_excerpt_more($more) {
  return '<div class="rmbutton">READ MORE…</div>';
}
add_filter('excerpt_more', 'new_excerpt_more');



// SE AGREGA ESTO PARA VER SI PODEMOS PONER LOS POST TAGS COMO META KEYWORD

function csv_tags() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
		$csv_tags .= $tag->name . ',';
	}
  if (is_home()) { ?>Bet e-Sports, bet esport, bet e-sport, esport bets, e-sports bets, esports betting, bet dota, bet lol, bet counter strike, bet call of duty, bet league of legends, <?php }
   echo "$csv_tags";

}



// SE CLONA FUNCION ANTERIOR PARA TRATAR EL TITULO

function csv_title() {
  $posttitle = get_post_custom_values('seo_title');

  if (is_home()) { ?>Bet on e-Sports<?php } ;
  if (is_category()) 	{ single_cat_title( '', true ); } ;
  if (is_tag()) 	{ single_cat_title( '', true ); } ;
  if (is_singular()) { $title = get_post_custom_values("seo_title"); echo $title[0]; } ;

  echo "$csv_title";

}



// SE CLONA FUNCION ANTERIOR PARA AGREGAR LA DESCRIPCION

function csv_description() {
  $postdescription = get_post_custom_values("seo_description");

  if (is_home()) { ?>Your all-in-one eSports betting hub. Get info on upcoming matches, tournaments, highlights and more. Get the best odds and tips on how to win through eSports betting.<?php };
  if (is_category()) 	{ echo category_description() ; } ;	
  if (is_tag()) 	{ echo category_description() ; } ;
  if (is_singular()) { $descr = get_post_custom_values("seo_description"); echo $descr[0]; } ;

  echo "$csv_description";

}



// SE AGREGA ESTO PARA QUE LA DESCRIPCION DE CATEGORIA NO MUESTRE P

remove_filter('term_description','wpautop');



// SACA BASURA DEL HEADER

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'feed_links', 2 );
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
show_admin_bar( false );




// SE AGREGA ESTO PARA TENER UN CUSTOM TEMPLATE PARA LA CATEGORIA PARTIDOS y cat microposting

// function get_custom_cat_template($single_template) {
//   global $post;


//   if ( in_category( 'match' )) {
//     $single_template = dirname( __FILE__ ) . '/match.php';
//   }

//   else if ( in_category( 'tournament' )) {
//     $single_template = dirname( __FILE__ ) . '/tournament.php';
//   } 

//   return $single_template;
// }
// add_filter( "single_template", "get_custom_cat_template" ) ;




// Add a Custom Post Type to a feed
function add_cpt_to_feed( $qv ) {
  if ( isset($qv['feed']) && !isset($qv['post_type']) )
    $qv['post_type'] = array('post', 'ultimo-momento');
  return $qv;
}

add_filter( 'request', 'add_cpt_to_feed' );


// Agrega TAGS a las PAGES
function my_taxonomies() {
  register_taxonomy_for_object_type('category', 'page');
  register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'my_taxonomies');





// CUSTOM POST MATCH

function my_custom_post_match() {
  $labels = array(
    'name'               => _x( 'Matches', 'post type general name' ),
    'singular_name'      => _x( 'Match', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'match' ),
    'add_new_item'       => __( 'Add New Matches' ),
    'edit_item'          => __( 'Edit Matches' ),
    'new_item'           => __( 'New Matches' ),
    'all_items'          => __( 'All Matches' ),
    'view_item'          => __( 'View Match' ),
    'search_items'       => __( 'Search Matches' ),
    'not_found'          => __( 'No matches found' ),
    'not_found_in_trash' => __( 'No matches found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Matches',
    'rewrite' => 'false',
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our matches and match specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
    'has_archive'   => true,
    'taxonomies' 	=> array('post_tag', 'category',)
  );
  register_post_type( 'match', $args ); 
}
add_action( 'init', 'my_custom_post_match' );




add_filter( 'template_include', 'include_match_template', 1 );
function include_match_template( $template_path ){
  if ( get_post_type() == 'match' ) {
    if ( is_single() ) {
      if ( $theme_file = locate_template( array( 'single-match.php' ) ) ) {
        $template_path = $theme_file;
      } else {
        $template_path = plugin_dir_path( __FILE__ ) . '/single-match.php';
      }
    }
  }
  return $template_path;
}

// CUSTOM POST TOURNAMENT

function my_custom_post_tournament() {
  $labels = array(
    'name'               => _x( 'Tournaments', 'post type general name' ),
    'singular_name'      => _x( 'Tournament', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'tournament' ),
    'add_new_item'       => __( 'Add New Tournament' ),
    'edit_item'          => __( 'Edit Tournament' ),
    'new_item'           => __( 'New Tournament' ),
    'all_items'          => __( 'All Tournaments' ),
    'view_item'          => __( 'View Tournament' ),
    'search_items'       => __( 'Search Tournaments' ),
    'not_found'          => __( 'No Tournaments found' ),
    'not_found_in_trash' => __( 'No Tournaments found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Tournaments',
    'rewrite' => 'false',
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our tournaments and tournament specific data',
    'public'        => true,
    'menu_position' => 6,
    'supports'      => array( 'title', 'editor', 'thumbnail','custom-fields' ),
    'has_archive'   => true,
    'taxonomies'  => array('post_tag', 'category',)
  );
  register_post_type( 'tournament', $args ); 
}
add_action( 'init', 'my_custom_post_tournament' );




add_filter( 'template_include', 'include_tournament_template', 1 );
function include_tournament_template( $template_path ){
  if ( get_post_type() == 'tournament' ) {
    if ( is_single() ) {
      if ( $theme_file = locate_template( array( 'single-tournament.php' ) ) ) {
        $template_path = $theme_file;
      } else {
        $template_path = plugin_dir_path( __FILE__ ) . '/single-tournament.php';
      }
    }
  }
  return $template_path;
}





/**
 * Hides the custom post template for pages on WordPress 4.6 and older
 *
 * @param array $post_templates Array of page templates. Keys are filenames, values are translated names.
 * @return array Filtered array of page templates.
 */
function makewp_exclude_page_templates( $post_templates ) {
  if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
    unset( $post_templates['/single-tournament.php'] );
  }

  return $post_templates;
}

add_filter( 'theme_tournament_templates', 'makewp_exclude_page_templates' );



/**
 * Add weekly interval to the schedules (since WP doesnt provide it from the start)
 */
add_filter('cron_schedules','cron_add_weekly');
function cron_add_weekly($schedules) {
  $schedules['weekly'] = array(
    'interval' => 604800,
    'display' => __( 'Once per week' )
  );
  return $schedules;
}
/**
 * Add the scheduling if it doesnt already exist
 */
add_action('wp','setup_schedule');
function setup_schedule() {
  if (!wp_next_scheduled('weekly_pruning') ) {
    wp_schedule_event( time(), 'weekly', 'weekly_pruning');
  }
}
/**
 * Add the function that takes care of removing all rows with post_type
 */
add_action( 'weekly_pruning', 'remove_old_matches' );
add_action( 'weekly_pruning', 'remove_old_tournaments' );
function remove_old_matches() {
  global $wpdb;
  $wpdb->query($wpdb->prepare("DELETE FROM wp_posts WHERE post_type='match' AND post_date < DATE_SUB(NOW(), INTERVAL 7 DAY);"));
}
function remove_old_tournaments() {
  global $wpdb;
  $wpdb->query($wpdb->prepare("DELETE FROM wp_posts WHERE post_type='tpurnament' AND post_date < DATE_SUB(NOW(), INTERVAL 7 DAY);"));
}


?>