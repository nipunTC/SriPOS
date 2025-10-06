<!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img class="img-xs " src="<?= base_url('/public/assets/images/logo-1.png') ?>" alt=""></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
        <div class="profile-desc">
            <div class="profile-pic">
            <div class="count-indicator">
                <img class="img-xs rounded-circle " src="<?= base_url('/public/assets/images/dashboard/default_user.jpg') ?>" alt="">
                <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
                <h5 class="mb-0 font-weight-normal"> <?= session()->get('name') ?> </h5>
                <span><?= session()->get('userRole') ?></span>
            </div>
            </div>
            <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-settings text-primary"></i>
                </div>
                </div>
                <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-onepassword  text-info"></i>
                </div>
                </div>
                <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-calendar-today text-success"></i>
                </div>
                </div>
                <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                </div>
            </a>
            </div>
        </div>
        </li>
        <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
        <a class="nav-link" href="<?= site_url('/dashboard') ?>">
            <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
        </a>
        </li>
        <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
            <span class="menu-icon">
            <i class="mdi mdi-cart"></i>
            </span>
            <span class="menu-title">Products</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="products">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= site_url('/products/create') ?>">Add New Products</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= site_url('/products/view') ?>">View All Products</a></li>
            </ul>
        </div>
        </li>
        
    </ul>
    </nav>