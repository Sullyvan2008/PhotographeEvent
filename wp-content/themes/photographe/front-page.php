

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




<div class="photo-grid">
    <?php
    $args = array(
        'post_type' => 'photos', // Remplacez par le nom du post type que vous utilisez
        'posts_per_page' => -1 // Récupère tous les posts
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="photo">
            <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            </div>
            <?php
        }
    }
    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>

