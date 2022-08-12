jQuery(function($){ 

    $('.gallery-image').click(function(){

            let fd = new FormData();
            fd.append('imgId', this.dataset.imageid);

            getImage(fd);

    });

    function getImage(id){

        var submitUrl = 'get-gallery-img.php';

        $.ajax({
            type:'post',
            url:submitUrl,
            data: id,
            contentType: false,
            processData: false,
            success: function(response){ 
                get_gallery_image_callback(response); 
            }
        });

    }

    function get_gallery_image_callback(resp){

        let jdata = JSON.parse(resp);

        if(jdata.success){

            $('#light-box-modal').addClass('open');

            addImgToLightBox(jdata.image);

        }else{
            errorMessage(jdata.message);
        }

    }

    function addImgToLightBox(img){
        $('.lightbox-img').attr('src', img);
    }



    $('.close-lightbox').click(()=>{
        $('#light-box-modal').removeClass('open');
    })



})