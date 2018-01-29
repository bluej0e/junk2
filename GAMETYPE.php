<?php /* Template Name: GAME TYPE */ 
get_header('prueba1') ; 
$gamepage = str_replace(' Matches', '', get_the_title());
?>
<div class="row">
  <div class="twelve columns">
    <div class="tournament-head" style="background: url(/i/<?php echo seoUrl($gamepage); ?>-header.jpg) no-repeat center center" class="gametype-head">
        <div class="gametype-head-inner">
            <h1><?php echo $gamepage; ?></h1>
        </div>
    </div>
    <h2>All current <?php echo $gamepage; ?> games</h2>
    <div class="panel-body"> </div>
    <?php GameFetcherType($gamepage); ?>
    <div id="nonehere" style="display:none">No <?php echo $gamepage; ?> matches at the moment.</div>
    <br>
    <hr>
</div>
</div>
<?php get_footer('prueba1'); ?>