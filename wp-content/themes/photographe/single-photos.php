<?php
get_header();

while (have_posts()) {
    the_post();

    // Affichage du contenu de l'article

    if (has_post_thumbnail()) {
        echo '<div class="single-photo">';
        echo '<div class="taxonomy-info">';

        // Affichage du titre du post
        echo '<h1 class="post-title">' . get_the_title() . '</h1>';

        // Récupérer les termes de taxonomie pour l'article actuel
        $taxonomy_terms = wp_get_post_terms(get_the_ID(), array('categorie', 'format', 'annee'));

        foreach ($taxonomy_terms as $term) {
            echo '<h2 class="taxonomy-title">' . get_taxonomy($term->taxonomy)->labels->singular_name . ': ' . $term->name . '</h2>';
        }


        // Affichage des champs ACF
        $reference = get_post_meta(get_the_ID(), 'reference', true);
        $type = get_post_meta(get_the_ID(), 'type', true);

        if ($reference || $type) {
            echo '<div class="acf-info">';

            if ($reference) {
                echo '<h2 class="acf-item">' . __('Référence: ', 'photographe') . $reference . '</h2>';
            }

            if ($type) {
                echo '<h2 class="acf-item">' . __('Type: ', 'photographe') . $type . '</h2>';
            }

            echo '</div>'; // Fermeture de la div "acf-info"
        }
        

        echo '</div>'; // Fermeture de la div "single-photo"
        
// Affichage de la photo

        echo '<div class="post-thumbnail">';
        the_post_thumbnail();
        // Navigation vers les articles précédent/suivant
        $previous_post = get_previous_post();
        $next_post = get_next_post();



        echo '</div>';
        echo '</div>';
    }

    // ...
}


// Code de la section "Vous aimerez aussi"
echo '<div class="contact-navigation">';

?>
<div class="photo-interest">
    <p>Cette photo vous intéresse ?</p>
    <button id="myContactBtn">Contact</button>

</div>
<div class="post-navigation">

<?php if ($next_post) : ?>
        <a href="<?php echo get_permalink($next_post->ID); ?>" class="next-post-thumbnail">
            <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail'); ?>
            
        </a>
    <?php endif; ?>
    <div class="post-navigation-arrows">
    <?php if ($previous_post) : ?>
        <a href="<?php echo get_permalink($previous_post->ID); ?>" class="previous-post">
            <span class="icon-arrow-left"></span>
        </a>
    <?php endif; ?>

    <?php if ($next_post) : ?>
        <a href="<?php echo get_permalink($next_post->ID); ?>" class="next-post">
            
            <span class="icon-arrow-right"></span>
        </a>
    <?php endif; ?>
</div>
    </div>
<?php
        echo '</div>';
        echo '</div>';
?>

<!-- Code de la section "Vous aimerez aussi" -->
<div class="related-posts">
    <h3>Vous aimerez aussi</h3>

    <?php
    // Récupérer les articles recommandés
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 2, // Nombre d'articles recommandés à afficher
        'orderby' => 'rand', // Ordonner de manière aléatoire
        'post__not_in' => array(get_the_ID()) // Exclure l'article actuel
    );
    $query = new WP_Query($args);

    // Afficher les miniatures des articles recommandés
    if ($query->have_posts()) {
        ?>
        <div class="related-posts-thumbnails">
        <?php
        while ($query->have_posts()) {
            $query->the_post();
            ?>

            <div class="related-post">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            </div>

            <?php
        }
        ?>
        </div> <!-- Fermeture de la div "related-posts-thumbnails" -->
        <?php
        wp_reset_postdata();
    }
    ?>
</div> <!-- Fermeture de la div "related-posts" -->

<div class="more-photos">
    <a href="#" class="more-photos-button">Voir plus de photos</a>
</div>


<?php get_footer();
?>