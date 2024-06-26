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
    if (!$commerce_category) {
        return;
    }

    $selected_category_id = $commerce_category;
    $category = get_term($selected_category_id);

    // Retrieve custom category colors
    $background_color = get_term_meta($selected_category_id, 'background_colour_cat', true);
    $highlight_color = get_term_meta($selected_category_id, 'highlight_colour_cat', true);

    // Output background and highlight colors
    $style = $background_color ? "style='background-color: $background_color'" : '';
    $styleTop = $highlight_color ? "style='background-color: $highlight_color;'" : '';

    // Output block content
    echo "<div class='commerce-category-block' $styleTop><div class='border' $style></div><div class='container'>";

    // Output category name
    $category_name = $category->name;
    $category_link = get_term_link($selected_category_id);
    echo "<h2><a href='$category_link'>$category_name</a></h2>";

    // Output recent products
    $args = array(
        'posts_per_page' => wp_is_mobile() ? 3 : 8,
        'post_type' => 'product',
        'tax_query' => array(
            array(
                'taxonomy' => 'site-category',
                'field' => 'term_id',
                'terms' => $selected_category_id
            ),
            array(
                'taxonomy' => 'product_tag',
                'field' => 'slug',
                'terms' => 'visible'
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
        echo "<div class='prev-btn'>&lt;</div>";
        echo "<div class='product-container'>";
        echo "<ul class='product-list commerce-carousel'>";

        while ($products->have_posts()) {
            $products->the_post();
            global $product;
            $product_id = $product->get_id();
            $product_link = get_permalink($product_id);
            $product_title = get_the_title($product_id);
            $price = $product->get_price_html();
            $product_image = get_the_post_thumbnail($product_id, 'large');
            $add_to_cart_url = $product->add_to_cart_url();
            ?>
            <li class="product-item">
                <?php if ($product->is_on_sale()) : ?>
                    <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale onSaleCustom">' . esc_html__('Sale!', 'woocommerce') . '</span>', $product); ?>
                <?php endif; ?>
                <a href="<?php echo $product_link; ?>">
                <?php if ($product_image): ?>
                    <div class="product-image">
                        <?php echo $product_image; ?>
                    </div>
                <?php else: ?>
                    <div class="product-image">
                        <?php
                        global $product;

                        if ($product) {
                            $post_thumbnail_id = $product->get_image_id();
                        }

                        if ($post_thumbnail_id) {
                            echo $product_image;
                        } else {
                            $html = '<div class="woocommerce-product-gallery__image--placeholder">';
                            $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
                            $html .= '</div>';
                        }

                        echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id);
                        ?>
                    </div>
                <?php endif; ?>
                    </a>
                <section class="product_info">
                    <h4><a href="<?php echo $product_link; ?>"><?php echo $product_title; ?></a></h4>
                    <p class="price"><?php echo $price; ?></p>
                    <a href="<?php echo $add_to_cart_url; ?>" class="add-to-cart-btn">Add to Cart</a>
                </section>
            </li>
            <?php
        }

        echo "<a class='more-link' href='$category_link'>See More $category_name</a>";
        echo "</ul></div>";
        echo "<div class='next-btn'>&gt;</div>";
    }

    wp_reset_postdata();

    echo "</div></div>";
}
