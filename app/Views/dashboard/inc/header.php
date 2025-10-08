<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php 
            // controller passing data to view
            echo isset($title) ? $title." | SriPOS": '';
        ?>
    </title>
    <!-- plugins:css -->
     <!-- boostrap 5 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url('/public/assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/assets/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->
    <link rel="stylesheet" href="<?= base_url('/public/assets/vendors/jvectormap/jquery-jvectormap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/assets/vendors/owl-carousel-2/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/assets/vendors/owl-carousel-2/owl.theme.default.min.css') ?>">
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
 
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/style.css') ?>">
    <!-- custom css files -->
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/custom_responsive.css') ?>">
    
    <!-- jQuery -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    