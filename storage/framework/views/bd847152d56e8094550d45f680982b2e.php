<!DOCTYPE html>
<html lang="tr">
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="rezyon, tourism, panel, turizm, rezervasyon, otel, uçak, aktivite, etkinlik, tatil, tur">
    <meta name="author" content="Kaat Digital">
    <meta name="robots" content="Rezyon - Turizm Rezervasyon Yönetim Sistemi">
    <meta name="description" content="Rezyon, turizm firmaları için geliştirilen bir yazılımdır. Tur satışı, etkinlik düzenleme, otel rezervasyonu ve tatil hizmetleri gibi işlemleri kolaylaştırarak müşterilere daha iyi hizmet sunmayı sağlar.">
    <meta property="og:title" content="Rezyon - Turizm Rezervasyon Yönetim Sistemi">
    <meta property="og:description" content="Rezyon, turizm firmaları için geliştirilen bir yazılımdır. Tur satışı, etkinlik düzenleme, otel rezervasyonu ve tatil hizmetleri gibi işlemleri kolaylaştırarak müşterilere daha iyi hizmet sunmayı sağlar.">
    <meta property="og:image" content="">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Rezyon - Turizm Rezervasyon Yönetim Sistemi</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('frontend/assets/images/favicon.png')); ?>">

    <!-- Stylesheet -->
    <link href="<?php echo e(asset('assets/vendor/animate/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/magnific-popup/magnific-popup.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/select2/css/select2.min.css')); ?>" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/style.css')); ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <?php echo $__env->yieldPushContent('styles'); ?>

</head>
<body id="bg" data-anm=".anm">

<!--loader start -->
<div id="loading-area" class="loading-page-1">
    <div class="loader">
        <div class="ball one"></div>
        <div class="ball two"></div>
        <div class="ball three"></div>
        <div class="ball four"></div>
    </div>
</div>
<!--loader start -->

<div class="page-wraper">

    <?php echo $__env->make('applications.payment.management::includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->make('applications.payment.management::includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <button class="scroltop icon-up" type="button"><i class="fas fa-arrow-up"></i></button>
</div>

<!-- JAVASCRIPT FILES ========================================= -->
<script src="<?php echo e(asset('frontend/assets/js/jquery.min.js')); ?>"></script><!-- JQUERY.MIN JS -->
<script src="<?php echo e(asset('frontend/assets/js/anm.js')); ?>"></script><!-- JQUERY.MIN JS -->
<script src="<?php echo e(asset('assets/vendor/wow/wow.js')); ?>"></script><!-- WOW.JS -->
<script src="<?php echo e(asset('assets/vendor/swiper/swiper-bundle.min.js')); ?>"></script><!-- OWL silder -->
<script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script><!-- WOW.JS -->
<script src="<?php echo e(asset('assets/vendor/magnific-popup/magnific-popup.js')); ?>"></script><!-- OWL SLIDER -->
<script src="<?php echo e(asset('frontend/assets/js/dz.carousel.js')); ?>"></script><!-- OWL SLIDER -->
<script src="<?php echo e(asset('frontend/assets/js/dz.ajax.js')); ?>"></script><!-- AJAX -->
<script src="<?php echo e(asset('assets/vendor/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/select2/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.min.js')); ?>"></script><!-- CUSTOM JS -->
<script src="<?php echo e(asset('frontend/assets/js/custom.js')); ?>"></script><!-- CUSTOM JS -->
<script>
    $('.select2').select2();
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH /var/www/html/applications/PaymentManagement/src/../resources/views/layouts/core.blade.php ENDPATH**/ ?>