<?php /* Template Name: AUTOPOST */
$feedUrl = "http://feeds.betway.com/events?key=BD70EBBA&keywords=esports";

$httpChannel = curl_init();
curl_setopt($httpChannel, CURLOPT_URL, $feedUrl);
curl_setopt($httpChannel, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($httpChannel, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)' );
curl_setopt($httpChannel, CURLOPT_SSL_VERIFYPEER, false);
$initialFeed = curl_exec($httpChannel);
$xmlDocument = simplexml_load_string($initialFeed);
$json = json_encode($xmlDocument);
$jsonarray = json_decode($json,TRUE);
require_once( ABSPATH . 'wp-admin/includes/post.php' );
global $post;

function seoUrl($string) {
	$char_map = array(
		"Á" => "A", "É" => "E","Ê" => "E", "Í" => "I", "Ñ" => "N", "Ó" => "O", "Ú" => "U", "Ü" => "U", "á" => "a", "é" => "e", "ê" => "e", "í" => "i", "ñ" => "n", "ó" => "o", "ú" => "u", "ü" => "u", "ª" => "a");
	$newstring = strtr($string, $char_map);    
	$newstring = strtolower($newstring);
	$newstring = preg_replace("/[^a-z0-9_\s-]/", "", $newstring);
	$newstring = preg_replace("/[\s-]+/", " ", $newstring);
	$newstring = preg_replace("/[\s_]/", "-", $newstring);
	return $newstring;
}
function TournamentCreator($title, $name, $tax_input, $meta_input) {
	$postID = post_exists( $title );
	if(!$postID) {
		define(POST_CONTENT, '');
		define(POST_AUTH_ID, '1');
		define(POST_STATUS, 'draft');
		$post_data = array(
			'post_title'    => $title,
			'post_content'  => POST_CONTENT,
			'post_status'   => POST_STATUS,
			'post_type'     => 'page',
			'post_author'   => POST_AUTH_ID,
			'post_template' => 'tournament.php', 
			'post_category' => array('category' => 48),
			'tags_input'	=> $tax_input,
			'meta_input' 	=> $meta_input,
			'post_name'		=> $name
			);
		$insertion = wp_insert_post( $post_data, $error_obj );
		echo  "Created: <a href='".$name."'>".$title."</a><br>";
		if(!isset($post))
			add_action('admin_init', 'hbt_create_post' );
		return $error_obj;
	} 
}
function MatchCreator($title, $name, $tax_input, $meta_input, $meta_update) {
	$postID = post_exists( $title );
	if($postID) {
		foreach($meta_update as $meta_key => $meta_value) {
			update_post_meta($postID, $meta_key, $meta_value);
		}
		echo "Updated: <a href='".$name."'>".$title."</a><br>";
	} else {
		define(POST_AUTH_ID, '1');
		define(POST_STATUS, 'draft');
		$post_data = array(
			'post_title'    => $title,
			'post_content'  => '',
			'post_status'   => POST_STATUS,
			'post_type'     => 'match',
			'post_author'   => POST_AUTH_ID,
			'post_template' => 'single-match.php', 
			'post_category' => array('category' => 472),
			'tags_input'	=> $tax_input,
			'meta_input' 	=> $meta_input,
			'post_name'		=> $name
			);
		$insertion = wp_insert_post( $post_data, $error_obj );
		echo "Created: <a href='".$name."'>".$title."</a><br>";
		if(!isset($post))
			add_action('admin_init', 'hbt_create_post' );
		return $error_obj;
	} 
}


$gtypes = ["[League of Legends]", "[Overwatch]", "[CS GO]", "[Hearthstone]", "[Dota 2]", "[Heroes of the Storm]", "[Starcraft]", "[Call of Duty]"];

$betTypes = array();

$insideLoop = false;

foreach($jsonarray['Event'] as $Event){
	zEvent($Event);
}

function zEvent($eve){
	foreach ($eve as $attr => $event) {
		if($attr == '@attributes' && $event['home_team_cname'] != 'null'){
			$Quicklink = $Event['Quicklink'];
			$eventID = $event['id'];
			$time = $event['start_at'];
			$t1nameurl = $event['home_team_cname']; 
			$t2nameurl = $event['away_team_cname']; 
			$Event['Market'] = isset($Event['Market'][0]) ? $Event['Market'] : array($Event['Market']);

			zMarket($Event['Market']);

			$dateD = explode(" ", $time)[0]; 
			setlocale(LC_ALL,"en_EN");
			$fechahumana = DateTime::createFromFormat("Y/m/d", $dateD);
			$fechaH= strftime("%B %d, %Y",$fechahumana->getTimestamp()); 

			$tarray = [rand(0,2), rand(0,4), rand(0,2)];

			MatchCreator( 
				$Mtitle = wp_strip_all_tags($t1name." vs ".$t2name." – ".$tournament." - ".explode("/", explode(" ", $time)[0])[1]."-".explode("/", explode(" ", $time)[0])[2]."-".explode("/", explode(" ", $time)[0])[0]),
				$Mname = seoUrl("bet-".$t1name."-vs-".$t2name."-".$tournament."-".explode("/", explode(" ", $time)[0])[1]."-".explode("/", explode(" ", $time)[0])[2]."-".explode("/", explode(" ", $time)[0])[0]),
				$Mtax_input = ['tag1' => $tournament, 'tag2' => "Match", 'tag3' => $gametype, 'tag4' => $t1name, 'tag5' => $t2name, 'tag6' => "Odds", "tag7" => "Bet", "tag8" => "eSports"],
				$Mmeta_input = [
				'seo_description' => "Bet on ".$t1name." vs ".$t2name." playing in the ".$tournament." live. Get the best odds only in Bet-eSport.com",
				'seo_keywords' =>  $tournament.", Bet on esports, Match, Tournament, League, Championship, Season",
				'seo_title' => "Bet on ".$t1name." vs ".$t2name." in the ".$tournament." – Get the best odds",
				'match_info' => $match_winner_info,
				'match_winner' => $match_winner,
				'correct_score' => $correct_score,
				'betTypes' => serialize($betTypes),
				'tarray' => serialize($tarray)
				],
				$meta_update = [
				'match_winner' => $match_winner_odds,
				'correct_score' => $correct_score,
				]	
				);

			TournamentCreator( 
				$title = wp_strip_all_tags($tournament),
				$name = seoUrl($tournament),
				$tax_input = ['tag1' => $tournament, 'tag2' => "Tournament", 'tag3' => "League", 'tag4' => "Championship", 'tag5' => "Season", 'tag6' => "Matches", "tag7" => $gametype],
				$meta_input = [
				'destacado' => "",
				'islive' => "1",
				'pagetype' => "tournament",
				'seo_description' => "Watch the ".$gametype.", ".$tournament." live and bet on the games that are currently happening. Get the best odds only in Bet-eSport.com",
				'seo_keywords' =>  $tournament.", Bet on esports, Partidos, Tournament, League, Championship, Season",
				'seo_title' => "Bet on the ".$tournament." – Get the best odds",
				'gametype' => $gametype, 
				'stream1' => "", 
				'twitterlink' => "", 
				'twitterhandle' => "", 
				'tournamentcode' => seoUrl($tournament), 
				]
				);
		}
	}
}
function zMarket($shleem){
	foreach($shleem as $attrM => $market){
		if($attrM == '@attributes' && $market['cname'] == "match-winner"){
			if ( !in_array('oddsboxes_match_winner.php', $betTypes)):
				$betTypes[] = 'oddsboxes_match_winner.php';
			$Market['Outcome'] = isset($Market['Outcome'][0]) ? $Market['Outcome'] : array($Market['Outcome']);
			Outcase($Market['Outcome']);
			endif;
			Keywords($Event['Keywords']);

			$match_winner_info = serialize(array(
				't1name' => $t1name,
				't2name' => $t2name,
				't1id' => $t1id,
				't2id' => $t2id,
				't1url' => $t1nameurl,
				't2url' => $t2nameurl,
				'quicklink' => $Quicklink,
				'gametype' => $gametype, 
				'tournament' => $tournament, 
				'tournamentcode' => seoUrl($tournament),
				'time' => $time,
				'eventID' => $eventID,
				));
			$match_winner = serialize(array(
				't1odds' => $t1odds,
				't2odds' => $t2odds,
				));

			if ( !in_array('oddsboxes_correct_score.php', $betTypes)):
				$betTypes[] = 'oddsboxes_correct_score.php';
			Outcome($Market['Outcome']);
			endif;		
			$correct_score = serialize (array(
				'id_20' => $id_20,
				'id_21' => $id_21,
				'id_02' => $id_02,
				'id_12' => $id_12,
				'odds_20' => $odds_20,
				'odds_21' => $odds_21,
				'odds_02' => $odds_02,
				'odds_12' => $odds_12,
				));
		}		
	}
}
function Outcase($mark){
	foreach($mark as $attrO => $out){
		if($attrO == '@attributes' && $out['type_cname'] == "home"){
			$t1id = $out['id'];
			$t1odds = $out['price_dec'];
			$t1name = $Outcome['Name'];
		}elseif($attrO == '@attributes' && $out['type_cname'] == "away"){
			$t2id = $out['id'];
			$t2odds = $out['price_dec'];
			$t2name = $Outcome['Name'];
		}			
	}
}
function Keywords($kword){
	foreach($kword as $key){								
		if(trim($key, "\] \[") == 'eSports'){
		}elseif (trim($key, "\] \[") == $t1name){
		}elseif (trim($key, "\] \[") == $t2name){
		}elseif (in_array($key, $gtypes)){
			$gametype = trim($key, "\] \[");
		}else{
			$tournament = str_replace(["[","]"],"", $key);
		}
	}	
}
function Outcome($key){
	foreach($key as  $attrO => $out){
		if($attrO == '@attributes' && $out['cname'] == "2-0"){
			$id_20 = $out['id'];
			$odds_20 = $out['price_dec'];
		}elseif($attrO == '@attributes' && $out['cname'] == "0-2"){
			$id_02 = $out['id'];
			$odds_02 = $out['price_dec'];
		}elseif($attrO == '@attributes' && $out['cname'] == "2-1"){
			$id_21 = $out['id'];
			$odds_21 = $out['price_dec'];
		}elseif($attrO == '@attributes' && $out['cname'] == "1-2"){
			$id_12 = $out['id'];
			$odds_12 = $out['price_dec'];
		}			
	}
}
?>
