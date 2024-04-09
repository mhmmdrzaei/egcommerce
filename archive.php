<?php get_header(); ?>
   
  <?php

  
// Get the current product category ID
$category_id = get_queried_object_id();
$obj = get_queried_object();
$category_name = $obj->name;


// Retrieve custom field values
$background_color = get_term_meta($category_id, 'background_colour_cat', true);
$highlight_color = get_term_meta($category_id, 'highlight_colour_cat', true);

$args = array(
    'posts_per_page' => 10, // Display 10 entries per page
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Pagination
    'post_type' => 'product',
    'tax_query' => array(
        array(
            'taxonomy' => 'site-category',
            'field' => 'term_id',
            'terms' => $category_id
        )
    ),
    'meta_query' => array(
        array(
            'key' => '_stock_status',
            'value' => 'instock'
        )
    )
);?>

<?php

$products = new WP_Query($args);

if ($products->have_posts()) :
    // Output category background color
    echo "<main style='background-color: $background_color;'>";

    // Output category highlight color
    echo "<div style='background-color: $highlight_color;'></div><div class='container'>";
    echo "<h2>$category_name</h2>";
  
    // Output container for products
    echo "<ul class='product-container'>";
    

    while ($products->have_posts()) : $products->the_post();
        global $product;
        $product_id = $product->get_id();
        $product_link = get_permalink($product_id);
        $product_title = get_the_title($product_id);
        $product_image = get_the_post_thumbnail($product_id, 'thumbnail');
        $add_to_cart_url = $product->add_to_cart_url();
        $product_gallery_ids = $product->get_gallery_image_ids();
        ?>
      

    <li class="product-item">
        <a href="<?php echo $product_link; ?>">

        <?php if ($product_image): ?>
        <div class="product-image">
            <?php echo $product_image; ?>
        </div>
      <?php else: ?>
        <div class="product-image">
            <?php
            global $product;

            if ( $product ) {
                $post_thumbnail_id = $product->get_image_id();
            }

            if ( $post_thumbnail_id ) {
                $html = wc_get_gallery_image_html( $post_thumbnail_id, true );
            } else {
                $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
                $html .= '</div>';
            }

            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
            ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($product_gallery_ids)) {
                    echo "<div class='product-carousel'>";
                    foreach ($product_gallery_ids as $gallery_id) {
                        echo wp_get_attachment_image($gallery_id, 'thumbnail');
                    }
                    echo "</div>";
           }?>
          </a>
          <section class="product_info">
          <h4><a href="<?php echo $product_link; ?>"><?php echo $product_title; ?></a></h4>
      
          <a href="<?php echo $add_to_cart_url; ?>" class="add-to-cart-btn">Add to Cart</a>

          </section>

      </li>

    <?php endwhile;

    // Pagination
    echo "<div class='pagination'>";
    echo paginate_links(array(
        'total' => $products->max_num_pages
    ));
    echo "</div>";

    // Close containers
    echo "</div>"; // .product-container
    echo "</div>"; // .highlight-color
    echo "</div>"; // .background-color

    // Reset Post Data
    wp_reset_postdata();
else :
    // No posts found
    echo '<p>No products found</p>';
endif;
?>

  </section>
  
</main>

<?php get_footer(); ?>