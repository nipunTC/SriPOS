<?= view('dashboard/inc/header') ?>

<div class="container-scroller">
      <?= view('dashboard/inc/sidebar') ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <?= view('dashboard/inc/navbar') ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Products</h4>
                    <p class="card-description">
                      You can add/remove/edit products here.
                    </p>
                    <div class="system-table" >
                      <form action="<?= base_url('products/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                            <div class="">
                              <div class="col-sm-4">
                                <div class="input-image-row">
                                  <div class="input-image">
                                    <div class="image-upload-button mb-3 mt-3">
                                      <input type="file" id="product_image_upload" name="product_image" class="hidden-input" accept="image/*" onchange="previewImage(event)">
                                      
                                      <!-- fixed 'for' attribute -->
                                      <label for="product_image_upload">
                                        <span class="image_preview_box">
                                          <i class="bi bi-trash-fill remove-icon"></i>
                                          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="var(--primary)">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M18 20H4V6h9V4H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-9h-2v9zm-7.79-3.17l-1.96-2.36L5.5 18h11l-3.54-4.71zM20 4V1h-2v3h-3c.01.01 0 2 0 2h3v2.99c.01.01 2 0 2 0V6h3V4h-3z"/>
                                          </svg>
                                        </span>
                                      </label>
                                      
                                      <div class="label-tag">
                                        Product Image
                                        <p><small>Maximum size is 1Mb</small></p>
                                      </div> 
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-4">
                                <label class="form-label" for="product_code">Product Code <span class="input_requred">*</span></label>
                                <div class="d-flex align-items-center">
                                  <input type="text" id="product_code" name="product_code" class="form-control w-60 mr-3" autofocus="on" required>
                                  <div class="barcode-reader btn btn-success short-button" hint="Barcode Scan" id="barcode-reader"> <i class="mdi mdi-barcode-scan"></i></div>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                  <label class="form-label" for="product_name">Product Name <span class="input_requred">*</span></label>
                                  <input type="text" id="product_name" name="product_name" class="form-control w-60 mr-3" required>
                              </div>
                              <div class="col-sm-4">
                                 <label class="form-label" for="product_name">Product Category <span class="input_requred">*</span></label>
                                  <div class="d-flex align-items-center">
                                    <select class="form-control w-60 mr-3" name="category_id" id="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="add-category btn btn-success short-button" hint="Add New Category" data-bs-toggle="modal" data-bs-target="#addCategoryModelPopup"><i class="mdi mdi-plus"></i></div>
                                  </div>
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div class="col-sm-4">
                                <label class="form-label" for="brand_id">Brand <span class="input_requred">*</span></label>
                                <select class="form-control w-60 mr-3" name="brand_id" id="brand_id">
                                    <option value="">Select Brand</option>
                                        <?php foreach($brands as $brand): ?>
                                            <option value="<?= $brand['supplier_id'] ?>"><?= $brand['supplier_name'] ?></option>
                                        <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="col-sm-4">
                                  <label class="form-label" for="pur_price">Purchased Price<span class="input_requred">*</span></label>
                                  <input type="number" id="pur_price" name="pur_price" min="0" class="form-control w-60 mr-3 resize-y">
                                  <div class="currency-tag"></div>
                              </div>
                              <div class="col-sm-4">
                                  <label class="form-label" for="selling_price">Selling Price<span class="input_requred">*</span></label>
                                  <input type="number" id="selling_price" name="selling_price" min="0" class="form-control w-60 mr-3 resize-y">
                                  <div class="currency-tag"></div>
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div class="col-sm-4">
                                  <label class="form-label" for="stock_amount">Stock Amount<span class="input_requred">*</span></label>
                                  <input type="number" id="stock_amount" name="stock_amount" class="form-control w-60 mr-3 resize-y" min="0" >
                              </div>
                              <div class="col-sm-4">
                                  <label class="form-label" for="alert_quantity">Alert Quantity<span class="input_requred">*</span></label>
                                  <input type="number" id="alert_quantity" name="alert_quantity" class="form-control w-60 mr-3 resize-y" min="0" >
                              </div>  
                              <div class="col-sm-4">
                                  <label class="form-label" for="status">Status<span class="input_requred">*</span></label>
                                  <div class="form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status" checked>
                                  </div>
                              </div>  
                            </div>  
                            <div class="row mt-3">
                                <div class="col-sm-4">
                                  <label class="form-label" for="productDescription">Product Description</label>
                                  <textarea name="productDescription" id="productDescription" class="form-control resize-y" cols="30"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                      <label class="form-check-label">
                                          <input type="checkbox" class="form-check-input" id="enable_exp_date"> Enable Exp. Date <i class="input-helper"></i>
                                      </label>
                                    </div>
                                    <input type="date" id="exp_date" name="exp_date" class="form-control w-60 mr-3 resize-y" disabled>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12 mt-4">
                                  <button type="submit" class="btn btn-success"> <i class="bi bi-floppy2-fill"></i>&nbsp Save Product </button>
                              </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?= view('dashboard/inc/popupModels') ?>
          </div>
          <?= view('dashboard/inc/foot') ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

<?= view('dashboard/inc/footer') ?>