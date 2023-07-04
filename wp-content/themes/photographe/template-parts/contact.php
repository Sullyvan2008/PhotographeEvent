<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="title-modale">
    <img class="title-contact"
     src="http://localhost:8888/PhotographeEvent/wp-content/uploads/2023/06/Group-23.png"
     alt="Titre contact">
    </div>
    <div class="contact-form">
      <?php echo do_shortcode('[contact-form-7 id="26" title="Contact form 1"]'); ?>
    </div>
  </div>
</div>


<script>
jQuery(document).ready(function($) {
    // Au clic sur le bouton Contact
    $('#myContactBtn').click(function() {
        // Récupérer la référence de la photo de la page active
        var reference = '<?php echo get_post_meta(get_the_ID(), "reference", true); ?>';

        // Remplir le champ Réf photo dans la modale avec la référence
        $('#ref-photo-input').val(reference);

        // Ouvrir la modale
        $('#myModal').show();
    });
});

</script>
