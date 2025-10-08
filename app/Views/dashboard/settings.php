<?= view('dashboard/inc/header') ?>

<div class="container-scroller">
      <?= view('dashboard/inc/sidebar') ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <?= view('dashboard/inc/navbar') ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <?= view('dashboard/inc/foot') ?>
          </div>
          <?= view('dashboard/inc/popupModels') ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
<!-- products table load AJAX part  -->
<?= view('dashboard/inc/footer') ?>
