<form id="editPoolActivity">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-12 mb-5">
            <h3 class="card-title mb-3"><?php echo app('translator')->get('activity.general_profit_rate'); ?>:</h3>
            <p><?php echo app('translator')->get('activity.edit.pool.desc'); ?></p>
            <div class="input-group mb-3">
                <span class="input-group-text">%</span>
                <input type="number" class="form-control" id="profit_rate" name="profitability" placeholder="<?php echo app('translator')->get('general.profit_rate'); ?>">
            </div>
            <div class="d-grid">
                <span class="text-muted"><?php echo app('translator')->get('activity.add.pool.total'); ?>: <strong id="total_price"></strong></span>
                <span class="text-muted"><?php echo app('translator')->get('activity.add.pool.profit'); ?>: <strong id="profit"></strong></span>
            </div>
        </div>
        <div class="col-12 mb-3">
            <h3 class="card-title mb-3"><?php echo app('translator')->get('activity.special_days.profit_rate'); ?>:</h3>
            <p><?php echo app('translator')->get('activity.special_days.desc'); ?></p>
            <div class="row">
                <div class="col-lg-4 col-12 mb-3">
                    <label class="form-label"><?php echo app('translator')->get('general.start_date'); ?></label>
                    <input type="text" class="form-control date-picker" id="special_days_start_date">
                </div>
                <div class="col-lg-4 col-12 mb-3">
                    <label class="form-label"><?php echo app('translator')->get('general.finish_date'); ?></label>
                    <input type="text" class="form-control date-picker" id="special_days_end_date">
                </div>
                <div class="col-lg-4 col-12 mb-3">
                    <label class="form-label"><?php echo app('translator')->get('general.profit_rate'); ?></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">%</span>
                        <input type="number" class="form-control" id="special_profit_rate" placeholder="<?php echo app('translator')->get('general.profit_rate'); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="button" id="addSpecialDays" class="btn btn-primary btn-sm float-end my-3">
                        <?php echo app('translator')->get('activity.add_special_day'); ?>
                    </button>
                </div>
            </div>
            <div id="specialDaysList">

            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('general.save'); ?></button>
        </div>
    </div>
</form>

<?php $__env->startPush('scripts'); ?>
    <script>
        $('.date-picker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD'
        });
        const data = [];
        let targetId = null;
        let modal = null;
        !(function() {
            let y = 0;
            const specialDays = function() {
                $(document).on('click', '[data-action="deleteSpecialDays"]', function() {
                    $(this).closest('.specialDays').remove()
                });

                $('#addSpecialDays').click(function() {

                    let start_date = $('#special_days_start_date');
                    let end_date = $('#special_days_end_date');
                    let profit_rate = $('#special_profit_rate');
                    let activityId = $('#editPool').data('activity-id');

                    const specialDaysHtml = `
                                <div class="specialDays">
                                    <div class="card my-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <input type="hidden" name="special_days[${y}][activity_id]" value="${activityId}">
                                                <div class="col-lg-4 col-12 mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('general.start_date'); ?></label>
                                                    <input type="text" class="form-control date-picker" name="special_days[${y}][start_date]" value="${start_date.val()}">
                                                </div>
                                                <div class="col-lg-4 col-12 mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('general.finish_date'); ?></label>
                                                    <input type="text" class="form-control date-picker" name="special_days[${y}][end_date]" value="${end_date.val()}">
                                                </div>
                                                <div class="col-lg-4 col-12 mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('general.profit_rate'); ?></label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">%</span>
                                                        <input type="number" class="form-control" name="special_days[${y}][profitability]" placeholder="<?php echo app('translator')->get('general.profit_rate'); ?>" value="${profit_rate.val()}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-danger btn-sm float-end" data-action="deleteSpecialDays"><?php echo app('translator')->get('general.delete'); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                    $('#specialDaysList').append(specialDaysHtml);

                    start_date.val('');
                    end_date.val('');
                    profit_rate.val('');

                    dateTimeInit();

                    y++;
                })
            };
            const renderData = function(event) {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                let targetModal = button.getAttribute('data-bs-target');
                modal = $(targetModal);
                modal.attr('data-id', id);

                targetId = id;

                const activity = JSON.parse(data[id]);

                $('#specialDaysList').empty();
                $.each(activity.special_days, function( key, value ) {
                    const specialDaysHtml = `
                        <div class="specialDays">
                            <div class="card my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mb-3">
                                            <label class="form-label"><?php echo app('translator')->get('general.start_date'); ?></label>
                                            <input type="text" class="form-control date-picker" value="${value.start_date}" disabled>
                                        </div>
                                        <div class="col-lg-4 col-12 mb-3">
                                            <label class="form-label"><?php echo app('translator')->get('general.finish_date'); ?></label>
                                            <input type="text" class="form-control date-picker" value="${value.end_date}" disabled>
                                        </div>
                                        <div class="col-lg-4 col-12 mb-3">
                                            <label class="form-label"><?php echo app('translator')->get('general.profit_rate'); ?></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">%</span>
                                                <input type="number" class="form-control" placeholder="<?php echo app('translator')->get('general.profit_rate'); ?>" value="${value.profitability}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-danger btn-sm float-end" data-action="deleteSpecialDays" data-permission="delete" data-id="${value.id}"><?php echo app('translator')->get('general.delete'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#specialDaysList').append(specialDaysHtml);
                });

                modal.attr('data-activity-id', activity.activity_id);

                let allPrice = null;

                $.each(activity.activity.prices, function(index, item) {
                    if (item.type === "ALL") {
                        allPrice = item.price;
                        return false;
                    }
                });

                let profitRate = activity.profitability;
                let profit = allPrice / 100 * profitRate;

                $('#profit_rate', targetModal).val(profitRate);
                $('#profit').html(profit);
                $('#total_price').html(allPrice + profit);

                $('[data-permission="delete"]').click(function() {
                    let id = $(this).data('id');
                    let url = '<?php echo e(_route('tourism.activity.pool.delete.special.day', ['id' => '__id'])); ?>';
                    url = url.replace('__id', id);

                    $.ajax({
                        type: "post",
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            _Swal({
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                didOpen: function() {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function (data) {
                            Swal.close();
                            _Swal({
                                icon: 'success',
                                title: '<?php echo app('translator')->get('general.success'); ?>',
                                text: data.message,
                                confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                            });
                            window.LaravelDataTables['activitypool-table'].ajax.reload();
                        },
                        error: function (error) {
                            Swal.close();
                            if(error.responseJSON.errors) {
                                let html = "<ul>";
                                $.each(error.responseJSON.errors, function(key, value) {
                                    html += "<li>"+value+"</li>";
                                })
                                html += "</ul>";
                                _Swal({
                                    icon: 'error',
                                    title: '<?php echo app('translator')->get('general.error'); ?>',
                                    html: html,
                                    confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                                });
                            } else {
                                _Swal({
                                    icon: 'error',
                                    title: '<?php echo app('translator')->get('general.error'); ?>',
                                    text: error.responseJSON.message,
                                    confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                                });
                            }
                            window.LaravelDataTables['activitypool-table'].ajax.reload();
                        }
                    });
                });
            };
            const save = function(event) {
                event.preventDefault();
                let url = '<?php echo e(_route('tourism.activity.pool.update', ['id' => '_id'])); ?>';
                url = url.replace('_id', targetId);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $(event.target).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        _Swal({
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            didOpen: function() {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(data) {
                        Swal.close();
                        _Swal({
                            icon: 'success',
                            title: '<?php echo app('translator')->get('general.success'); ?>',
                            text: data.message,
                            confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                        });
                        modal.modal('hide');
                        window.LaravelDataTables['activitypool-table'].ajax.reload();
                    },
                    error: function(error) {
                        Swal.close();
                        if(error.responseJSON.errors) {
                            let html = "<ul>";
                            $.each(error.responseJSON.errors, function(key, value) {
                                html += "<li>"+value+"</li>";
                            })
                            html += "</ul>";
                            _Swal({
                                icon: 'error',
                                title: '<?php echo app('translator')->get('general.error'); ?>',
                                html: html,
                                confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                            });
                        } else {
                            _Swal({
                                icon: 'error',
                                title: '<?php echo app('translator')->get('general.error'); ?>',
                                text: error.responseJSON.message,
                                confirmButtonText: '<?php echo app('translator')->get('general.ok'); ?>'
                            });
                        }
                        window.LaravelDataTables['activitypool-table'].ajax.reload();
                    }
                });
            };
            const events = function() {
                $('#editPool').on('show.bs.modal', (event) => {renderData(event)});
                $('#editPoolActivity').submit((event) => {save(event)});
            };

            events();
            specialDays();
        })();
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/applications/TourismCompany/src/../resources/views/modals/edit-pool.blade.php ENDPATH**/ ?>