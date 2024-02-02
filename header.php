<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php body_class(); ?>>
<head>
	<?php // Load Meta ?>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php  wp_title('|', true, 'right'); ?></title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!-- stylesheets should be enqueued in functions.php -->
  <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

<header>
  <main class="headerContainer">
      <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'primary'
      )); ?>
      <div id="menu-wrapper">
         <div id="hamburger-menu"><span></span><span></span><span></span></div>
         <!-- hamburger-menu -->
      </div>
  </main>

</header><!--/.header-->

