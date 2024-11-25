<?php $__env->startSection('content'); ?>
    <div id="main-wrapper">
        <?php echo $__env->make('sections.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('sections.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="<?php echo $__env->yieldContent('MainPageUrl', '#'); ?>"><?php echo $__env->yieldContent('MainPage','Home'); ?></a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo $__env->yieldContent('SubPage','Dashboard'); ?></a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php if(isset($errors) && $errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <script>
                                        const error = "<?php echo e($errors->all()[0]); ?>";
                                        const element = error.split(' ')[0];
                                        console.log(element);
                                            setTimeout(()=>{
                                                $("[smooth-name='"+element+"']").smooth();
                                            },3000);
                                    </script>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php if(session()->has('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session()->get('success')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php echo $__env->yieldContent("main-content"); ?>
            </div>
        </div>
    </div>
    <?php if(isset($modals)): ?>
        <?php $__currentLoopData = $modals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="modal fade bd-example-modal-lg" id="<?php echo e($modal['targetId']); ?>" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <?php if(isset($modal['form'])): ?>
                        <form
                                <?php if(isset($modal['form']['id'])): ?> id="<?php echo e($modal['form']['id']); ?>" <?php endif; ?>
                                <?php if(isset($modal['form']['method'])): ?> method="<?php echo e($modal['form']['method']); ?>" <?php endif; ?>
                                <?php if(isset($modal['form']['action'])): ?> action="<?php echo e($modal['form']['action']); ?>" <?php endif; ?>
                                <?php if(isset($modal['form']['media'])): ?> enctype="multipart/form-data" <?php endif; ?>
                        >
                            <?php echo csrf_field(); ?>
                    <?php endif; ?>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo e($modal['title']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        <div class="modal-body">
                            <?php echo $__env->make($modal['contentView'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <?php if(isset($modal['footerView'])): ?>
                            <div class="modal-footer">
                                <?php echo $__env->make($modal['footerView'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endif; ?>
                    <?php if(isset($modal['isForm'])): ?>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('library.js'); ?>
    <script src="<?php echo e(asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/sweetalert2/sweetalert2.all.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/toastr/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/select2/js/select2.full.min.js')); ?>"></script>
    <script>
        const lang = '<?php echo e(app()->getLocale()); ?>';
        const toast = function( { type,message,title}){
            toastr[type](
                message,
                title, {
                    timeOut: 5000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('library.css'); ?>
    <link href="<?php echo e(asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/fontawesome/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/toastr/css/toastr.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/select2/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        $("[name='birthdate']").bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            time: false,
        });
    </script>

    <script>
        $(".select2").select2();
        function dateTimeInit() {
            $('.default-select').selectpicker();

            $('.date-picker').bootstrapMaterialDatePicker({
                format: 'DD-MM-YYYY HH:mm'
            });

            $('.time-picker').bootstrapMaterialDatePicker({
                format: 'HH:mm',
                time: true,
                date: false
            });

            $('.input-daterange-timepicker').daterangepicker({
                timePicker: true,
                format: 'MM-DD-YYYY h:mm',
                timePicker24Hour: true,
                timePickerSeconds: false,
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
            });
        }

        dateTimeInit();

        <?php if(session('status') === 'success'): ?>
            _Swal({
                icon: 'success',
                text: '<?php echo e(session('message')); ?>',
                confirmButtonText:' <?php echo app('translator')->get('general.ok'); ?>'
            });
        <?php elseif(session('status') === 'error'): ?>
            _Swal({
                icon: 'error',
                text: '<?php echo e(session('message')); ?>',
                confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
            });
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.core', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>