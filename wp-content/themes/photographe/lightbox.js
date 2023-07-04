jQuery(document).ready(function($) {
    // Fonction pour ouvrir la lightbox
    function openLightbox(imagePath, postTitle, postTerm, postDate) {
      $('.lightbox_content_image').html('<img src="' + imagePath + '" alt="' + postTitle + '">');
      $('.lightbox_content_image_infos').html('<p>' + postTitle + '</p><p>' + postTerm + '</p><p>' + postDate + '</p>');
      $('.lightbox').fadeIn();
    }
  
    // Capturer le clic sur les éléments avec la classe "lightbox_open"
    $(document).on('click', '.lightbox_open', function(e) {
      e.preventDefault();
      
      // Récupérer les informations sur l'image
      var postTitle = $(this).data('post-title');
      var postDate = $(this).data('post-date');
      var postTerm = $(this).data('post-term');
      var imagePath = $(this).data('image-path');
  
      // Ouvrir la lightbox avec les informations de l'image
      openLightbox(imagePath, postTitle, postTerm, postDate);
    });
  
    // Gérer la navigation dans la lightbox avec les flèches gauche et droite
    $(document).on('click', '.lightbox_left_arrow, .lightbox_right_arrow', function(e) {
      e.preventDefault();
  
      var currentImage = $('.lightbox_content_image img');
      var currentIndex = currentImage.index();
      var images = $('.lightbox_open');
      var numImages = images.length;
  
      // Vérifier si la flèche gauche a été cliquée
      if ($(this).hasClass('lightbox_left_arrow')) {
        currentIndex = (currentIndex - 1 + numImages) % numImages;
      }
      // Sinon, la flèche droite a été cliquée
      else {
        currentIndex = (currentIndex + 1) % numImages;
      }
  
      var selectedImage = images.eq(currentIndex);
      var imagePath = selectedImage.data('image-path');
      var postTitle = selectedImage.data('post-title');
      var postTerm = selectedImage.data('post-term');
      var postDate = selectedImage.data('post-date');
  
      // Mettre à jour l'affichage de la lightbox avec l'image sélectionnée
      openLightbox(imagePath, postTitle, postTerm, postDate);
    });
  
    // Fermer la lightbox lors du clic sur l'icône de fermeture
    $(document).on('click', '.modal_close_icon', function() {
      $('.lightbox').fadeOut();
    });
  });
  