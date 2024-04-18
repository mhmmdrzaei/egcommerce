<?php get_header();  ?>
<main class="singlePage ">
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section class="pageContent container">

  <?php
// Check if it's a product category page
if (is_product_category()) {
    // Get the current product category ID
    $category_id = get_queried_object_id();

    // Retrieve custom field values
    $custom_field_value_1 = get_term_meta($category_id, 'background_colour_cat', true);
    $custom_field_value_2 = get_term_meta($category_id, 'highlight_colour_cat', true);

    // Display custom field values
    echo '<section class="cat_page_title" style="background:'.$custom_field_value_2.'"><h1>';
    the_title();
    echo '</h1></section>';
    echo '<section class="cat_page" style="background:'.$custom_field_value_1.'">';

    the_content(); 
}
else {
  echo '<h1>';
  the_title();
  echo '</h1>';?>
  <?php if (has_post_thumbnail()): ?>
    <div class="post-thumbnail">
        <?php the_post_thumbnail('large'); ?>
    </div>
    <div class="page_content_page_half">
<?php the_content(); ?>

</div>
<?php else : ?>
    <div class="page_content_page_full">
<?php the_content(); ?>

</div>

<?php endif; ?>

<?php }
?>
</section>


  </section>
   <?php endwhile; // end the loop?>
</main>

<?php get_footer(); ?>