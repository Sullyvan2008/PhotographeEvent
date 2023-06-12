<?php
// Ajouter les fonctionnalités du thème
function photographe_supports() {
    // Activer la prise en charge des images mises en avant
    add_theme_support( 'post-thumbnails' );
    
    // Ajouter la prise en charge des titres de page
    add_theme_support( 'title-tag' );
    
    // Activer la gestion automatique des menus
    register_nav_menus( array(
        'primary-menu' => 'Menu principal',
    ) );

    // Activer la prise en charge du logo du site
    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 160,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
}
add_action( 'after_setup_theme', 'photographe_supports' );

// Enqueue les scripts et les styles du thème
function photographe_enqueue_scripts() {
    // Enqueue le fichier style.css du thème
    wp_enqueue_style( 'photographe-style', get_stylesheet_uri() );
    
    // Enqueue un script personnalisé (exemple)
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . 'js/custom.js');
}
add_action( 'wp_enqueue_scripts', 'photographe_enqueue_scripts' );

// Afficher la barre d'administration de WordPress
function show_admin_bar_on_frontend() {
    return true;
}
add_filter( 'show_admin_bar', 'show_admin_bar_on_frontend' );

