<?php

/* Template Name: Homepage */

get_header();
 ?>

  <article class="container-fluid sroll-close" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">
      <?php
      the_content();
      ?>
    </div><!-- .entry-content -->


  </article><!-- #post-<?php the_ID(); ?> -->



<?php get_footer(); ?>