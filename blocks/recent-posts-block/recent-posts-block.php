<?php
// Register Recent Posts Block
function register_recent_posts_block() {
    acf_register_block(array(
        'name'              => 'recent-posts-block',
        'title'             => __('Recent Posts Block'),
        'description'       => __('A custom block to display the two most recent posts that are not tagged as "featured".'),
        'render_callback'   => 'render_recent_posts_block',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array('post', 'recent', 'featured'),
    ));
}
add_action('acf/init', 'register_recent_posts_block');


// Render Recent Posts Block
function render_recent_posts_block($block) {
    // Output block content
    echo "<div class='recent-posts-block'><div class='container'>";

    // Output block title
    echo "<h2>Shop updates</h2>";

    // Output recent posts
    $args = array(
        'posts_per_page' => 2,
        'post_type' => 'post',
        'post__not_in' => get_option('sticky_posts'),
        'meta_query' => array(
            array(
                'key' => 'featured',
                'compare' => 'NOT EXISTS' // Exclude posts tagged as 'featured'
            )
        )
    );
    $recent_posts = new WP_Query($args);
    if ($recent_posts->have_posts()) {
        echo "<ul class='post-list'>";
        while ($recent_posts->have_posts()) {
            $recent_posts->the_post();
           
            ?>
            
            <li class="post-item">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                    <figure class="post-thumbnail">
                        <?php the_post_thumbnail('medium'); ?>
                </figure>
                    <div class="postContentHalf">
                        <h3><?php the_title(); ?></h3>
                        
                        <?php the_excerpt(); ?>
                        <button class="more-post-btn">More</button>
                    </div>
                    <?php else: ?>
                        <div class="postContentFull">
                            <h3><?php the_title(); ?></h3>
                            
                            <?php the_excerpt(); ?>
                            <button class="more-post-btn" >More</button>
                        </div>
                <?php endif; ?>
               
                </a>
            </li>
            
            <?php
        }
        echo "</ul>";
    } else {
        echo "<p>No recent posts found.</p>";
    }
    wp_reset_postdata();

    // Output "More Updates" button
    $updates_page_url = get_permalink(get_option('page_for_posts'));
    echo "<a href='$updates_page_url' class='more-updates-btn'>More Updates</a>";

    echo "</div></div>";
}
