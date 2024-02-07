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



		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if (has_post_thumbnail()): ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
				</div>
			<?php endif; ?>
			<h3><?php the_title(); ?></a></h3>
			<p><?php the_excerpt(); ?></p>
			<a class="more-post-btn" href="<?php the_permalink(); ?>">More</a>
	

		</article><!-- #post-## -->


<?php endwhile; // End the loop. Whew. ?>

