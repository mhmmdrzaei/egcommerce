<?php get_header(); ?>
<div class="homepageFooter">
<main class="searchResultsPage">
	<?php if ( have_posts() ) : ?>
		<p>Search Results for <strong>" <?php echo get_search_query(); ?>":</strong></p>
		<?php get_template_part( 'loop', 'search' ); ?>
		<?php else : ?>
			<section class="noResults">
				<figure>
					<img src="<?php bloginfo('template_directory'); ?>/images/noresults.png">
				</figure>

				<h2>No Search Results Found</h2>

			</section>
		<?php endif; ?>

</main>

<?php get_footer(); ?>
</div>