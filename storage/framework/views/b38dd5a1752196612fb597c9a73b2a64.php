<?php $__env->startSection('title', trans('title.activity_pool')); ?>
<?php $__env->startSection('sub-content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i><?php echo e(__('general.filter')); ?>

                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="SlideToolHeader expand"><i
                                    class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt" style="">
                    <div class="card-body">
                        <div class="row">

                            <!-- Start : Firma Tipi -->
                            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                    <label for="">Durum</label>
                                    <select class="form-control default-select dashboard-select-2 h-auto wide"
                                            aria-label="Default select example" tabindex="null" id="status">
                                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status->name); ?>"><?php echo app('translator')->get('general.'.strtolower($status->value)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <label for="" class="d-block w-100">&nbsp;</label>
                                <button id="btn_filter" class="btn btn-info w-100" type="button"><i
                                            class="fa fa-search me-1"></i><?php echo e(__('general.filter')); ?></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        let activityFilter = {};

        const variables = {
            "btn_filter": $("#btn_filter"),
            "status": $("#status"),
        };

        $(variables.btn_filter).on('click', () => {
            let obj = {};

            if (variables.status.val() !== "") obj.status = variables.status.val();

            activityFilter = obj;
            window.LaravelDataTables['activitypool-table'].ajax.reload();
        });

        $('#profit_rate').on('input', function() {
            let inputValue = $(this).val();
            let sanitizedValue = inputValue.replace(/[^0-9]/g, '');
            $(this).val(sanitizedValue);
            let profit = 500 / 100 * sanitizedValue;
            $('#profit').html(profit + " " + 'TRY');
            $('#total_price').html((profit + 500) + " " + 'TRY');
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/applications/TourismCompany/src/../resources/views/list.blade.php ENDPATH**/ ?>