<?php
/**
 * Template part for displaying lightbox modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Go
 */

?>      

<!-- The lightbox modal -->
<div class="lightbox">

    <!-- Modal content -->
    <div class="lightbox_content flex_row">

        <span class="lightbox_left_arrow" data-user-action="prev">
			<img src="<?php echo get_stylesheet_directory_uri().'/assets/icones/précédent.svg';?>" alt="Précédent">
		</span>

        <div class="lightbox_content_img_wrapper">

            <div class="lightbox_content_image">

                <!-- The image will be placed here -->

                <div class="lightbox_image_loading"></div>
                
            </div>

            <div class="lightbox_content_image_infos">

                <!-- The image infos will be placed here -->
                
            </div>

        </div>

        <span class="lightbox_right_arrow" data-user-action="next">
			<img src="<?php echo get_stylesheet_directory_uri().'/assets/icones/suivant.svg';?>" alt="Suivant">
		</span>
        
    </div>

    <span class="modal_close_icon dashicons dashicons-no-alt">
    <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/close.png';?>" alt="Bouton fermeture">
    </span>

</div>