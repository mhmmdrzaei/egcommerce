<footer>
<div class="conebackground"></div>
<div class="container footerContainer">
<?php
if( get_field('footer_with_physical_location_', 'options') ) {
   

$location = get_field('gallery_address','options');
if( $location ): ?>
<section class="footermap">
<h3>Finds us at</h3>
    <div class="acf-map" data-zoom="16">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
</section>
<section class="locationaddress">
    <?php echo esc_html($location['address']);
     echo get_field('gallery_hours','options');
    ?>
    <a href="mailto:<?php echo get_field('site_email','options')?>"><h3><?php echo get_field('site_email','options')?></h3></a>

    

</section>
<?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'footer'
      )); ?>



<?php 
$image = get_field('footer_logo', 'options');
if( !empty( $image ) ): 
?>

<figure class="footerlogo">
<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
</figure>

<?php endif; ?>


<?php endif; 

} else { ?>
    <div class="email">
        <a href="mailto:<?php echo get_field('site_email','options')?>"><h3><?php echo get_field('site_email','options')?></h3></a>
    </div>
    <?php 
    $image = get_field('footer_logo', 'options');
    if( !empty( $image ) ): 
    ?>

    <figure class="footerlogo">
    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
    </figure>

    <?php endif; ?>
    <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'footer'
      )); 


}

?>



<p class="copyright">
&copy; <?php bloginfo( 'name' ); ?> <?php echo date('Y'); ?>

</p>

</div>




</footer>

<script>
// scripts.js, plugins.js and jquery are enqueued in functions.php
/* Google Analytics! */
 var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]]; // Change UA-XXXXX-X to be your site's ID
 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
 g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
 s.parentNode.insertBefore(g,s)}(document,"script"));
</script>

<?php wp_footer(); ?>
</body>
</html>