<?php

// Register Commerce Category Block
function register_commerce_category_block() {
    acf_register_block(array(
        'name'              => 'commerce-category-block',
        'title'             => __('Commerce Category Block'),
        'description'       => __('A custom block to display most recent posts from a selected commerce category.'),
        'render_callback'   => 'render_commerce_category_block',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array('product', 'woocommerce', 'category'),
    ));
}
add_action('acf/init', 'register_commerce_category_block');


// Render Commerce Category Block
function render_commerce_category_block($block) {
    // Retrieve field values
    $commerce_category = get_field('commerce_category');
    $selected_category_id = $commerce_category; //

    // Retrieve custom category colors
    $background_color = get_term_meta($selected_category_id, 'background_colour_cat', true);
    $highlight_color = get_term_meta($selected_category_id, 'highlight_colour_cat', true);

    // Output background and highlight colors
    $style = "style='background-color: $background_color; border-top: 4px solid $highlight_color;'";

    // Output block content
    echo "<div class='commerce-category-block' $style>";

    // Output category name
    $category_name = $commerce_category->name;
    echo "<h2>$category_name</h2>";

    // Output recent products
    $args = array(
        'posts_per_page' => 9,
        'post_type' => 'product',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $selected_category_id
            )
        ),
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'instock'
            )
        )
    );
    $products = new WP_Query($args);
    if ($products->have_posts()) {
        echo "<ul class='product-list'>";
        while ($products->have_posts()) {
            $products->the_post();
            global $product;
            $product_id = $product->get_id();
            $product_link = get_permalink($product_id);
            $product_title = get_the_title($product_id);
            $product_image = get_the_post_thumbnail($product_id, 'thumbnail');
            $product_gallery_ids = $product->get_gallery_image_ids();
            $add_to_cart_url = $product->add_to_cart_url();
            ?>
            <li class="product-item">
            <a href="<?php echo $product_link; ?>">
                <?php if ($product_image): ?>
                    <div class="product-image"><?php echo $product_image; ?></div>
                <?php endif; ?>

                <?php
                if (!empty($product_gallery_ids)) {
                    echo "<div class='product-carousel'>";
                    foreach ($product_gallery_ids as $gallery_id) {
                        echo wp_get_attachment_image($gallery_id, 'thumbnail');
                    }
                    echo "</div>";
                }
                ?>
                </a>
                <h3><a href="<?php echo $product_link; ?>"><?php echo $product_title; ?></a></h3>
            
                <a href="<?php echo $add_to_cart_url; ?>" class="add-to-cart-btn">Add to Cart</a>
            </li>
            <?php
        }
        echo "</ul>";

        // Output "more" link
        $category_link = get_term_link($commerce_category);
        echo "<a class='more-link' href='$category_link'>More $category_name</a>";
    }
    wp_reset_postdata();

    echo "</div>";
}