<?php get_header();  /* Template Name: Tournament_good*/ ?>
	<div class="row">
		<img onerror="this.src='tournament_default.jpg';"  alt="<?php echo the_title(); ?>" class="t_head" width="100%" src="/i/t/h/<?php echo get_post_custom_values("tournamentcode")[0]; ?>.jpg"/>
		<div class="twelve columns">
			<div class="row">
				<div class="eight columns">
					<h1><?php echo get_the_title(); ?></h1>
					<?php the_post(); the_content(); ?>
						<hr>

						<h2><i class="fa fa-twitch"></i> Stream</h2>
						<div class="flex-video">
							<iframe id="twitch_embed_player" src="https://player.twitch.tv/?channel=<?php echo get_post_custom_values(" stream ")[0]; ?>" frameborder="0" scrolling="no" allowfullscreen="true" autoplay="false" muted="true"></iframe>
						</div>
						<hr>
						<h2><i class="fa fa-shield"></i> Teams</h2>
						<div>
							<?php 
                          $teams = explode(',', get_post_custom_values("qualifiers")[0]);
                          function formatname($str, $sep='-')
                          {
                              $res = strtolower($str);
                              $res = preg_replace('/[^[:alnum:][:punct:]]/', ' ', $res);
                              $res = preg_replace('/[[:space:]]+/', $sep, $res);
                              return trim($res, $sep);
                          }
                          
                          foreach($teams as $values){
                              $team = formatname($values);
                              
                              if ($values != '')
                              {
                                 echo '<div class="qualifiers col-xs-6 col-md-4 col-lg-2" >';
                                 echo '<img class="qualifiersimg" src="http://www.bet-esport.com/i/logos/'.$team.'-104x104.png"';
                                 echo "<span class='qualifierstext'><strong>$xxvalues</strong></span>";
                                 echo "</div>"; 
                              } 
                          };
                          ?> </div>
						<hr>
						<h2><i class="fa fa-gamepad"></i> Matches</h2> <span id="nomatch"></span>
						<div id="pinnacleDiv"> </div>
						<div id="tourid" style="display: none;">
							<?php echo get_post_custom_values("tournamentid")[0];?>
						</div>
						<script>
							var tourid = $.trim($('#tourid').text());
						</script>

						<hr>
						<div class="row">
							<div class="six columns" width="100%" style="overflow:hidden;">
								<h3><i class="fa fa-twitter"></i> #<?php echo get_post_custom_values("twitterhandle")[0]; ?></h3>
								<a class="twitter-timeline" href="https://twitter.com/hashtag/<?php echo get_post_custom_values(" twitterhandel ")[0]; ?>" data-widget-id="<?php echo get_post_custom_values(" twitterlink ")[0]; ?>" height="750" data-chrome="transparent noborders nofooter">
									<meta name="twitter:widgets:theme" content="dark">
									<meta name="twitter:widgets:link-color" content="#B71C1C"> </a>
								<script>
									! function (d, s, id) {
										var js, fjs = d.getElementsByTagName(s)[0]
											, p = /^http:/.test(d.location) ? 'http' : 'https';
										if (!d.getElementById(id)) {
											js = d.createElement(s);
											js.id = id;
											js.src = p + "://platform.twitter.com/widgets.js";
											fjs.parentNode.insertBefore(js, fjs);
										}
									}(document, "script", "twitter-wjs");
								</script>
							</div>
							<div class="six columns">
								<h3><i class="fa fa-newspaper-o"></i> News</h3>
								<div>
									<ul>
										<li>
											<?php

                          $args = array(
                              'posts_per_page'      => 4,
                              'category_name'       => 'News',
                              'tag'                 => get_post_custom_values("tournamentcode"),
                              'orderby'             => 'post_date',
                              'order'               => 'DESC',
                              'post_status'         => 'publish',
                          );

                          $noticias = new WP_Query( $args );
                          if ( $noticias->have_posts() ) {
                              while ( $noticias->have_posts() ) {
                                  $noticias->the_post();
                          ?>
												<a href="<?php the_permalink(); ?>">
													<table class="tournamentnews">
														<tr>
															<td width="100%" align="center" valign="top">
																<?php
                                  if ( has_post_thumbnail() ) {
                                      the_post_thumbnail();
                                  }
                                          ?>
															</td>
															<td class="textnews2"> <strong><?php the_title();?></strong> </td>
														</tr>
													</table>
												</a>
												<?php	
                              }
                          } else {
                              echo 'No news about '; echo get_the_title($ID);
                          }
                          wp_reset_postdata();
                          ?>
										</li>
									</ul>
								</div>
							</div>
						</div>
				</div>
				<div class="four columns">
					<?php include ('side.php'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php get_footer('prueba1'); ?>