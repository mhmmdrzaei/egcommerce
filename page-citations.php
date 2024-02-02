<?php get_header();  ?>
<main class="pageCitations">

  <section class="citationText" aria-label="introduction text explaining the citations section of the site">
    <?php the_content(); ?>
    <a href="#citationssID" class="citationsdown">
    <div class="arrowDown"></div>
    </a>
  </section>

  <section class=" scenes">
    <section class="scenes__wrap">
      <div class="scenes__items" id="citationssID">


        <?php // Start the loop ?>

          <?php $args = array( 'post_type' => 'citations', 
                // 'meta_key'      => 'start_date',
                // 'orderby'      => 'meta_value',
                 'order'       => 'DESC',
                // 'orderby' => array(
                //    'meta_value_num' => 'desc',
                //    'post_date' => 'desc'
                'orderby'    => array(
                      'start_date' => 'DSC',
                      'post_date' => 'desc'
                    ),
                'posts_per_page' => -1 );
            query_posts( $args ); // hijack the main loop

            if ( ! have_posts() ) : ?>

        <article id="post-0" class="fullwidthpost" aria-label="no citations listed">
          <h2 class="entry-title">Not Found</h2>
           <section class="excerptPosts fullwidthexcerpts">
            <p>Apologies, but no results were found!</p>
          </section><!-- .entry-content -->
        </article><!-- #post-0 -->

        <?php endif; // end if there are no posts ?>
        <?php // if there are posts, Start the Loop. ?>

        <?php while ( have_posts() ) : the_post(); ?>
        <?php if( get_field('content_option_citations') == 'video' ) {; ?>
          <article id="post-<?php the_ID(); ?>" class="citationsPost" aria-label="citations item container">
            <section class="citationsInner scene">
            <div class="videoContainer scene__figureCite" aria-label="citation video container"> 
              <?php the_field('embedded_video'); ?>
            </div>
            
            <h2 class="postTitle scene__headerCite"><?php the_title(); ?></h2>
          </section>
          </article>
        <?php } ?>
        <?php if( get_field('content_option_citations') == 'image' ) {; ?>
          <article id="post-<?php the_ID(); ?>" class="citationsPost" aria-label="citations item container">
            <?php if( have_rows('image_with_link_citations' ) ): ?>
                <?php while( have_rows('image_with_link_citations') ): the_row(); ?>
                  
                  
                    <section class="citationsInner scene">
                    <?php 
                    $image = get_sub_field('image_imgwLink');
                    if( !empty( $image ) ): ?>
                     
                      <figure class="scene__figureCite" aria-label="image accompanying link">
                         <a href="<?php the_sub_field('link_img',) ;?>" target="_blank">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                      </a>
                      </figure>
                      <a href="<?php the_sub_field('link_img',) ;?>" target="_blank">
                    <?php endif; ?>
                     
                    <h2 class="postTitle scene__headerCite"><a href="<?php the_sub_field('link_img',) ;?>" target="_blank"><?php the_title(); ?></a></h2>
                    </section>
                  
                
                 <?php endwhile; ?>
               <?php endif; ?>     
          </article>
        <?php } ?>
        <?php if( get_field('content_option_citations') == 'pdfFile' ) {; ?>
          <article id="post-<?php the_ID(); ?> " class="citationsPost" aria-label="pdf file embedded onto the page with the option to be downloaded as a file">
            <?php if( have_rows('pdf_file_container' ) ): ?>
                <?php while( have_rows('pdf_file_container') ): the_row(); ?>
                  
                    <section class="citationsInner scene">
                    <?php 
                    $imagepdf = get_sub_field('pdf_cover_image');
                    if( !empty( $imagepdf ) ): ?>
                      
                      <figure class="scene__figureCite" aria-label="cover image for pdf file: <?php the_title(); ?> ">
                        <a href="<?php the_sub_field('pdf_file');?>" target="_blank">
                        <img src="<?php echo esc_url($imagepdf['url']); ?>" alt="<?php echo esc_attr($imagepdf['alt']); ?>" /></a>
                      </figure>
                      

                    <?php endif; ?>
                    <h2 class="postTitle scene__headerCite"> <a href="<?php the_sub_field('pdf_file');?>" target="_blank"><?php the_title(); ?> <i class="fa-solid fa-file-pdf"></i></a></h2>
                    </section>
                
                 <?php endwhile; ?>
               <?php endif; ?>   
           
              
          </article>
        <?php } ?>


        <?php endwhile; // End the loop. Whew. ?>
         <?php wp_reset_query();?> 
      </div>
    </section>
   
  </section>
</main>



<?php get_footer(); ?>