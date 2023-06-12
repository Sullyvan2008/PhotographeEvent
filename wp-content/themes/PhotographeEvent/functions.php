
<?php
  // Déclaration de l'emplacement du menu
function theme_register_menus() {
    register_nav_menus( array(
      'primary-menu' => 'header',
    ) );
  }
  add_action( 'after_setup_theme', 'photographeevent_register_menus' );
  
?>