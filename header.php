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
    <section class="title">
    <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name', 'display' ); ?>" rel="home">
      <h1><?php bloginfo( 'name' ); ?> </h1>
    </a>
      <section class="titledescription">
      <?php bloginfo( 'description' ); ?> 
      </section>
    </section>
      <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'primary'
      )); ?>
      <div id="menu-wrapper">
         <div id="hamburger-menu"><span></span><span></span><span></span></div>
         <!-- hamburger-menu -->
      </div>
      <section class="accessMenuCover" aria-label="Accessibility menu container">
                <button class="access" aria-label="Accessibility menu, here you can adjust font size or desaturate page">Accessibility</button>
                <section class="accessMenu">
                  <section class="fontSizeIncrease">
                    <button class="decreaseFont" value="decrease" aria-label="Decrease font size, measure by 1 px"> — </button>
                    <button class="increaseFont" value="increase" aria-label="Increase font size, measure by 1 px"> + </button>
                    
                  </section>
                  <section class="desaturateMenu" aria-label="Desaturate pages to white with black buttons and links">
                    <button class="desaturate">Desaturate Page</button>
                  </section>
                  <section class="clearselections" aria-label="Clear your inputs and revert to origional styling">
                    <button class="clearInputs">Clear Inputs</button>
                  </section>
                </section>
        </section>
        <section class="commercecontainer">
        <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'commerce'
      )); ?>
        </section>
  </main>

</header><!--/.header-->

