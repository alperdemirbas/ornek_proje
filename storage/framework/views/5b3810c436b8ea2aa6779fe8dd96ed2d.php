<!DOCTYPE html>
<html lang="tr" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(env('APP_NAME')); ?> - <?php echo $__env->yieldContent('title', ''); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <link rel="shortcut icon" type="image/png" href="#">
    <?php echo $__env->yieldPushContent('library.css'); ?>
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/custom.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="vh-100">
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <?php echo $__env->yieldContent('content'); ?>
</body>
<script src="<?php echo e(asset('assets/vendor/global/global.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dlabnav-init.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/dashboard/cms.js')); ?>" ></script>

<!-- Start : Extent Javascript -->
<script src="<?php echo e(asset('assets/js/smooth.scroll.js')); ?>"></script>


<script>
    const csrf =  $('meta[name="csrf-token"]').attr('content');
</script>
<?php echo $__env->yieldPushContent('library.js'); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
</html><?php /**PATH /var/www/html/resources/views/layouts/core.blade.php ENDPATH**/ ?>