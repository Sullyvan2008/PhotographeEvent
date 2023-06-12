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
}
add_action( 'after_setup_theme', 'photographe_supports' );

// Enqueue les scripts et les styles du thème
function photographe_enqueue_scripts() {
    // Enqueue le fichier style.css du thème
    wp_enqueue_style( 'photographe-style', get_stylesheet_uri() );
    
    // Enqueue un script personnalisé (exemple)
    wp_enqueue_script( 'photographe-custom-script', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'photographe_enqueue_scripts' );
