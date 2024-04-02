<?php
// Register Heading Post Block
function register_heading_post_block() {
    acf_register_block(array(
        'name'              => 'heading-post-block',
        'title'             => __('Heading Post Block'),
        'description'       => __('A custom block to display a selected post with its featured image, title, excerpt, and a "Read More" button.'),
        'render_callback'   => 'render_heading_post_block',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array('post', 'heading', 'excerpt'),
    ));
}
add_action('acf/init', 'register_heading_post_block');

// Render Heading Post Block
function render_heading_post_block($block) {
    $selected_post = get_field('select_post');

    if ($selected_post) :
        $post_id = $selected_post->ID;
        $post_title = get_the_title($post_id);
        $post_permalink = get_permalink($post_id);
        $post_excerpt = get_the_excerpt($post_id);
        $post_featured_image = get_the_post_thumbnail_url($post_id, 'full');
?>

<div class="heading-post-block">
<div class='container'>
    <a href="<?php echo esc_url($post_permalink); ?>">
         <figure>
             <img src="<?php echo esc_url($post_featured_image); ?>" alt="<?php echo esc_attr($post_title); ?>">
        </figure>
        <section class="heading-post-content">
        <h2><?php echo esc_html($post_title); ?></h2>
        <p><?php echo esc_html($post_excerpt); ?></p>
        <button class="btn-more" href="<?php echo esc_url($post_permalink); ?>">Read More</button>

        </section>
        

    </a>
</div>
 </div>

<?php
    endif;
}
?>