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
    wp_enqueue_script( 'photographe-script', get_template_directory_uri() . '/custom.js', '1.0', true );
    wp_enqueue_script( 'lightbox-script', get_template_directory_uri() . '/lightbox.js', '1.0', true );
    wp_enqueue_script( 'filter-script', get_template_directory_uri() . '/filter.js', [ 'jquery' ]);
     // Script pour localiser les paramètres AJAX
     wp_localize_script('your-script-handle', 'ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('your-ajax-nonce'),
    ));

}
add_action( 'wp_enqueue_scripts', 'photographe_enqueue_scripts' );

// Afficher la barre d'administration de WordPress
function show_admin_bar_on_frontend() {
    return true;
}
add_filter( 'show_admin_bar', 'show_admin_bar_on_frontend' );


function filter_photos_ajax_handler() {
  $categorie = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
  $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
  $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

  $args = array(
    'post_type' => 'photos',
    'posts_per_page' => 8, // Limite le nombre de photos à charger à la fois
    'offset' => $offset // Utiliser l'offset pour charger les photos suivantes
  );

  if (!empty($categorie) && $categorie !== 'toutes-les-categories') {
    $args['tax_query'][] = array(
      'taxonomy' => 'categorie',
      'field' => 'slug',
      'terms' => $categorie,
    );
  }

  if (!empty($format) && $format !== 'tous-les-formats') {
    $args['tax_query'][] = array(
      'taxonomy' => 'format',
      'field' => 'slug',
      'terms' => $format,
    );
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
      $title = get_the_title();
      $permalink = get_permalink();
      ?>
      <div class="photo-overlay">
        <a href="<?php echo $permalink; ?>" class="lightbox">
          <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $title; ?>">
        </a>
      </div>
      <?php
    }
  } else {
    if ($offset === 0) {
      echo 'Aucune photo trouvée.';
    }
  }

  wp_reset_postdata();
  wp_die();
}

function load_more_photos_ajax_handler() {
    // Récupérer l'offset des paramètres POST
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
  
    // Utiliser l'offset pour calculer le nombre de photos à sauter
    $posts_per_page = 8;
    $offset_posts = $offset + $posts_per_page;
  
    // Arguments de requête pour charger les photos suivantes
    $args = array(
      'post_type' => 'photos',
      'posts_per_page' => $posts_per_page,
      'offset' => $offset_posts
    );
  
    // Effectuer la requête
    $query = new WP_Query($args);
  
    // Boucle pour afficher les photos supplémentaires
    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $thumbnail_url = get_the_post_thumbnail_url();
        $title = get_the_title();
        $permalink = get_permalink();
        ?>
        <div class="photo-overlay">
          <a href="<?php echo $permalink; ?>" class="lightbox">
            <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $title; ?>">
          </a>
        </div>
        <?php
      }
    }
  
    wp_reset_postdata();
  
    // Vérifier si le nombre total de photos atteint
    $total_photos = $offset + $query->post_count;
    if ($total_photos >= 16) {
      wp_send_json(''); // Envoyer une réponse vide
    }
  
    wp_die();
  }
  
  add_action('wp_ajax_load_more_photos', 'load_more_photos_ajax_handler');
  add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos_ajax_handler');
  

add_action('wp_ajax_filter_photos', 'filter_photos_ajax_handler');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_ajax_handler');







