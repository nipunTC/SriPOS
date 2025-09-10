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
                    <h4 class="card-title">Products</h4>
                    <p class="card-description">
                      You can add/remove/edit products here.
                    </p>
                    <div class="system-table table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Category ID</th>
                            <th>Brand ID</th>
                            <th>Unit ID</th>
                            <th>Tax ID</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(!empty($products)) : ?>
                            <?php foreach($products as $product) : ?>
                                <tr>
                                    <td><?= $product['product_id'] ?></td>
                                    <td><?= $product['product_code'] ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td>
                                        <?php if($product['product_img']): ?>
                                            <img src="<?= base_url($product['product_img']) ?>" width="50">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $product['description'] ?></td>
                                    <td><?= $product['category_id'] ?></td>
                                    <td><?= $product['brand_id'] ?></td>
                                    <td><?= $product['unit_id'] ?></td>
                                    <td><?= $product['tax_id'] ?></td>
                                    <td><?= $product['status'] ?></td>
                                    <td><?= $product['created_at'] ?></td>
                                    <td><?= $product['updated_at'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="12">
                                      <div class="table-row-no-data">
                                        No products found.
                                        <a href="<?= site_url('/products/create') ?>">
                                        <div class="add-product-button">
                                            <i class="mdi mdi-plus"></i>
                                        </div>
                                        </a>
                                      </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                      </table>
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