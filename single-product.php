<?php get_header(); ?>
<section class="container">
<h2><?php the_title(); ?></h2>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section class="page-nav">
  <p>  <?php
$product_categories = wc_get_product_category_list( $product->get_id(), ', ' );

if ( $product_categories ) {
    echo '<div class="product-categories">' . $product_categories . '</div>';
}
?>>> <?php the_title(); ?></p> 




</section>


</section>


<section class="contentContainerSingle">
    <?php the_content(); ?>



</section>





<?php endwhile; // End the loop. Whew. ?>

<?php get_footer(); ?>

