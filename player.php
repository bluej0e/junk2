<?php get_header();/* Template Name: player*/ ?>

<div class="row">
  
  <div class="twelve columns">

    <div class="row"> 

      <div class="eight columns">
        
        

        <?php

        function debug_to_console( $data ) {

          if ( is_array( $data ) )
            $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
          else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

          echo $output;
        }

        $values = get_post_custom_values("playercode"); $values[0];

        $playerusername =       get_post_custom_values("playerusername")[0];
        $fullplayername =       get_post_custom_values("fullplayername")[0];
        $fullcountryname=       get_post_custom_values("fullcountryname")[0];
        $flagname=              get_post_custom_values("flagname")[0];
        $fullteamname=          get_post_custom_values("fullteamname")[0];
        $role=                get_post_custom_values("role")[0];
        $position=            get_post_custom_values("position")[0];
        $gametype=              get_post_custom_values("gametype")[0];

        ;

        wp_reset_postdata();
        ?>   
        
        <?php //--------------------------EMPIEZA TABLA players------------------?> 
        <div width="100%">
            
              <div class="player">
                  <img alt="<?php $values = get_post_custom_values("playercode"); echo $values[0]; ?>" src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("playercode"); echo $values[0]; ?>.jpg"/>
                
              </div>
              
              <div class="playerinfo">
                <h1>
                  <img width="32" height="32" src="http://www.bet-esport.com/i/<?php echo $gametype; ?>-50.png" href="http://www.bet-esport.com/<?php echo $gametype; ?>/"/>  
                    <?php echo get_the_title(); ?> 
                  </h1>

                  <h2>
                    <a href="http://www.bet-esport.com/<?php $values = get_post_custom_values("teamcode"); echo $values[0]; ?>/">
                      <img width="32" height="32" src="http://www.bet-esport.com/i/<?php $values = get_post_custom_values("teamcode"); echo $values[0]; ?>-32x32.png"/>  
                        <?php echo $fullteamname ?></a>
                  </h2>    

                      <h3><?php echo $fullplayername ?></h3>

                      <h3>
                        <img pad src="http://www.bet-esport.com/i/flags/24/<?php echo $fullcountryname; ?>-flag.png" alt="<?php echo $fullcountryname; ?>"/>   
                          <?php echo $fullcountryname ?></h3>
                        <?php
                        
                        if ( get_post_custom_values( "gametype" )[0] == 'dota' ){ echo "<h3>Role: ".$role." </h3>";}
                        elseif ( get_post_custom_values( "gametype" )[0] == 'lol' ){ echo "<h3>Role: ".$role." </h3>";}
                        if ( get_post_custom_values( "gametype" )[0] == 'dota' ){ echo "<h3>Position: ".$position." </h3>";}?>

                        <div style="clear: both;"></div>
                   
                    
 
                </div>

                <?php //------------------------------TERMINA TABLA JUGADOR---------------------?>

                
                <?php the_post(); ?>
                <?php the_content(); ?>
                <br />      
            <hr>
                <br />
                <?php if(get_the_tag_list()) {
                  echo get_the_tag_list('<ul class="buttonlink"><li class="buttonlink">','</li><li class="buttonlink">','</li>
                </ul>');
              } ?>

              <hr />
        
      </div>
</div>
      <div class="four columns">
        
        <?php include ('side.php'); ?>

      </div>

    </div>

  </div> 


</div>
<?php get_footer(); ?>