<?php

function db_gallery_shortcode(){


    $gallery_data = get_option('g_data', '');
?>

    <?php

    $gallery_html = '';

    ob_start();
    ?>
    <div class="gallery-wrapper">
    <?php
    if(is_array($gallery_data)){

        forEach($gallery_data as $image){
    
        $image_data = (array) json_decode( stripslashes( $image ) )[0];
            echo '<div class="gallery-image" data-imageid="' . $image_data['id'] . '" style="background-image: url(' . wp_get_attachment_image_url( $image_data['id'], 'full', false, '' ) . ');"></div>';
        }
       
    }
    ?>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
?>
    <?php
}
add_shortcode('gallery', 'db_gallery_shortcode');



