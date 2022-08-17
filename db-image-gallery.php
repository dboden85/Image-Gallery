<?php
/**
 * Plugin Name: DB Websites Image Gallery
 * Author: David Boden
 * Description: A simple gallery plugin.
 * Author URI: https://www.db-wesites.com
 */

 require plugin_dir_path( __FILE__ ) . '/db-gallery-shortcode.php';
 require plugin_dir_path( __FILE__ ) . '/gallery-lightbox.php';
 require plugin_dir_path( __FILE__ ) . '/get-gallery-img.php';


function db_image_gallery_options_page() {

    add_menu_page(
        'Image Gallery',
        'DB Image Gallery',
        'manage_options',
        'db-image-gallery.php',
        'db_image_gallery_html',
        '',
        20
    );

}
add_action( 'admin_menu', 'db_image_gallery_options_page' );

//enqueue gallery styles and scripts for admin
function db_image_gallery_styles() {

    wp_enqueue_media();

    wp_enqueue_style('db-gallery-css', plugins_url( '/db-image-gallery.css', __FILE__ ));

    wp_enqueue_script('db-gallery-script', plugins_url( '/db-image-gallery.js', __FILE__ ), array( 'jquery' ),'', false );

}
add_action( 'admin_enqueue_scripts', 'db_image_gallery_styles', 10 );


//add styles and scripts for front-end gallery page.
function db_image_gallery_page_styles() {

    wp_enqueue_style('db-gallery-page-css', plugins_url( '/assets/gallery.css', __FILE__ ));
    wp_enqueue_script('db-gallery-page-script', plugins_url( '/assets/gallery.js', __FILE__ ), array( 'jquery' ),'', false );

}
add_action( 'wp_enqueue_scripts', 'db_image_gallery_page_styles', 10 );




function db_image_gallery_html(){

    $update_status = '';

    if(array_key_exists('submit', $_POST))
    {
        if( isset( $_POST['data'] ) ){
            update_option('g_data', $_POST['data']);
        }else{
            update_option('g_data', '');
        }
        

        $update_status = '<div class="update-status success"> Update Successful </div>';

    }

    $gallery_data = get_option('g_data', '');

    ?>

    <h1 class="db-gallery-title">DB Image Gallery</h1>
    
    <?php echo $update_status; ?>

    <div class="wrap db-image-gallery-container">
        
        <h2>Gallery</h2>
        <button class="add-image button button-primary">Add Image</button>

        <form method="post" action="">
            <div class="gallery">
                
                <?php

                if(is_array($gallery_data)){

                    forEach($gallery_data as $image){
                        
                        $image_data = (array) json_decode( stripslashes( $image ) )[0];
                        $image = esc_attr( stripcslashes($image) );

                ?>

                        <div class="gallery-item" data-id="<?php echo $image_data['id'] ?>" draggable="true">
                            <div class="gallery-img-container" style="background-image: url(<?php echo wp_get_attachment_image_url( $image_data['id'], 'admin-gallery' ); ?>);"></div>
                            <input type="hidden" id="hidden" value="<?php print_r($image); ?>" name="data[]" />
                            <button class="remove-image button button-primary" data-id="<?php echo $image_data['id'] ?>">Remove Image</button>
                        </div>

                <?php

                    }

                }
                
                ?>

            </div>
            
            <?php submit_button(); ?>

        </form>
       
</div>

    <?php
    
}