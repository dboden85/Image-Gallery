<?php

if( isset( $_POST['imgId'] ) ){

    $image_id = $_POST['imgId'];

    $galleryImage = wp_get_attachment_image_url( $image_id, 'full', false );

    $return = ['success' => 1, 'image' => $galleryImage];

    echo json_encode($return);

    die();

}