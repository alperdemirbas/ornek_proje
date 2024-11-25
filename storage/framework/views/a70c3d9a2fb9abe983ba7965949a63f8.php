<?php $__env->startSection('title', 'Araç Ekle'); ?>
<?php $__env->startSection('MainPageUrl', _route('cars.index')); ?>
<?php $__env->startSection('MainPage', 'Araçlar'); ?>
<?php $__env->startSection('SubPage', 'Araç Ekle'); ?>

<?php $__env->startSection('main-content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">Araç Ekle</h6>
                </div>
                <form action="<?php echo e(_route('cars.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 my-3">
                                <label class="form-label">Araç Adı<span class="text-red">*</span></label>
                                <input required type="text" class="form-control" placeholder="Minivan" name="name[tr]">
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label">Araç Kapasitesi<span class="text-red">*</span></label>
                                <input required type="number" min="1" step="1" class="form-control" name="capacity">
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label">Araç Numarası</label>
                                <input type="text" class="form-control" placeholder="214" name="number">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary"><?php echo app('translator')->get('general.save'); ?></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $('form').submit(function(event) {
            _Swal({
                title: "Lütfen Bekleyiniz...",
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/applications/Transfers/src/../resources/views/cars/add.blade.php ENDPATH**/ ?>