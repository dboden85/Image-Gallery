<?php

function db_gallery_shortcode(){


    $gallery_data = get_option('g_data', '');
    $title_status = get_option('show-title');
    $desc_status = get_option('show-desc');
    $show_title = 'false';
    $show_desc = 'false';

    if($title_status == 'yes'){
        $show_title = 'true';
    }

    if($desc_status == 'yes'){
        $show_desc = 'true';
    }

?>

    <?php

    $gallery_html = '';

    ob_start();

    ?>

    <?php 
    
    if( empty($gallery_data) ){
        echo '<p style="text-align: center;">Gallery Images will appear here</p>';
    }

    ?>

    <div class="gallery-wrapper">

    <?php

    if( is_array($gallery_data) ){

        forEach($gallery_data as $image){
    
        $image_data = (array) json_decode( stripslashes( $image ) )[0];
            echo '<div class="gallery-image" data-imageid="' . $image_data['id'] . '" style="background-image: url(' . wp_get_attachment_image_url( $image_data['id'], 'thumb', false, '' ) . ');"></div>';
        }
       
    }

    ?>

    </div>

    <script>
        const imgObj = {

            <?php



            if( is_array($gallery_data) ){
                ?>

                showTitle : <?php echo $show_title ?>,
                
                showDescription : <?php echo $show_desc ?>,

                <?php

                forEach($gallery_data as $image){
    
                $image_data = (array) json_decode( stripslashes( $image ) )[0];

                ?>


                
                <?php echo $image_data['id'] . ' '; ?> : { url : "<?php echo wp_get_attachment_image_url( $image_data['id'], 'full' ); ?>", title : "<?php echo $image_data['title']; ?>", desciption :  "<?php echo $image_data['desc']; ?>"},

                <?php
                    
                }

            }

            ?>

        }

    </script>

    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}
add_shortcode('gallery', 'db_gallery_shortcode');



