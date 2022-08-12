<?php

function add_gallery_light_box(){
    ob_start();
    ?>

    <div id="light-box-modal">
        <div class="light-box-image-container">
            <img class="lightbox-img" alt="">
            <p class="close-lightbox">Close</p>
        </div>
    </div>

    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}
add_action( 'wp_footer', 'add_gallery_light_box');