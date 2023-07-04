

<?php
/*
Template Name: Page d'accueil
*/

get_header();
?>

<?php
// Récupérer un post Photographe aléatoire avec la photo originale
$args = array(
    'post_type' => 'photos',
    'posts_per_page' => 1, // Récupérer un seul post
    'orderby' => 'rand' // Ordonner de manière aléatoire
);
$query = new WP_Query($args);

// Vérifier si un post est trouvé
if ($query->have_posts()) {
    $query->the_post();
    // Récupérer l'ID de la photo originale
    $photo_id = get_post_thumbnail_id(get_the_ID());

    // Vérifier si l'ID de la photo est disponible
    if ($photo_id) {
        // Récupérer l'URL de la photo originale
        $photo_url = wp_get_attachment_image_src($photo_id, 'full')[0];

        // Afficher la photo originale dans le hero
        if ($photo_url) {
            echo '<div class="hero-photo" style="background-image: url(' . $photo_url . ')">';
            echo '<h1 class="hero-title">PHOTOGRAPHE EVENT</h1>';
            echo '</div>';
        }
    }
}

// Réinitialiser les données de la requête principale
wp_reset_postdata();
?>

<?php

// Récupérer les formats
$formats = get_terms(array(
    'taxonomy' => 'format',
    'hide_empty' => true,
));

// Récupérer les catégories
$categories = get_terms(array(
    'taxonomy' => 'categorie',
    'hide_empty' => true,
));

?>

<div class="filters-container">
  <form action="" method="GET" class="filter-form" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>">
    <div class="filter-dropdown">
      <label for="categorie-filter">Filtrer par catégorie:</label>
      <select name="categorie" id="categorie-filter">
        <option value="">Toutes les catégories</option>
        <?php foreach ($categories as $categorie) : ?>
          <option value="<?php echo $categorie->slug; ?>"><?php echo $categorie->name; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="filter-dropdown">
      <label for="format-filter">Filtrer par format:</label>
      <select name="format" id="format-filter">
        <option value="">Tous les formats</option>
        <?php foreach ($formats as $format) : ?>
          <option value="<?php echo $format->slug; ?>"><?php echo $format->name; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </form>
</div>

<div class="photo-grid">
  <?php
  $args = array(
    'post_type' => 'photos',
    'posts_per_page' => 8 // Afficher 8 photos par défaut
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      // Récupérer les informations de la photo
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
    echo 'Aucune photo trouvée.';
  }

  wp_reset_postdata();
  ?>
</div>

<div class="load-more-button">
  <button>Charger plus</button>
</div>


<?php get_footer(); ?>

