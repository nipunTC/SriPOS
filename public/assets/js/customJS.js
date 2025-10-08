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


function showFlashMessage(type, message) {
    let progress = 0;
    let interval = 80; // 80ms interval for 8 seconds total
    setTimeout(() => {
    const progressBar = document.querySelector('#flash-message .progress-bar');
    let progress = 0;
    const interval = 100; // milliseconds

    if (progressBar) {
      const timer = setInterval(() => {
        // Reset progress if user is hovering
        if ($('#flash-message').is(':hover')) {
          progress = 0;
        } else {
          progress += (100 / (8000 / interval)); // 8 seconds total
          progressBar.style.width = `${progress}%`;
        }

        // When progress completes
        if (progress >= 100) {
          clearInterval(timer);
          $('#flash-message').fadeOut(400, function () {
            $(this).remove();
          });
        }
      }, interval);
    }
  }, 6000); // Start after 6 seconds

  let bg = type === 'success' ? 'bg-success' : 'bg-danger';
  $('#flash-message').remove();
  $('body').append(`
    <div id="flash-message" class="alert ${bg} spos-alert fade-in-right" style="z-index:1050;">
      <!-- time with filling bar -->
      <div class="progress-bar"></div>
      <div class="icon">
        <h5><i class="mdi ${type === 'success' ? 'mdi-check-circle' : 'mdi-alert-circle'}"></i> </h5>
      </div>
      <div class="message-body">
        ${message}
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-lg"></i></button>
    </div>
  `);
}


// products add form submit
$(document).ready(function() {

    // enable/disable exp date field
    $('#enable_exp_date').on('change', function() {
        $('#exp_date').prop('disabled', !this.checked);
    });

    // handle form submit Products add
    $("#add_products").on("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),   // your CI4 route: products/store
            type: "POST",
            data: formData,
            processData: false,  // prevent jQuery from processing data
            contentType: false,  // prevent jQuery from setting content type
            dataType: "json",
            beforeSend: function() {
                // you can show loading spinner here
                console.log("Uploading...");
            },
            success: function(response) {
                if(response.success) {
                    // reset form
                    $("#add_products")[0].reset();
                    $("#exp_date").prop("disabled", true);
                    $(".image_preview_box img").remove(); // clear preview if you use it
                    $("#product_image").val(""); 
                    $(".image_preview_box").css("background-image", "none").removeClass("has-image");
                    $(".image_preview_box svg").removeClass("d-none").addClass("d-block");
                    // show success message
                    showFlashMessage('success', response.message);
                } else {
                    showFlashMessage('error', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                showFlashMessage('error', 'Something went wrong while saving the product.');
            }
        });
    });

    

    
    // Initialize DataTable with table column sorting part
   new DataTable('#product_table', {
        responsive: true,
        searching: false,
        paging: false,
        info: false,
        ordering: true,
        shorting: true,
        order: [[0, 'asc']] // Default sorting on the first column (ID)
    });

    // product 
    // change text on page per page select box
    // hide the default text
    $('.dt-length label').contents().filter(function() {
        return this.nodeType === 3; // Node.TEXT_NODE
    }).remove();
    // search input placeholder add
    $('.dt-search input').attr('placeholder', 'Search...');

    // date and time displayer
    function updateDateTime() {
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
        const dateStr = now.toLocaleDateString(undefined, options);
        const timeStr = now.toLocaleTimeString();
        $('#date').text(`${dateStr}`);
        $('#time').text(timeStr);
    }

    // Update date and time every second
    setInterval(updateDateTime, 1000);
    updateDateTime(); // Initial call to display immediately
});



  
function showDeleteModal(productId) {
    $('#deleteProductModal').modal('show');
    // product id set to hidden input field
    var productID = productId;
    $('#deleteProductForm #product_id').val(productID);
  }


  
