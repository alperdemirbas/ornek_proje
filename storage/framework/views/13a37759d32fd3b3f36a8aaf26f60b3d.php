<?php $__env->startSection('content'); ?>
    <section class="content-inner bg-white position-relative" style="height: 100vh!important;">
        <div class="col-12">
            <a href="" class="btn btn-sm btn-outline-primary"><i
                        class="fa fa-plus"></i> Demo talep et
            </a>
            <a href="<?php echo e(route('admin.view.auth.login')); ?>" class="btn btn-sm btn-outline-primary"><i
                        class="fa fa-plus"></i> Yonetim Giris Yap
            </a>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('applications.payment.management::layouts.core', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/main-test.blade.php ENDPATH**/ ?>