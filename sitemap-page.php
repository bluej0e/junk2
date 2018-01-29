<?php get_header(); ?>

<div class="row">

  <div class="twelve columns">
      
    <div class="row"> 

      <div class="eight columns">

        <h1>Sitemap</h1>
        <h2>Paginas:</h2>
        <ul>
        <?php wp_list_pages('title_li='); ?>
        </ul>
        <h2>Categorias:</h2>
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