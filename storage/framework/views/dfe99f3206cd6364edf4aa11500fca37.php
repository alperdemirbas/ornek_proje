<?php $__env->startSection('MainPage',$mainPage ?? ""); ?>
<?php $__env->startSection('SubPage', $subPage ??""); ?>
<?php $__env->startSection('main-content'); ?>
    <div class="row">
        <div class="col-12">
            <?php if(isset($modals)): ?>
                <?php $__currentLoopData = $modals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($modal['hasButton'])): ?>
                        <div class="card h-auto">
                            <div class="card-body">
                                <button type="button"
                                        class="btn btn-rounded btn-info float-end"
                                        data-bs-toggle="modal"
                                        data-bs-target="#<?php echo e($modal['targetId']); ?>"><span class="btn-icon-start <?php echo e($modal['textIcon'] ?? 'text-info'); ?>"><i
                                                class="fa <?php echo e($modal['icon'] ?? 'fa-plus'); ?> <?php echo e($modal['color'] ?? 'color-info'); ?>"></i></span><?php echo app('translator')->get($modal['buttonTitle'] ?? "add"); ?></button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <!-- Start : Filtre  -->
            <?php echo $__env->yieldContent('sub-content'); ?>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo e($title ?? ""); ?></h4>
                    <?php if(isset($buttons)): ?>
                        <div class="card-header-buttons">
                            <?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($button['element'] === "button"): ?>
                                    <button type="<?php echo e($button['type']); ?>" class="<?php echo e($button['class']); ?>"
                                        <?php if(isset($button['attributes'])): ?>
                                            <?php $__currentLoopData = $button['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($key); ?>="<?php echo e($value); ?>"
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    ><?php echo $button['icon'] ?? ""; ?> <?php echo e($button['text']); ?></button>
                                <?php else: ?>
                                    <a href="<?php echo e($button['href']); ?>" class="<?php echo e($button['class']); ?>"
                                    <?php if(isset($button['attributes'])): ?>
                                        <?php $__currentLoopData = $button['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($key); ?>="<?php echo e($value); ?>"
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    ><?php echo $button['icon'] ?? ""; ?> <?php echo e($button['text']); ?></a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body table-responsive">
                    <?php echo e($dataTable->table()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPrepend('library.css'); ?>
    <link href="<?php echo e(asset('assets/vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPrepend(); ?>
<?php $__env->startPush('library.js'); ?>
    <script src="<?php echo e(asset('assets/vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/datatables/js/datatable-init.js')); ?>"></script>
    <?php echo e($dataTable->scripts()); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/layouts/datatable.blade.php ENDPATH**/ ?>