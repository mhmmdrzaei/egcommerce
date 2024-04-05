<?php get_header(); ?>
<section class="singlePost container">
<h2><?php the_title(); ?></h2>
<section class="page-nav">
  <p><a href="/updates">Updates</a> >> <?php the_title(); ?></p> 

</section>
<section class="contentContainerSingle">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php if (has_post_thumbnail()): ?>
        <figure class="post-thumbnail">
            <?php the_post_thumbnail('large'); ?>
    </figure>
        <div class="page_content_page_half">
    <?php the_content(); ?>

    </div>
    <?php else : ?>
        <div class="page_content_page_full">
    <?php the_content(); ?>

    </div>

    <?php endif; ?>

   

</section>
    </section>





<?php endwhile; // End the loop. Whew. ?>

<?php get_footer(); ?>

