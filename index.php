<?php get_header('prueba1');?>
<div class="row">
  <div class="twelve columns">
    <!--  <br>
   <h1>Welcome to Bet eSport!</h1>
    <h5>Everything you need to know about betting on eSports all in one place. Bet eSport combines information about matches, teams, tournaments, and gives you a look into the world of eSports betting. Here you’ll find live odds, articles, and information to help you win through eSports bets.
      <br> 
      <br>           
      New to <a href="http://www.bet-esport.com/so-youre-looking-to-bet-money-on-esports/"><strong>eSports betting</strong></a>? Check out the links on the right
    </h5>
    <hr> -->

<!-- < ?php include('buttonsbar.php');?> -->


<style>torneogroup{display:hidden}</style>

<?php
ButtonGeneratorHome();

// $gametypes = array('Dota 2', 'CS GO', 'League of Legends', 'Starcraft 2', 'Hearthstone', 'Other');

GameFetcherHome(gta());

?>

<div id="nonehere" style="display:none">No matches for this game type</div>
<br>
<hr>


<?php get_footer('prueba1'); ?>