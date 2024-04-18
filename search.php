<?php get_header(); ?>
<main class="searchResultsPage">
	<?php
	// Get the search query
	$search_query = get_search_query();

	// Output the search results title


	// Define the arguments for WP_Query
	$args = array(
		'posts_per_page' => -1,
		'post_type'      => 'product',
		's'              => $search_query, // Search for the queried term
		'meta_query'     => array(
			array(
				'key'   => '_stock_status',
				'value' => 'instock'
			)
		),
	);

	// Perform the query
	$products = new WP_Query($args);
	?>

	<div class='container'>
		<?php 	echo '<h2>Search results for: ' . esc_html($search_query) . '</h2>';?>

		<!-- Container for products -->
		<ul class='product-container'>
			<?php
			// Check if there are products found
			if ($products->have_posts()) :
				while ($products->have_posts()) : $products->the_post();
					global $product;
					$product_id         = $product->get_id();
					$product_link       = get_permalink($product_id);
					$product_title      = get_the_title($product_id);
					$product_image      = get_the_post_thumbnail($product_id, 'thumbnail');
					$price              = $product->get_price_html();
					$add_to_cart_url    = $product->add_to_cart_url();
					$product_gallery_ids = $product->get_gallery_image_ids();
			?>
					<li class="product-item">
						<a href="<?php echo $product_link; ?>">
							<?php if ($product_image) : ?>
								<div class="product-image">
									<?php echo $product_image; ?>
								</div>
							<?php else : ?>
								<div class="product-image">
									<?php
									global $product;
									if ($product) {
										$post_thumbnail_id = $product->get_image_id();
									}
									if ($post_thumbnail_id) {
										$html = wc_get_gallery_image_html($post_thumbnail_id, true);
									} else {
										$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
										$html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
										$html .= '</div>';
									}
									echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id);
									?>
								</div>
							<?php endif; ?>
							<?php if (!empty($product_gallery_ids)) {
								echo "<div class='product-carousel'>";
								foreach ($product_gallery_ids as $gallery_id) {
									echo wp_get_attachment_image($gallery_id, 'thumbnail');
								}
								echo "</div>";
							} ?>
						</a>
						<section class="product_info">
							<h4><a href="<?php echo $product_link; ?>"><?php echo $product_title; ?></a></h4>
							<p class="price"><?php echo $price; ?></p>
							<a href="<?php echo $add_to_cart_url; ?>" class="add-to-cart-btn">Add to Cart</a>
						</section>
					</li>
			<?php endwhile; ?>

			<?php else : ?>
				<!-- No products found -->
				<p>No products found</p>
			<?php endif; ?>

		</ul>

	</div>

</main>

<?php get_footer(); ?>
