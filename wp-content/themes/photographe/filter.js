jQuery(document).ready(function($) {
    const filterForm = $('.filter-form');
    const photoGrid = $('.photo-grid');
    const loadMoreButton = $('.load-more-button');
    let page = 1; // Numéro de page initial
  
    filterForm.on('change', function(e) {
      e.preventDefault();
      page = 1; // Réinitialiser le numéro de page lorsqu'un filtre est modifié
      loadMoreButton.show(); // Afficher le bouton "Charger plus" lorsqu'un filtre est modifié
  
      const ajaxUrl = filterForm.data('ajax-url');
      const categorieValue = $('#categorie-filter').val();
      const formatValue = $('#format-filter').val();
  
      const data = {
        action: 'filter_photos',
        categorie: categorieValue,
        format: formatValue,
        page: page // Utiliser la première page pour le filtrage initial
      };
  
      $.post(ajaxUrl, data, function(response) {
        photoGrid.html(response);
        checkLoadMoreButtonVisibility(response);
      });
    });
  
    loadMoreButton.on('click', function(e) {
      e.preventDefault();
  
      const ajaxUrl = filterForm.data('ajax-url');
      const categorieValue = $('#categorie-filter').val();
      const formatValue = $('#format-filter').val();
  
      const data = {
        action: 'load_more_photos',
        categorie: categorieValue,
        format: formatValue,
        page: page + 1 // Charger la page suivante
      };
  
      $.post(ajaxUrl, data, function(response) {
        if (response) {
          photoGrid.append(response);
          page++; // Augmenter le numéro de page après avoir chargé plus de photos
          checkLoadMoreButtonVisibility(response);
        } else {
          loadMoreButton.hide(); // Masquer le bouton "Charger plus" s'il n'y a plus de photos à charger
        }
      });
    });
  
    // Fonction pour vérifier la visibilité du bouton "Charger plus"
    function checkLoadMoreButtonVisibility(response) {
      const photoCount = $(response).find('.photo-overlay').length;
      if (photoCount === 0) {
        loadMoreButton.hide(); // Masquer le bouton "Charger plus" s'il n'y a plus de photos à charger
      }
    }
  });
  