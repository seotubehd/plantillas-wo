<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-flex">
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <span class="logo-text">PLANTILLAS <span class="highlight">WO</span></span>
            </a>
        </div>
        <nav class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>
        <div class="header-cta">
            <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link">
                <span class="dashicons dashicons-cart"></span> <?php echo WC()->cart->get_cart_total(); ?>
            </a>
        </div>
    </div>
</header>
