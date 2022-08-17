jQuery(function($){ 

    let galleryIndex = 0;

    $('.next-image').on( 'click', e => {
        nextImage();
    } );

    $('.previous-image').on( 'click', e => {
        previousImage();
    } );

    $('.gallery-image').click(function(){

            galleryIndex = $('.gallery-image').index(this);

            

            getImage(galleryIndex);

    });

    function getImage(index){

        let imageID = $('.gallery-image')[index].dataset.imageid;

        addImgToLightBox( imgObj[imageID] );

    }

    function addImgToLightBox(img){
        $('#light-box-modal').addClass('open');
        $('.lightbox-img').attr('src', img);
    }

    $('.close-lightbox').click(()=>{
        $('#light-box-modal').removeClass('open');
    })

    function nextImage(){

        if(galleryIndex === $('.gallery-image').length - 1){
            galleryIndex = 0;
        }else{
            galleryIndex++;
        }

        getImage(galleryIndex);
    }

    function previousImage(){
        if(galleryIndex === 0){
            galleryIndex = $('.gallery-image').length - 1;
        }else{
            galleryIndex--;
        }

        getImage(galleryIndex);
    }


    $(document).keydown(function(e){

        if($('#light-box-modal').hasClass('open')){

            if (e.keyCode == 37) { 
                previousImage();
                return false;
             }
             if (e.keyCode == 39) { 
                nextImage();
                return false;
             }

             if (e.keyCode == 27) { 
                $('#light-box-modal').removeClass('open');
                return false;
             }

        }
        
    });


})