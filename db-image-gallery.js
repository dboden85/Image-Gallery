jQuery(function($){
    const removeButtons = document.querySelectorAll('.remove-image');


    //Set up image uploader
     $.galleryImgUploader = wp.media({
        title: 'Add Image to Gallery',
        button: {
            text: 'Use Image'
        },
        multiple: false

    })

    //Open image uploader
    $('.add-image').on('click', ()=>{
        if( $.galleryImgUploader ){
            $.galleryImgUploader.open();
        }
    })


    // adding images to admin page
    $.galleryImgUploader.on('select', ()=>{
        let attachment = $.galleryImgUploader.state().get('selection').first().toJSON();

        let imgUrl = attachment.url;
        let hidFieldValue = JSON.stringify( [ { id: attachment.id, url: attachment.url } ] );

        addImgToGallery(imgUrl, hidFieldValue);
    })

    function addImgToGallery(url, hidValue){

        

        let  galleryItem = document.createElement('div');
        galleryItem.setAttribute('class', 'gallery-item');

        let galleryItemImgContainer = document.createElement('div');
        galleryItemImgContainer.setAttribute('class', 'gallery-img-container');
        galleryItemImgContainer.style.backgroundImage = 'url(' + url +')';

        let hidField = document.createElement('input');
        hidField.setAttribute('type', 'hidden');
        hidField.setAttribute('id', 'hidden');
        hidField.setAttribute('value', hidValue);
        hidField.setAttribute('name', 'data[]');

        let addButton = document.createElement('button');
        addButton.setAttribute('class', 'remove-image button button-primary');
        addButton.innerText = 'Remove Image';

        galleryItem.appendChild(galleryItemImgContainer);
        galleryItem.appendChild(hidField);
        galleryItem.appendChild(addButton);

        // $('.gallery').append(galleryItem);

        if( $('.gallery-item').length > 0 ){
            $('.gallery-item')[0].parentNode.insertBefore(galleryItem, $('.gallery-item')[0]);
        }else{
            $('.gallery').append(galleryItem);
        }

        refreshRemoveButtonArray();
    }

    //Remove images from admin page

    removeButtons.forEach((btn) =>{
        btn.addEventListener('click', e => {

            e.preventDefault();

            btn.parentElement.remove();

            refreshRemoveButtonArray();
        })
    })

    function refreshRemoveButtonArray(){
        const removeButtons = document.querySelectorAll('.remove-image');
        console.log(removeButtons.length);

        removeButtons.forEach((btn) =>{
            btn.addEventListener('click', e => {
    
                e.preventDefault();
    
                btn.parentElement.remove();
    
                refreshRemoveButtonArray();
            })
        })
    }


})