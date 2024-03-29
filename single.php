<?php get_header(); ?>
<section class="container">
<h2><?php the_title(); ?></h2>
<section class="page-nav">
  <p><a href="/updates">Updates</a> >> <?php the_title(); ?></p> 

</section>


</section>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section class="contentContainerSingle">
    <?php if (has_post_thumbnail()): ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
        </div>
    <?php endif; ?>
    <?php the_content(); ?>

</section>





<?php endwhile; // End the loop. Whew. ?>

<?php get_footer(); ?>

