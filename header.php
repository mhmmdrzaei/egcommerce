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

<header class="frontHeader">
  <main class="headerContainer container">
  <label id="topMenu" class="menu__icon headerMainMenu" for="menu__check">
       <div class="hamburger-menu"></div> 
  </label>
    <section class="title">
    <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name', 'display' ); ?>" rel="home">
      <h1><?php bloginfo( 'name' ); ?> </h1>
    </a>
      <section class="titledescription">
        <section class="titleDescContainer">
        <?php bloginfo( 'description' ); ?> 

        </section>

      </section>
    </section>
    <section class="headerMenu">
    <div class="menu-border"></div>
    <div class="menu-border-2"></div>
    <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'primary'
      )); ?>


    </section>

      <section class="accessHeaderContainer">
      <button class="access" aria-label="Accessibility menu, here you can adjust font size or desaturate page">Accessibility</button>


        <section class="commercecontainer">
        <button class="search_btn">
          <img src="<?php bloginfo('template_directory'); ?>/images/search.png" alt="magnifying glass to open search panel">
        </button>
          <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"> <img src="<?php bloginfo('template_directory'); ?>/images/cart.png" alt="Image of a Shopping Cart"><span><?php echo WC()->cart->get_cart_contents_count() ?></span>
            </a>

        <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) );?>" class="user_acct"><img src="<?php bloginfo('template_directory'); ?>/images/person.png" alt="icon for user panel"></a>


          
        </section>
        <section class="searchformcontainer">
        <?php require('searchform.php');?>
        </section>
        <section class="accessMenuCover" aria-label="Accessibility menu container">
               
               <section class="accessMenu">
                 <section class="fontSizeIncrease">
                   <button class="decreaseFont" value="decrease" aria-label="Decrease font size, measure by 1 px"> — </button>
                   <button class="increaseFont" value="increase" aria-label="Increase font size, measure by 1 px"> + </button>
                   
                 </section>
                 <section class="desaturateMenu" aria-label="Desaturate pages to white with black buttons and links">
                   <button class="desaturate">High Contrast</button>
                   <button class="imgSize">Smaller Images</button>
                 </section>
                 <section class="clearselections" aria-label="Clear your inputs and revert to origional styling">
                   <button class="clearInputs">Clear Inputs</button>
                 </section>
               </section>
       </section>

      </section>
      
  </main>

</header><!--/.header-->

