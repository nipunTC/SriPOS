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
                            <div class="row">
                              <div class="col">
                                <label class="form-label" for="product_code">Product Code <span class="input_requred">*</span></label>
                                <div class="d-flex align-items-center">
                                  <input type="text" id="product_code" name="product_code" class="form-control w-60 mr-3" required>
                                  <div class="barcode-reader btn btn-success" id="barcode-reader"> <i class="mdi mdi-barcode-scan"></i></div>
                                </div>
                              </div>
                              <div class="col">
                                  <label class="form-label" for="product_name">Product Name <span class="input_requred">*</span></label>
                                  <input type="text" id="product_name" name="product_name" class="form-control w-60 mr-3" required>
                              </div>
                              <div class="col">
                                 <label class="form-label" for="product_name">Product Category <span class="input_requred">*</span></label>
                                  <div class="d-flex align-items-center">
                                    <select class="form-control w-60 mr-3" name="category_id" id="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="add-category btn btn-success" ><i class="mdi mdi-plus"></i></div>
                                  </div>
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div class="col">
                                <label class="form-label" for="brand_id">Brand</label>
                                <select class="form-control w-60 mr-3" name="brand_id" id="brand_id">
                                    <option value="">Select Brand</option>
                                    <?php // foreach($brands as $brand): ?>
                                        <option value="1">Brand 1</option>
                                    <?php // endforeach; ?>
                                </select>
                              </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?= view('dashboard/inc/foot') ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

<?= view('dashboard/inc/footer') ?>