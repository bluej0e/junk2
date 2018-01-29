<?php /* Template Name: AUTOPOST TORNEOS  */
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

function TournamentCreator($title, $name, $tax_input, $meta_input) {
	$postID = post_exists( $title );
	// $gtype = get_post_meta($postID, 'gametype', true);
		if($postID) {
			echo $title. " already exists.<br>";
		}else{
			define(POST_CONTENT, '');
			define(POST_AUTH_ID, '1');
			$post_data = array(
				'post_title'    => $title,
				'post_content'  => POST_CONTENT,
				'post_status'   => 'publish',
				'post_type'     => 'tournament',
				'post_author'   => POST_AUTH_ID,
				'post_template' => 'single-tournament.php', 
				'post_category' => array('category' => 48),
				'tags_input'	=> $tax_input,
				'meta_input' 	=> $meta_input,
				'post_name'		=> $name
			);
			$insertion = wp_insert_post( $post_data, $error_obj );
			echo  "Created Tournament: <a href='".$name."'>".$title."</a><br>";
			if(!isset($post))
				add_action('admin_init', 'hbt_create_post' );
			return $error_obj;
		} 
	}
	function MatchCreator($title, $name, $tax_input, $meta_input, $meta_update) {
		if(substr($title, 0,2) == vs ){}else{
			$postID = post_exists( $title );
			if($postID) {
				foreach($meta_update as $meta_key => $meta_value) {
					update_post_meta($postID, $meta_key, $meta_value);
				}
				echo "Updated: <a href='".$name."'>".$title."</a><br>";
			} else {
				define(POST_AUTH_ID, '1');
				$post_data = array(
					'post_title'    => $title,
					'post_content'  => '',
					'post_status'   => 'publish',
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
	}
	$gtypes =["[League of Legends]", "[Overwatch]", "[CS GO]", "[Hearthstone]", "[Dota 2]", "[Heroes Of The Storm]", "[Starcraft 2]", "[Call Of Duty]", "[Dota]", "[Rocket League]", "[Starcraft Broodwar]", "[World Of Tanks]", "[Starcraft]", "[World Of Warcraft]", "[WarCraft III]", "[Warcraft 3]"];

	foreach($jsonarray['Event'] as $Event){

		foreach ($Event as $attr => $event) {

			if($attr == '@attributes' && $event['home_team_cname'] != 'null'){
				$Quicklink = $Event['Quicklink'];
				$eventID = $event['id'];
				$time = $event['start_at'];
				$t1nameurl = $event['home_team_cname']; 
				$t2nameurl = $event['away_team_cname']; 
				$Event['Market'] = isset($Event['Market'][0]) ? $Event['Market'] : array($Event['Market']);

				foreach($Event['Market'] as $Market){
					$betTypes = array('oddsboxes_match_winner.php');

					$Market['Outcome'] = isset($Market['Outcome'][0]) ? $Market['Outcome'] : array($Market['Outcome']);
					foreach($Market as $attrM => $market){

						if($attrM == '@attributes' && $market['cname'] == "match-winner"){

							foreach($Market['Outcome'] as $Outcome){
								foreach($Outcome as $attrO => $out){
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
							foreach($Event['Keywords'] as $keywords){
								foreach($keywords as $key){								
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

							$match_winner_info = serialize(array(
								't1id' => $t1id,
								't2id' => $t2id,
								't1url' => $t1nameurl,
								't2url' => $t2nameurl,
								'quicklink' => $Quicklink,
								'tournamentcode' => seoUrl($tournament),
								'eventID' => $eventID,
							));
							$match_winner = serialize(array(
								't1odds' => $t1odds,
								't2odds' => $t2odds,
							));

						}elseif($attrM == '@attributes' && $market['cname'] == "correct-score"){
							array_push($betTypes, 'oddsboxes_correct_score.php');
							foreach($Market['Outcome'] as $Outcome){
								foreach($Outcome as $attrO => $out){
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
						}	

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

				$dateD = explode(" ", $time)[0]; 
				setlocale(LC_ALL,"en_EN");
				$fechahumana = DateTime::createFromFormat("Y/m/d", $dateD);
				$fechaH= strftime("%B %d, %Y",$fechahumana->getTimestamp()); 

				$tarray = [rand(0,2), rand(0,4), rand(0,2)];

				$zdate = explode(" ", $time); 
				$fk = explode(":", $zdate[1]); 
				$fg = explode("/",$zdate[0]); 
				$game_date = mktime($fk[0], $fk[1], $fk[2], $fg[1], $fg[2], $fg[0]);

				include 'teamrank.php';

				if ($gametype == "CS GO") {
					foreach($csgoteamranks as $teamn => $tr) {
						if (seoUrl($t1name) == $teamn) {
							$t1rank = $tr;
						} elseif (seoUrl($t2name) == $teamn){
							$t2rank = $tr;
						} else {
						}
					}
				} elseif ($gameytype == "Dota 2") {
					foreach($dota2teamranks as $teamn => $tr) {
						if (seoUrl($t1name) == $teamn) {
							$t1rank = $tr;
						} elseif (seoUrl($t2name) == $teamn){
							$t2rank = $tr;
						} else {
						}
					}
				} elseif ($gameytype == "League of Legends") {
					foreach($lolteamranks as $teamn => $tr) {
						if (seoUrl($t1name) == $teamn) {
							$t1rank = $tr;
						} elseif (seoUrl($t2name) == $teamn){
							$t2rank = $tr;
						} else {
						}
					}
				} elseif ($gameytype == "Overwatcn") {
					foreach($overteamranks as $teamn => $tr) {
						if (seoUrl($t1name) == $teamn) {
							$t1rank = $tr;
						} elseif (seoUrl($t2name) == $teamn){
							$t2rank = $tr;
						} else {
						}
					}
				} elseif ($gameytype == "Hearthstone") {
					foreach($hsteamranks as $teamn => $tr) {
						if (seoUrl($t1name) == $teamn) {
							$t1rank = $tr;
						} elseif (seoUrl($t2name) == $teamn){
							$t2rank = $tr;
						} else {
						}
					}
				} elseif ($gameytype == "Heros of the Storm") {
					foreach($herosteamranks as $teamn => $tr) {
						if (seoUrl($t1name) == $teamn) {
							$t1rank = $tr;
						} elseif (seoUrl($t2name) == $teamn){
							$t2rank = $tr;
						} else {
						}
					}
				} else {
					$t1rank = 6;
					$t2rank = 6;
				}
				$matchrank = $t1rank + $t2rank;


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
						'tarray' => serialize($tarray),
						'gametype' => $gametype, 
						't1name' => $t1name,
						't2name' => $t2name,
						'tournament' => $tournament, 
						'time' => $time,
						'datecomp' => $game_date,
						't1odds' => $t1odds,
						't2odds' => $t2odds,
						'matchrank' => $matchrank,
					],
					$meta_update = [
						'match_winner' => $match_winner,
						'correct_score' => $correct_score,
						't1odds' => $t1odds,
						't2odds' => $t2odds,
					]	
				);
			}
		}
		if ($tournament != null){
			TournamentCreator( 
				$Ttitle = $gametype." ".wp_strip_all_tags($tournament),
				$Tname = seoUrl($gametype) ."-".seoUrl($tournament),
				$Ttax_input = ['tag1' => $tournament, 'tag2' => "Tournament", 'tag3' => "League", 'tag4' => "Championship", 'tag5' => "Season", 'tag6' => "Matches", "tag7" => $gametype],
				$Tmeta_input = [
					'destacado' => "",
					'islive' => "1",
					'pagetype' => "tournament",
					'seo_description' => "Watch the ".$gametype.", ".$tournament." live and bet on the games that are currently happening. Get the best odds only in Bet-eSport.com",
					'seo_keywords' =>  $tournament.", Bet on esports, Matches, Tournament, League, Championship, Season",
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

	?>