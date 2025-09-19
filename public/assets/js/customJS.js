// product image preview
function previewImage(event) {
    const file = event.target.files[0];
    const box = $('.image_preview_box');
    const input = $('#product_image_upload');

    if (!file) return;

    // file size validation
    if (file.size > 1 * 1024 * 1024) { // 1MB
        alert("File size exceeds 1MB. Please choose a smaller file.");
        input.val(''); // reset input
        return;
    }

    // show preview
    box.css({
        'background-image': `url(${URL.createObjectURL(file)})`,
        'background-size': 'cover',
        'background-position': 'center'
    }).addClass('has-image');

    // hide the SVG
    box.find('svg').addClass('d-none');
    // if file box has image, remove svg icon
    if (box.hasClass('has-image')) {
        box.find('svg').removeClass('d-block').addClass('d-none');
    }else{
        box.find('svg').removeClass('d-none').addClass('d-block');
    }
}

// remove icon click
$(document).on('click', 'i.remove-icon', function(e) {
    e.stopPropagation(); // ✅ stop click bubbling
    e.preventDefault();  // ✅ extra safety: stop label from triggering input

    const box = $(this).closest('.image_preview_box');
    const input = $('#product_image_upload');

    // reset preview
    box.css('background-image', 'none').removeClass('has-image');

    // clear file input
    input.val('');

    // show SVG back
    box.find('svg').removeClass('d-none').addClass('d-block');
});

 // Toggle date input based on checkbox
    $('#enable_exp_date').change(function(){
        if($(this).is(':checked')){
            $('#exp_date').prop('disabled', false); // Enable input
        } else {
            $('#exp_date').prop('disabled', true); // Disable input
        }
    });