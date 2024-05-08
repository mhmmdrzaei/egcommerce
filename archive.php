<?php get_header(); ?>

<?php
// Get the current product category ID
$category_id = get_queried_object_id();
$obj = get_queried_object();
$category_name = $obj->name;

// Retrieve custom field values
$background_color = get_term_meta($category_id, 'background_colour_cat', true);
$highlight_color = get_term_meta($category_id, 'highlight_colour_cat', true);

// WooCommerce sorting options
$catalog_orderby_options = array(
    'menu_order' => __('Default sorting', 'woocommerce'),
    'popularity' => __('Popularity', 'woocommerce'),
    'rating'     => __('Average rating', 'woocommerce'),
    'date'       => __('Latest', 'woocommerce'),
    'price'      => __('Price: low to high', 'woocommerce'),
    'price-desc' => __('Price: high to low', 'woocommerce'),
);
$orderby = isset($_GET['orderby']) && array_key_exists($_GET['orderby'], $catalog_orderby_options) ? $_GET['orderby'] : 'menu_order';

$args = array(
    'posts_per_page' => -1,

    'post_type' => 'product',
    'tax_query' => array(
        array(
            'taxonomy' => 'site-category',
            'field' => 'term_id',
            'terms' => $category_id
        )
        ,
        array(
            'taxonomy' => 'product_tag', // Use product_tag taxonomy
            'field' => 'slug',
            'terms' => 'visible'
        )
    ),
    'meta_query' => array(
        array(
            'key' => '_stock_status',
            'value' => 'instock'
        )
    ),
    'orderby' => $orderby // Include sorting parameter in the query
);

// If sorting by price, set meta_key and meta_type
if ($orderby == 'price') {
    $args['meta_key'] = '_price';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = 'ASC';
}

// If sorting by price descending, set order to DESC
if ($orderby == 'price-desc') {
    $args['meta_key'] = '_price';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = 'DESC';
}

$products = new WP_Query($args);
?>

<main class='product-cat-page' style='background-color: <?php echo $highlight_color; ?>;'>
    <div class='border' style='background-color: <?php echo $background_color; ?>;'></div>
    <div class='container'>
        <h2><?php echo $category_name; ?></h2>
        <div class="woocomControls">
             <!-- Result count -->
        <p class="woocommerce-result-count">
            <?php
            $total_products = $products->found_posts;
            $per_page = $args['posts_per_page'];
            $current_page = max(1, $paged);
            $first_product = ($per_page * $current_page) - $per_page + 1;
            $last_product = min($total_products, $per_page * $current_page);
            
            if ($total_products <= $per_page || $per_page == -1) {
                printf(_n('Showing  %d items', 'Showing  %d items', $total_products, 'woocommerce'), $total_products);
            } else {
                printf(_nx('Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d items', $total_products, 'with first and last result', 'woocommerce'), $first_product, $last_product, $total_products);
            }
            ?>
        </p>

        <!-- WooCommerce sorting dropdown -->
        <form class="woocommerce-ordering" method="get">
            <select name="orderby" class="orderby" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>">
                <?php foreach ($catalog_orderby_options as $id => $name) : ?>
                    <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="paged" value="1" />
            <?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
        </form>
       

        </div>



        <!-- Container for products -->
        <ul class='product-container'>
            <?php
            if ($products->have_posts()) :
                while ($products->have_posts()) : $products->the_post();
                    global $product;
                    $product_id = $product->get_id();
                    $product_link = get_permalink($product_id);
                    $product_title = get_the_title($product_id);
                    $product_image = get_the_post_thumbnail($product_id, 'large');
                    $price = $product->get_price_html();
                    $add_to_cart_url = $product->add_to_cart_url();
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
                                        echo $product_image;
                                    } else {
                                        $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
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
                <?php endwhile; ?>

            <?php else : ?>
                <!-- No products found -->
                <p>No products found</p>
            <?php endif; ?>

        </ul>
        
    </div>

  
        
</main>

<?php get_footer(); ?>
