<?php
  // Afficher le menu principal
  wp_nav_menu( array(
    'theme_location' => 'primary-menu',
    'container' => 'nav',
    'container_class' => 'main-menu-container',
    'menu_class' => 'main-menu',
  ) );
?>