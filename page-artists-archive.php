<?php
get_header();

// Custom Query for 'artists' post type with tag__not_in
$args = array(
    'post_type'      => 'artists',
    'order'          => 'ASC',
    'orderby'        => 'title',
    'posts_per_page' => -1,
    'tag__not_in'    => array(get_term_by('name', 'current', 'post_tag')->term_id),
);

$query = new WP_Query($args);

// Check if there are posts
if ($query->have_posts()) :
    ?>
    <main class="homepageContainer">
        <section class="artistsHome scenes" id="archive" aria-label="artist container">
            <section class="scenes__wrap">
                <div class="scenes__items">
                    <?php
                    while ($query->have_posts()) : $query->the_post();
                        ?>
                        <article class="artistEach scene" aria-label="single artist container with an avatar image created for this project, artist name and a brief description of the project">
                            <?php if (get_field('language_options') == 'Single Language') { ?>
                                <section class="scene__header openingDesc">
                                    <a class="artistLink" href="<?php the_permalink(); ?>">
                                        <h1><?php the_title(); ?></h1>
                                        <section class="openingDesciption ">
                                            <?php the_field('page_description'); ?>
                                        </section>
                                    </a>
                                </section>
                            <?php } ?>
                            <?php if (get_field('language_options') == 'Multi-Language') { ?>
                                <section class="scene__header openingDesc">
                                    <a class="artistLink" href="<?php the_permalink(); ?>">
                                        <h1><?php the_title(); ?></h1>
                                        <?php if (have_rows('multi_language_fields')) : ?>
                                            <?php while (have_rows('multi_language_fields')) : the_row(); ?>
                                                <section class="openingDesciption">
                                                    <?php the_sub_field('page_description_multi'); ?>
                                                </section>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </a>
                                </section>
                            <?php } ?>
                            <figure class="scene__figure">
                                <a class="artistLink" href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            </figure>
                        </article>
                    <?php endwhile; ?>
                </div>
            </section>
        </section>
    </main>
<?php else : ?>
    <main class="homepageContainer">
        <section class="no-posts-message">
            <p>No achives Listed at the moment check back later. </p>
        </section>
    </main>
<?php endif;

// Reset post data
wp_reset_postdata();

get_footer();
?>
