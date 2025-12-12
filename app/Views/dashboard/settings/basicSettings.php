<div class="setting-box-container">
    <form id="basicSettingsForm">
        <div class="row">
            <div class="col-md-4">
                <div class="label-side">
                    <h4>
                        Your Shop Details
                    </h4>
                    <p>
                        Update your shop's name, logo, address, contact information, and other essential details to ensure accurate records and smooth operations.
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-side">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="store_name">
                                            Your Shop Name
                                            <div class="more-info">
                                                <i class="mdi mdi-information-outline"></i>
                                                <div class="more-info-text">
                                                    This name will be displayed on all your invoices and receipts.
                                                </div>
                                            </div>
                                        </label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" id="store_name" placeholder="Enter Your Shop Name" 
                                                name="store_name" 
                                                value="<?= esc($settings['store_name'] ?? '') ?>" 
                                                class="form-control w-60 mr-3" 
                                                autofocus="on" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="store_phone">
                                            Contact Number (Mobile/Phone)
                                            <div class="more-info">
                                                <i class="mdi mdi-information-outline"></i>
                                                <div class="more-info-text">
                                                    This Mobile Number will appear on your invoices and receipts. Make sure to include your country code if applicable.
                                                </div>
                                            </div>
                                        </label>
                                        <input type="text" placeholder="+94 76 000 0000" 
                                            id="store_phone" 
                                            name="store_phone" 
                                            value="<?= esc($settings['store_phone'] ?? '') ?>" 
                                            class="form-control" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label" for="store_lanphone">
                                            Contact Number (Fixed/Landline)
                                            <div class="more-info">
                                                <i class="mdi mdi-information-outline"></i>
                                                <div class="more-info-text">
                                                    This phone number also will appear on your invoices and receipts.
                                                </div>
                                            </div>
                                        </label>
                                        <input type="text" placeholder="+94 11 000 0000" 
                                            id="store_lanphone" 
                                            name="store_lanphone" 
                                            value="<?= esc($settings['store_lanphone'] ?? '') ?>" 
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="shop_registration_number">
                                            Your Shop Registration Number
                                            <div class="more-info">
                                                <i class="mdi mdi-information-outline"></i>
                                                <div class="more-info-text">
                                                    This registration number will appear on your invoices and receipts.
                                                </div>
                                            </div>
                                        </label>
                                        <input type="text" id="shop_registration_number" 
                                            name="shop_registration_number" 
                                            value="<?= esc($settings['shop_registration_number'] ?? '') ?>" 
                                            class="form-control" placeholder="Enter Your Shop Registration Number">    
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label" for="store_email">
                                            Your Shop Email
                                            <div class="more-info">
                                                <i class="mdi mdi-information-outline"></i>
                                                <div class="more-info-text">
                                                    This email address will be displayed on your invoices and receipts.
                                                </div>
                                            </div>
                                        </label>
                                        <input type="email" id="store_email" 
                                            name="store_email" 
                                            value="<?= esc($settings['store_email'] ?? '') ?>" 
                                            class="form-control" placeholder="Enter Your Shop Email" required>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="store_address">
                                            Your Shop Address
                                            <div class="more-info">
                                                <i class="mdi mdi-information-outline"></i>
                                                <div class="more-info-text">
                                                    This address will be displayed on your invoices and receipts.
                                                </div>
                                            </div>
                                        </label>
                                        <textarea id="store_address" 
                                                name="store_address" 
                                                class="form-control" 
                                                rows="3" 
                                                placeholder="Enter Your Shop Address" 
                                                required><?= esc($settings['store_address'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Your Shop Logo
                                    <div class="more-info">
                                                <i class="mdi mdi-information-outline"></i>
                                                <div class="more-info-text">
                                                    This Logo will be displayed on your invoices,receipts and your system (if you want).
                                                </div>
                                            </div>
                                </label>
                                <div class="box-wrapper">
                                    <?php if (!empty($settings['shop_logo'])) : ?><div class="remove_img_button"><i class="bi bi-x-lg"></i></div><?php endif; ?>
                                    <div id="logoPreviewContainer" class="image_preview_box_large mb-2" 
                                    style="background-image: <?= isset($settings['shop_logo']) ? 'url(' . base_url('uploads/' . $settings['shop_logo']) . ')' : 'none' ?>;">
                                    <?php if (empty($settings['shop_logo'])) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image d-block">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                </div>

                                <input type="file" id="logoInput" accept="image/*" hidden>
                                <button type="button" class="logo_upload_btn" id="uploadLogoBtn"><i class="bi bi-upload"></i> Upload</button>
                            </div>
                        </div>       
                        <!-- Image Cropper Modal -->
                        <div class="modal fade" id="cropModal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Crop Your Logo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="img-container" style="max-height: 400px;">
                                    <img id="cropImage" src="" style="max-width: 100%;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="cropSaveBtn" class="btn btn-success">Save</button>
                                </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="label-side">
                    <h4>
                        System Preferances
                    </h4>
                    <p>
                        Customize your application settings to match your workflow. Adjust display options, language, notifications, security preferences, and more to optimize your experience.
                    </p>
                </div>
            </div>
            <div class="col-sm-8">
                 <div class="row mt-3">
                    <div class="col-sm-12">
                        <label class="form-label" for="store_address">
                            System Language
                            <div class="more-info">
                                <i class="mdi mdi-information-outline"></i>
                                <div class="more-info-text">
                                    This language will be used across the system interface, including menus, buttons, and notifications.
                                </div>
                                
                            </div>
                        </label>
                       <div class="select width-20">
                            <select class="w-60 mr-3" name="system_lang" id="system_lang">
                                <option value="en" selected>English</option>
                                <option value="si">Sinhala</option>
                                <option value="ta">Tamil</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="msg"></div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
let cropper;

// Open file chooser
$('#uploadLogoBtn').on('click', function() {
  $('#logoInput').click();
});

// When file selected
$('#logoInput').on('change', function(event) {
  const file = event.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function(e) {
    $('#cropImage').attr('src', e.target.result);

    // Wait until modal is fully shown
    $('#cropModal').modal('show');

    // Wait until image is visible before initializing Cropper
    $('#cropModal').on('shown.bs.modal', function() {
      const image = document.getElementById('cropImage');

      // Important: destroy any previous instance
      if (cropper) cropper.destroy();

      cropper = new Cropper(image, {
        aspectRatio: 830 / 300,
        viewMode: 1,
        responsive: true,
        background: false,
        autoCropArea: 1,
      });
    });
  };
  reader.readAsDataURL(file);
});

// When modal hides, destroy cropper
$('#cropModal').on('hidden.bs.modal', function() {
  if (cropper) {
    cropper.destroy();
    cropper = null;
  }
});

// Save cropped image
$('#cropSaveBtn').on('click', function() {
  if (!cropper) return;
  cropper.getCroppedCanvas({
    width: 830,
    height: 300
  }).toBlob(function(blob) {
    uploadCroppedImage(blob);
    $('#cropModal').modal('hide');
  });
});

function uploadCroppedImage(blob) {
  let formData = new FormData();
  formData.append('shop_logo', blob, 'logo.png');

  $.ajax({
    url: "<?= site_url('settings/update') ?>",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $('#logoPreviewContainer').css('background-image', 'url(' + response.new_logo_url + ')');
        showFlashMessage( 'success','Logo updated successfully!');
        location.reload();
      } else {
        showPopup(response.message, 'error');
      }
    },
    error: function() {
      showPopup('Upload failed.', 'error');
    }
  });
}

function showPopup(message, type) {
  const popup = $('<div>')
    .addClass('popup-msg ' + type)
    .text(message)
    .appendTo('body');
  setTimeout(() => popup.fadeOut(500, () => popup.remove()), 2000);
}

$('.remove_img_button').on('click', function() {
    if (confirm('Are you sure you want to remove the logo?')) {
        $.ajax({
            url: "<?= site_url('settings/removeLogo') ?>",
            type: "POST",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                     showFlashMessage('success',response.message);
                    $('#logoPreviewContainer').css('background-image', 'none');
                    $('.remove_img_button').addClass('d-none');
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Failed to remove logo. Please try again.');
            }
        });
    }
});

</script>


<script>
let timer;

$('#basicSettingsForm input').on('input', function() {
    clearTimeout(timer);

    // Wait 1.5 seconds after user stops typing
    timer = setTimeout(function() {
        autoUpdate();
    }, 1500);
});

function autoUpdate() {
    $.ajax({
        url: "<?= site_url('settings/update') ?>",
        type: "POST",
        data: new FormData($('#basicSettingsForm')[0]),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(response) {
            if (response.success) {
                showFlashMessage('success', response.message );
            } else {
                showFlashMessage('error', response.message );
            }
        },
        error: function() {
            showFlashMessage('error', 'Auto save is faild');
        }
    });
}
</script>