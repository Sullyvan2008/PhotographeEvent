<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="container">
<?php get_template_part( 'template-parts/contact' ); ?>

    <div class="site-logo">
        <?php
        // Afficher le logo
        the_custom_logo();
        ?>
    </div>

    <nav>
        <?php
        // Afficher le menu principal
        wp_nav_menu( array(
            'theme_location' => 'primary-menu',
            'container' => 'ul',
            'menu_class' => 'main-menu',
        ) );
        ?>
        <button id="myBtn">CONTACT</button>
    </nav>
</header>

    <div id="content">
