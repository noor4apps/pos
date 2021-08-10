$(document).ready(function() {

    var reader = new FileReader();

    $('.image').on('change', function() {

        reader.onload = function (e) {
            $('#image-preview').css('display', 'block');
            $('#image-preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);

    })

})

/**
 * Put the class='image' on the source
 * Put the id='image-preview' on the target
 */
