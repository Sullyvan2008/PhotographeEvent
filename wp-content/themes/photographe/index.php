<?php get_header(); ?>

<!-- Contenu principal -->
<main id="main-content">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class(); ?>>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php the_content(); ?>
    </article>
  <?php endwhile; else : ?>
    <p>Aucun contenu à afficher.</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
