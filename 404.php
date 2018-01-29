<?php get_header(); ?>

  <div class="row">
    <div class="twelve columns"> 
      <div class="row"> 
        <div class="eight columns">
          <h1>Oops! Error 404 - Page not found</h1>
          <br>
          <a href="<?php bloginfo('home'); ?>"><img name="Home" src="/i/home.gif" width="580" height="60" border="0" alt="<?php bloginfo('name'); ?>"></a>
          <p>Sorry, but it seems the page you're looking for isn't here.</p>
          <h2>Try searching here</h2>
          <p><?php get_search_form(); ?></p>
          <p>Or try the sitemap, and maybe you'll find what you where looking for.</p>
          <h2>View Sitemap</h2>

          <ul>
          <?php
          // Add categories you'd like to exclude in the exclude here
          $cats = get_categories('exclude=');
          foreach ($cats as $cat) {
            echo "<li><h3>".$cat->cat_name."</h3>";
            echo "<ul>";
            query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
            while(have_posts()) {
              the_post();
              $category = get_the_category();
              // Only display a post link once, even if it's in multiple categories
              if ($category[0]->cat_ID == $cat->cat_ID) {
                echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
              }
            }
            echo "</ul>";
            echo "</li>";
          }
          ?>
              </ul>
              <br>         
        </div>


        <div class="four columns">
          <?php include ('side.php'); ?>
        </div>

      </div>

    </div>

  </div>


<?php get_footer(); ?>