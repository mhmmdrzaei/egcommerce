<?php // If there are no posts to display, such as an empty archive page ?>

<?php if ( ! have_posts() ) : ?>

	<article id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Not Found</h1>
		<section class="entry-content">
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
			<?php get_search_form(); ?>
		</section><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; // end if there are no posts ?>

<?php // if there are posts, Start the Loop. ?>

<?php while ( have_posts() ) : the_post(); ?>
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

<?php endwhile; // End the loop. Whew. ?>

