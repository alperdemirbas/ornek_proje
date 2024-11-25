<?php $__env->startSection('main-content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <form method="POST" action="<?php echo e(_route('company.users.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><?php echo app('translator')->get('user.user_info'); ?></h4>
                        <div class="row">
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label  class="form-label"><?php echo app('translator')->get('general.firstname'); ?><span class="text-danger scale5 ms-2">*</span></label>
                                <input type="text" class="form-control" name="firstname" placeholder="Ahmet" aria-label="firstname" value="<?php echo e(old('firstname')); ?>">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label  class="form-label"><?php echo app('translator')->get('general.lastname'); ?><span class="text-danger scale5 ms-2">*</span></label>
                                <input type="text" class="form-control" name="lastname" placeholder="Demir" aria-label="lastname" value="<?php echo e(old('lastname')); ?>">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label  class="form-label"><?php echo app('translator')->get('general.email'); ?><span class="text-danger scale5 ms-2">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="ahmet.demir@example.com" aria-label="email" value="<?php echo e(old('email')); ?>">
                            </div>
                        </div>
                        <?php if(isset($permissions)): ?>
                            <h4><?php echo app('translator')->get('user.permissions'); ?></h4>
                            <div class="row">
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-xl-6  col-md-6 mb-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input me-3" type="checkbox" name="permissions[<?php echo e($permission->name); ?>]" role="switch" id="<?php echo e($permission->name); ?>">
                                            <label class="form-check-label" for="<?php echo e($permission->name); ?>"><?php echo e(__('permission.'.$permission->name)); ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer text-end">
                        <div>
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('general.save'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/applications/Companies/src/../resources/views/company-users/add.blade.php ENDPATH**/ ?>