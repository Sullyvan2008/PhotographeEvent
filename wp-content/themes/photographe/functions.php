<?php

function photographe_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
}

function photographe_register_menus() {
    register_nav_menus( array(
      'primary-menu' => 'header',
    ) );
  }

add_action('after_setup_theme', 'photographe_supports');
add_action('after_setup_theme', 'photographe_register_menus');