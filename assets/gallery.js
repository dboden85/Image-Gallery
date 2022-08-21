jQuery(function($){ 

    if( imgObj['showTitle'] == true ){
        $('.gallery-img-title').css('display', 'block');
    }

    if( imgObj['showDescription'] == true ){
        $('.gallery-img-description').css('display', 'block');
    }

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

        addImgToLightBox( imgObj[imageID]['url'], imgObj[imageID]['title'], imgObj[imageID]['desciption'] );

    }

    function addImgToLightBox(image, title, desc){
        $('#light-box-modal').addClass('open');

        let galleryImg = document.createElement('img');
        galleryImg.setAttribute('src', image);

        $('.lightbox-img').append(galleryImg);
        $('.gallery-img-title').text(title);
        $('.gallery-img-description').text(desc);
    }

    $('.close-lightbox').click(()=>{
        $('#light-box-modal').removeClass('open');
    })

    function nextImage(){

        $('.lightbox-img img').remove();

        if(galleryIndex === $('.gallery-image').length - 1){
            galleryIndex = 0;
        }else{
            galleryIndex++;
        }

        getImage(galleryIndex);
    }

    function previousImage(){

        $('.lightbox-img img').remove();
        
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