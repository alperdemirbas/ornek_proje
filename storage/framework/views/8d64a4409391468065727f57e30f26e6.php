<?php use Rezyon\TourismCompany\Enums\ActivityStatus; ?>
<?php use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum; ?>
<div class="dropdown ms-auto text-end">
        <div class="btn-link" data-bs-toggle="dropdown">
                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
        </div>
        <div class="dropdown-menu dropdown-menu-end">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(PermissionsEnum::TOURISM_ACTIVITY_UPDATE->value)): ?>
                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editPool" data-bs-id="<?php echo e($row->id); ?>"><?php echo app('translator')->get('general.edit'); ?></a>
                        <?php if($row->status === ActivityStatus::ACTIVE): ?>
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#closedDays" data-bs-id="<?php echo e($row->id); ?>"><?php echo app('translator')->get('activity.closed.day.title'); ?></a>
                                <a class="dropdown-item" href="javascript:void(0)" data-action="disable" data-id="<?php echo e($row->id); ?>"><?php echo app('translator')->get('general.make.inactive'); ?></a>
                        <?php elseif($row->status === ActivityStatus::PASSIVE): ?>
                                <a class="dropdown-item" href="javascript:void(0)" data-action="enable" data-id="<?php echo e($row->id); ?>"><?php echo app('translator')->get('general.make.active'); ?></a>
                        <?php endif; ?>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(PermissionsEnum::TOURISM_ACTIVITY_DELETE->value)): ?>
                        <a class="dropdown-item" href="javascript:void(0)" data-action="delete" data-id="<?php echo e($row->id); ?>"><?php echo app('translator')->get('activity.delete.from.pool.button'); ?></a>
                <?php endif; ?>
        </div>
</div>
<script>
        data[<?php echo e($row->id); ?>] = '<?php echo json_encode($row, 15, 512) ?>';
        $('[data-action="delete"]').on('click', function () {
                const id = $(this).data('id');
                let url = '<?php echo e(_route('tourism.activity.pool.delete', ['id' => '__id'])); ?>';
                url = url.replace('__id', id);
                _Swal({
                        icon: 'warning',
                        title: '<?php echo app('translator')->get('activity.delete.from.pool.title'); ?>',
                        text: '<?php echo app('translator')->get('activity.delete.from.pool.text'); ?>',
                        showCancelButton: true,
                        confirmButtonText: '<?php echo app('translator')->get('general.yes'); ?>',
                        cancelButtonText: '<?php echo app('translator')->get('general.cancel'); ?>',
                }).then(function (response) {
                        if (response.isConfirmed) {
                                $.ajax({
                                        url: url,
                                        type: 'DELETE',
                                        dataType: 'json',
                                        headers: {
                                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                                        },
                                        success: function (response) {
                                                _Swal({
                                                        icon: 'success',
                                                        title: '<?php echo app('translator')->get('general.success'); ?>',
                                                        confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        },
                                        error: function (response) {
                                                _Swal({
                                                        icon: 'error',
                                                        title: '<?php echo app('translator')->get('general.error'); ?>',
                                                        text: response.responseJSON.message,
                                                        confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        }
                                })
                        }
                })
        });
        $('[data-action="disable"]').on('click', function () {
                const id = $(this).data('id');
                let url = '<?php echo e(_route('tourism.activity.pool.disable', ['id' => '__id'])); ?>';
                url = url.replace('__id', id);
                _Swal({
                        icon: 'warning',
                        title: '<?php echo app('translator')->get('activity.disable.from.pool.title'); ?>',
                        text: '<?php echo app('translator')->get('activity.disable.from.pool.text'); ?>',
                        showCancelButton: true,
                        confirmButtonText: '<?php echo app('translator')->get('general.yes'); ?>',
                        cancelButtonText: '<?php echo app('translator')->get('general.cancel'); ?>',
                }).then(function (response) {
                        if (response.isConfirmed) {
                                $.ajax({
                                        url: url,
                                        type: 'PUT',
                                        dataType: 'json',
                                        headers: {
                                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                                        },
                                        success: function (response) {
                                                _Swal({
                                                        icon: 'success',
                                                        title: '<?php echo app('translator')->get('general.success'); ?>',
                                                        confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        },
                                        error: function (response) {
                                                _Swal({
                                                        icon: 'error',
                                                        title: '<?php echo app('translator')->get('general.error'); ?>',
                                                        text: response.responseJSON.message,
                                                        confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        }
                                })
                        }
                })
        });
        $('[data-action="enable"]').on('click', function () {
                const id = $(this).data('id');
                let url = '<?php echo e(_route('tourism.activity.pool.enable', ['id' => '__id'])); ?>';
                url = url.replace('__id', id);
                _Swal({
                        icon: 'warning',
                        title: '<?php echo app('translator')->get('activity.enable.from.pool.title'); ?>',
                        text: '<?php echo app('translator')->get('activity.enable.from.pool.text'); ?>',
                        showCancelButton: true,
                        confirmButtonText: '<?php echo app('translator')->get('general.yes'); ?>',
                        cancelButtonText: '<?php echo app('translator')->get('general.cancel'); ?>',
                }).then(function (response) {
                        if (response.isConfirmed) {
                                $.ajax({
                                        url: url,
                                        type: 'PUT',
                                        dataType: 'json',
                                        headers: {
                                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                                        },
                                        success: function (response) {
                                                _Swal({
                                                        icon: 'success',
                                                        title: '<?php echo app('translator')->get('general.success'); ?>',
                                                        confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        },
                                        error: function (response) {
                                                _Swal({
                                                        icon: 'error',
                                                        title: '<?php echo app('translator')->get('general.error'); ?>',
                                                        text: response.responseJSON.message,
                                                        confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                                                })
                                                window.LaravelDataTables['activitypool-table'].ajax.reload();
                                        }
                                })
                        }
                })
        });
</script>
<?php /**PATH /var/www/html/applications/TourismCompany/src/../resources/views/datatable-actions.blade.php ENDPATH**/ ?>