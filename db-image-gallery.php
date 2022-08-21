<?php
/**
 * Plugin Name: DB Websites Image Gallery
 * Author: David Boden
 * Description: A simple gallery plugin.
 * Author URI: https://www.db-wesites.com
 * Version: 1.0
 */

 require plugin_dir_path( __FILE__ ) . '/db-gallery-shortcode.php';
 require plugin_dir_path( __FILE__ ) . '/gallery-lightbox.php';
//  require plugin_dir_path( __FILE__ ) . '/db-gallery-settings.php';


function db_image_gallery_options_page() {

    add_menu_page(
        'Image Gallery',
        'DB Image Gallery',
        'manage_options',
        'db-image-gallery.php',
        'db_image_gallery_html',
        '',
        2
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
            update_option( 'g_data', $_POST['data'] );
            update_option( 'show-title', $_POST['show-title'] );
            update_option( 'show-desc', $_POST['show-desc'] );
        }else{
            update_option('g_data', '');
        }
        

        $update_status = '<div class="update-status success"> Update Successful </div>';

    }

    $gallery_data = get_option('g_data', '');
    $title_status = get_option('show-title');
    $desc_status = get_option('show-desc');

    ?>

    <h1 class="db-gallery-title">DB Image Gallery</h1>
    
    <?php echo $update_status; ?>

    <div class="wrap db-image-gallery-container">
        
        <h2>Gallery</h2>

        <form method="post" action="">
            <div class="button-container">

                <a id="add-image" class="db-button">Add Image</a>

                <input type="submit" name="submit" class="db-button" value="Save Changes" />

                <label for="shot-title">Show Title</label>

                <select name="show-title">
                    <option value="yes" <?php if( $title_status == 'yes' ){ echo 'selected'; } ?> >Yes</option>
                    <option value="no" <?php if( $title_status == 'no' ){ echo 'selected'; } ?> >No</option>
                </select>

                <label for="shot-desc">Show Description</label>

                <select name="show-desc">
                    <option value="yes" <?php if( $desc_status == 'yes' ){ echo 'selected'; } ?> >Yes</option>
                    <option value="no" <?php if( $desc_status == 'no' ){ echo 'selected'; } ?>>No</option>
                </select>

            </div>
            <div class="gallery">
                
                <?php

                if(is_array($gallery_data)){

                    forEach($gallery_data as $image){
                        
                        $image_data = (array) json_decode( stripslashes( $image ) )[0];
                        $image = esc_attr( stripcslashes($image) );

                ?>

                        <div class="gallery-item" data-id="<?php echo $image_data['id'] ?>" draggable="true">
                            <div class="gallery-img-container" style="background-image: url(<?php echo wp_get_attachment_image_url( $image_data['id'], 'thumb' ); ?>);"></div>
                            <input type="hidden" id="hidden" value="<?php print_r($image); ?>" name="data[]" />
                            <button class="remove-image button button-primary" data-id="<?php echo $image_data['id'] ?>">Remove Image</button>
                        </div>

                <?php

                    }

                }else{
                    echo '<p class="no-images"> Images will appear here! </p>';
                }
                
                ?>

            </div>
            
            

        </form>
       
</div>

    <?php
    
}