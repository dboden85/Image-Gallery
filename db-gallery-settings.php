<?php

function add_gallery_settings_submenu(){

    add_submenu_page( 
        'db-image-gallery.php', 
        'Image Gallery Settings', 
        'Gallery Settings', 
        'manage_options', 
        'db-image-gallery-settings', 
        'db_image_gallery_settings_html'
    );

    }

add_action('admin_menu', 'add_gallery_settings_submenu');


function db_image_gallery_settings_html(){

    ?>

    <div class="wrap">
        <p>Hello World</p>
    </div>

    <?php
}