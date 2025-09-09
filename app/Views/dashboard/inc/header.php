<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php 
            // controller passing data to view
            echo isset($title) ? $title : '';
        ?>
    </title>
    <!-- plugins:css -->
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
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/style.css') ?>">
    <!-- custom css files -->
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/assets/css/custom_responsive.css') ?>">

</head>
<body>
    