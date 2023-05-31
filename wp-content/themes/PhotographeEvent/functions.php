<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

  // Déclaration de l'emplacement du menu
function theme_register_menus() {
    register_nav_menus( array(
      'primary-menu' => 'Menu principal',
    ) );
  }
  add_action( 'after_setup_theme', 'theme_register_menus' );
  
?>