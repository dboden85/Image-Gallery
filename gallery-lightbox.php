<?php

function add_gallery_light_box(){
    ob_start();
    ?>

    <div id="light-box-modal">
        <p class="gallery-img-title">Test Title</p>
        <p class="close-lightbox">Close</p>

        <div class="light-box-image-container">

            <div class="previous-image">
                <p><</p>
            </div>
            
            <img class="lightbox-img" alt="">
            <p class="gallery-img-description">Test Description</p>

            <div class="next-image">
                <p>></p>
            </div>

        </div>

        
    </div>

    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}
add_action( 'wp_footer', 'add_gallery_light_box');