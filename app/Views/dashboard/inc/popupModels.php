<!-- Category Add Modal -->
<div class="modal blured-popup fade" id="addCategoryModelPopup" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-container p-4">
        <div class="close-popup" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></div>
        <h4 class="section-title">Add New Category</h4>

        <form id="addCategoryForm">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label for="category_name" class="form-label">Category Name <span class="input_requred">*</span></label>
            <input type="text" id="category_name" name="category_name" class="form-control" required>
            <small class="errors_display text-danger"></small>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="category_description" class="form-control" rows="3"></textarea>
          </div>

          <button type="submit" class="btn btn-primary">
            <i class="mdi mdi-content-save"></i> Save
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Product Update Modal -->
<div class="modal fade" id="updateProductPopup" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-gray-900 text-white">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Product</h1>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="updateProductForm" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" id="product_id"  name="product_id">
          <!-- Image Upload -->
          <div class="mb-4">

            <label for="product_image_upload" class="form-label"></label>
            <div class="image-upload-button text-center">
              <input type="file" id="product_image_upload" name="product_image" accept="image/*" onchange="previewImage(event)" hidden>
              <input type="hidden" name="existing_image" id="existing_image">
              <label for="product_image_upload" class="d-block">
                <span id="image_preview" class="image_preview_box">
                  <i class="bi bi-trash-fill remove-icon"></i>
                  <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="var(--primary)">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 20H4V6h9V4H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-9h-2v9zm-7.79-3.17l-1.96-2.36L5.5 18h11l-3.54-4.71zM20 4V1h-2v3h-3v2h3v3h2V6h3V4h-3z" />
                  </svg>
                </span>
              </label>
             <div class="label-tag">
                 Product Image
                <p><small>Maximum size is 1Mb</small></p>
              </div> 
            </div>
          </div>

          <!-- Basic Info -->
          <div class="row g-3">
            <div class="col-sm-4">
              <label for="product_code" class="form-label">Product Code / SKU</label>
              <input type="text" id="product_code" name="product_code" class="form-control" disabled>
            </div>

            <div class="col-sm-4">
              <label for="bar_code" class="form-label">Barcode <span class="input_requred">*</span></label>
              <div class="d-flex">
                <div class="bar_code w-100">
                  <input type="text" id="bar_code" name="bar_code" class="form-control">
                  <small class="error-message"></small>
                </div>
                <button type="button" class="btn btn-success ms-2" id="barcode-reader"><i class="mdi mdi-barcode-scan"></i></button>
              </div>
            </div>

            <div class="col-sm-4">
              <label for="product_name" class="form-label">Product Name <span class="input_requred">*</span></label>
              <input type="text" id="product_name" name="product_name" class="form-control" required>
            </div>
          </div>

          <!-- Category & Brand -->
          <div class="row g-3 mt-3">
            <div class="col-sm-4">
              <label for="category_id" class="form-label">Category <span class="input_requred">*</span></label>
              <div class="d-flex">
                <div class="select">
                  <select id="category_id" name="category_id"  required></select>
                </div>
                <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#addCategoryModelPopup">
                  <i class="mdi mdi-plus"></i>
                </button>
              </div>
            </div>

            <div class="col-sm-4">
              <label for="brand_id" class="form-label">Brand <span class="input_requred">*</span></label>
              <div class="select">
                 <select id="brand_id" name="brand_id"></select>
              </div>
            </div>

            <div class="col-sm-4">
              <label for="pur_price" class="form-label">Purchase Price <span class="input_requred">*</span></label>
              <input type="number" id="pur_price" name="pur_price" min="0" class="form-control">
            </div>
          </div>

          <!-- Prices & Stock -->
          <div class="row g-3 mt-3">
            <div class="col-sm-4">
              <label for="selling_price" class="form-label">Selling Price <span class="input_requred">*</span></label>
              <input type="number" id="selling_price" name="selling_price" min="0" class="form-control">
            </div>

            <div class="col-sm-4">
              <label for="stock_amount" class="form-label">Stock Amount <span class="input_requred">*</span></label>
              <input type="number" id="stock_amount" name="stock_amount" min="0" class="form-control">
            </div>

            <div class="col-sm-4">
              <label for="alert_quantity" class="form-label">Alert Quantity <span class="input_requred">*</span></label>
              <input type="number" id="alert_quantity" name="alert_quantity" min="0" class="form-control">
            </div>
          </div>

          <!-- Description, Expiry, Status -->
          <div class="row g-3 mt-3">
            <div class="col-sm-4">
              <label for="productDescription" class="form-label">Product Description</label>
              <textarea id="productDescription" name="description" class="form-control" rows="3"></textarea>
            </div>

           <div class="col-sm-4">
              <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="enable_exp_date"> Enable Exp. Date <i class="input-helper"></i>
                    <span class="more-info">
                        <i class="mdi mdi-information-outline"></i>
                        <div class="more-info-text">
                          If you enable this option, you can set an expiration date for this product.
                        </div>
                    </span>
                </label>
              </div>
              <input type="date" id="exp_date" name="exp_date" class="form-control w-60 mr-3 resize-y" disabled>
          </div>

            <div class="col-sm-4">
              <label for="status" class="form-label">Status <span class="input_requred">*</span></label>
              <div class="form-switch">
                <input class="form-check-input" type="checkbox" name="status" id="status" checked>
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="mt-5 text-start">
            <button type="submit" class="btn btn-success"><i class="bi bi-floppy2-fill"></i> Update</button>
            <a href="<?= previous_url() ?>" class="btn btn-light ms-2"><i class="bi bi-x-circle"></i> Cancel</a>
          </div>
        
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="deleteProductForm" method="post">
          <?= csrf_field() ?>
          <input type="hidden" id="product_id"  name="product_id">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteProductLabel">Confirm Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this product?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {

  // 🔔 Flash message handler
  function showFlashMessage(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHTML = `
      <div class="alert ${alertClass} sriPosAlert alert-dismissible fade show" role="alert">
        <strong>${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;
    $("#flash-messages").html(alertHTML);
  }

  // Load categories
  function loadCategories(selectedId = null) {
    $.getJSON("<?= site_url('categories/getlist') ?>", function(data) {
      $('#category_id').empty();
      $.each(data, function(i, category) {
        $('#category_id').append(`<option value="${category.category_id}">${category.category_name}</option>`);
      });
      if (selectedId) $('#category_id').val(selectedId);
    });
  }

  // Load brands
  function loadBrands(selectedId = null) {
    $.getJSON("<?= site_url('brands/getlist') ?>", function(data) {
      $('#brand_id').empty().append('<option value="">Select Brand</option>');
      $.each(data, function(i, brand) {
        $('#brand_id').append(`<option value="${brand.supplier_id}">${brand.supplier_name}</option>`);
      });
      if (selectedId) $('#brand_id').val(selectedId);
    });
  }

  // Edit product button click
  $(document).on('click', '.editProductBtn', function() {
    let id = $(this).data('id');

    $.ajax({
      url: "<?= site_url('products/get') ?>/" + id,
      type: "GET",
      dataType: "json",
      success: function(product) {
        if (product.product_image) {
          $('#image_preview').css({
            'background-image': `url('<?= base_url('/uploads/product_images/') ?>/${product.product_image}')`,
            'background-size': 'cover'
          }).addClass('has-image');
          $('#image_preview svg').hide();
        } else {
          $('#image_preview').html(`
            <i class="bi bi-image image-placeholder"></i>
            <i class="bi bi-trash-fill remove-icon" onclick="removeImage()"></i>
          `);
        }

        $('#product_id').val(product.product_id);
        $('#product_name').val(product.product_name);
        $('#bar_code').val(product.bar_code);
        $('#pur_price').val(product.pur_price);
        $('#selling_price').val(product.selling_price);
        $('#productDescription').val(product.description);
        $('#status').prop('checked', product.status == 1);
        $('#product_code').val(product.product_code);
        $('#stock_amount').val(product.stock_amount);
        $('#alert_quantity').val(product.alert_quantity);
        $('#exp_date').val(product.exp_date);
        $('#existing_image').val(product.product_image);

        if (product.exp_date) {
          $('#enable_exp_date').prop('checked', true);
          $('#exp_date').prop('disabled', false);
        } else {
          $('#enable_exp_date').prop('checked', false);
          $('#exp_date').prop('disabled', true);
        }

        loadCategories(product.category_id);
        loadBrands(product.brand_id);

        $('#updateProductPopup').modal('show');
      },
      error: function(xhr) {
        showFlashMessage('error', 'Error loading product.');
        console.log(xhr.responseText);
      }
    });
  });

  // Product update form submit
  $('#updateProductForm').on('submit', function (e) {
    e.preventDefault();

 
    var formData = new FormData(this);

    $.ajax({
      url: "<?= site_url('products/update') ?>",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          showFlashMessage('success', response.message);

          $('#updateProductPopup').modal('hide');
          // Json Refresh table
          function loadTable(page=1){
            $.post("<?= site_url('products/fetch') ?>", {
                category: $("#filterCategory").val(),
                search: $("#filterSearch").val(),
                page: page,
                limit: $("#rowsPerPage").val()
              }, function(data){
                $("#productDataTable").html(data); // Load HTML from partial view
              });
        }
        loadTable();


        } else {
          let fieldNames = Object.keys(response.filed_name);
          for (let field of fieldNames) {
            $(`.${field}>small`).text('this field is required.');
          }
        }
      },
      error: function (xhr) {
        showFlashMessage('error', 'Server error while updating product.');
        console.log(xhr.responseText);
      }
    });
  });
  
  // delete product modal
  
$('#deleteProductForm').on('submit', function (e) {
  e.preventDefault();

  const formData = $(this).serialize();
  $.ajax({
    url: "<?= site_url('products/delete') ?>",
    type: "POST",
    data: formData,
    dataType: "json",
    success: function (response) {
      showFlashMessage('success', response.message);
          $('#deleteProductModal').modal('hide');
          // Json Refresh table
          function loadTable(page=1){
            $.post("<?= site_url('products/fetch') ?>", {
                category: $("#filterCategory").val(),
                search: $("#filterSearch").val(),
                page: page,
                limit: $("#rowsPerPage").val()
              }, function(data){
                $("#productDataTable").html(data); // Load HTML from partial view
              });
        }
        loadTable();
    },
    error: function (xhr) {
      showFlashMessage('error', 'Server error while deleting product.');
    }
  });
});


  // Add category via modal form
  $("#addCategoryForm").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url: "<?= site_url('categories/store'); ?>",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function(response){
        if(response.success){
          $("#category_id").append(
            $('<option>', {
              value: response.data.id,
              text: response.data.category_name,
              selected: true
            })
          );
          $("#addCategoryModelPopup").modal('hide');
          $("#addCategoryForm")[0].reset();
          showFlashMessage('success', 'Category added successfully.');
        } else {
          showFlashMessage('error', response.message || 'Failed to add category.');
        }
      },
      error: function() {
        showFlashMessage('error', 'Server error while adding category.');
      }
    });
  });

  // Clear errors on click
  $("#category_id").on("click", function(){
    $("#flash-messages").html('');
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

});
</script>
