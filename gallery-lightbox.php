<?php

function add_gallery_light_box(){
    ob_start();
    ?>

    <div id="light-box-modal">
        

        <div class="previous-image">
            <
        </div>

        <div class="light-box-image-container">
            
            <p class="gallery-img-title">Test Title</p>

            <div class="lightbox-img"></div>

            <p class="gallery-img-description">Test Description</p>

        </div>

        <div class="next-image">
            >
        </div>

        <p class="close-lightbox">Close</p>
        
    </div>

    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}
add_action( 'wp_footer', 'add_gallery_light_box');