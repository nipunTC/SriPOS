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
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title">
                      <h3><?= esc($title) ?></h3>
                      <p>
                        Manage your system settings and preferences to keep everything running smoothly.
                      </p>
                    </div>
                    <div class="row">
                      <div class="tab-control-items">
                        <div class="tab-controller" datapathto="basicSettings">
                          <i class="bi bi-gear"></i>  Basic Settings
                        </div>
                         <div class="tab-controller" datapathto="appearanceSettings">
                          <i class="bi bi-palette2"></i> Appearance
                        </div>
                         <div class="tab-controller" datapathto="inventoryProductSettings">
                          <i class="bi bi-box2"></i> Inventory & Product
                        </div>
                         <div class="tab-controller" datapathto="userRoleSettings">
                          <i class="bi bi-person-gear"></i> User & Role Management
                        </div>
                         <div class="tab-controller" datapathto="systemBackupSettings">
                          <i class="bi bi-cloud-download"></i> System & Backup
                        </div>
                      </div>
                      <div class="tab-control-contents">
                        <div class="tab-content" id="basicSettings">
                            <?= view('dashboard/settings/basicSettings') ?>
                        </div>
                        <div class="tab-content" id="appearanceSettings">
                            <?= view('dashboard/settings/appearanceSettings') ?>
                        </div>
                        <div class="tab-content" id="inventoryProductSettings">
                            <?= view('dashboard/settings/inventoryProductSettings') ?>
                        </div>
                        <div class="tab-content" id="userRoleSettings">
                            <?= view('dashboard/settings/userRoleSettings') ?>
                        </div>
                        <div class="tab-content" id="systemBackupSettings">
                            <?= view('dashboard/settings/systemBackupSettings') ?>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
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
