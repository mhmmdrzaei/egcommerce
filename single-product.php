<?php get_header(); ?>
<section class="container">
<h2><?php the_title(); ?></h2>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php
    // Get the terms (categories) for the current product
    $terms = get_the_terms( get_the_ID(), 'site-category' );
    if ( $terms && ! is_wp_error( $terms ) ) {
        echo '<section class="page-nav"><p>';
        $term_links = array();
        foreach ( $terms as $term ) {
            $term_links[] = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a>';
        }
        echo implode( ', ', $term_links );
        echo '>>'. the_title() . '<p></section>';
    }
    ?>




    <?php the_content(); ?>








<?php endwhile; // End the loop. Whew. ?>
</section>

<?php get_footer(); ?>

