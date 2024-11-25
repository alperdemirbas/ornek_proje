<?php $__env->startSection('title', 'Transfer Ekle'); ?>
<?php $__env->startSection('MainPageUrl', _route('transfers.index')); ?>
<?php $__env->startSection('MainPage', 'Transferler'); ?>
<?php $__env->startSection('SubPage', 'Transfer Ekle'); ?>

<?php $__env->startSection('main-content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">Transfer Ekle</h6>
                </div>
                <form action="<?php echo e(_route('transfers.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 my-3">
                                <label class="form-label">Aktivite<span class="text-red">*</span></label>
                                <select class="form-control select2" id="activity" name="activity_id" required>
                                    <option value="">Aktivite Seçiniz</option>
                                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option data-start="<?php echo e($activity->activity->start_time); ?>" data-end="<?php echo e($activity->activity->end_time); ?>" value="<?php echo e($activity->activity->id); ?>"><?php echo app('translator')->get($activity->activity->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <select class="form-control d-none" id="sessions" name="activity_session_id" required>
                                    <option value="">Seans Seçiniz</option>
                                </select>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Aktivite Tarihi<span class="text-red">*</span></label>
                                <select class="form-control select2" id="order_date" name="date" required>
                                    <option value="">Tarih Seçiniz</option>
                                </select>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Transfer Aracı<span class="text-red">*</span></label>
                                <select class="form-control select2" name="cars_id" required>
                                    <option value="">Araç Seçiniz</option>
                                    <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($car->id); ?>"><?php echo app('translator')->get($car->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Buluşma Yeri<span class="text-red">*</span></label>
                                <select class="form-control select2" name="hotel_id" required>
                                    <option value="">Otel Seçiniz</option>
                                    <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($hotel->id); ?>"><?php echo app('translator')->get($hotel->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Buluşma Zamanı<span class="text-red">*</span></label>
                                <input type="text" class="form-control time-picker" name="time" required>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="form-label">Sürücü Adı<span class="text-red">*</span></label>
                                <input required type="text" class="form-control" name="driver_name" required>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label class="text-label form-label">Sürücü Telefonu<span class="text-red">*</span></label>
                                <div class="mb-3 d-flex phone-group">
                                    <select id="phone_country" name="driver_phone_country" class="select2 countrySelect w-25" required></select>
                                    <input type="text" name="driver_phone" id="phone" class="form-control phone-mask" required>
                                </div>
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

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/vendor/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/jquery-ui/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/imask/imask.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/phone-codes.js')); ?>"></script>
    <script>
        $('#activity').change(function() {
            let selectedStartDateStr = $('option:selected', this).attr('data-start');
            let selectedEndDateStr = $('option:selected', this).attr('data-end');
            let selectedStartDate = new Date(selectedStartDateStr);
            let selectedEndDate = new Date(selectedEndDateStr);
            selectedStartDate = new Date(selectedStartDate.setHours(selectedStartDate.getHours() - 2));
            selectedEndDate = new Date(selectedEndDate.setHours(selectedEndDate.getHours() - 2));

            let time_picker = $('.time-picker');
            time_picker.bootstrapMaterialDatePicker('destroy');
            time_picker.off();
            time_picker.removeData();
            time_picker.bootstrapMaterialDatePicker({
                date: false,
                format: 'HH:mm',
                minDate: selectedStartDate,
                maxDate: selectedEndDate,
                time: true,
                weekStart : 1,
                switchOnClick : true
            })

            let url =  "<?php echo e(_route('supplier.activity.sessions', ['activity' => '__'])); ?>";
            url = url.replace('__', $(this).val());
            $.ajax({
                type: "GET",
                url: url,
                header: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                dataType: "json",
                success: function(response) {
                    if(response.length > 0) {
                        $('#sessions').removeClass('d-none').select2();
                        $.each(response, function(key, elem) {
                            $('#sessions').append(`<option value="${elem.id}">${elem.start_time} - ${elem.end_time}</option>`);
                        })
                    } else {
                        $('#sessions').addClass('d-none').select2('destroy');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#sessions').addClass('d-none').select2('destroy');
                    console.log(jqXHR, textStatus, errorThrown)
                }
            })

            $.ajax({
                type: "GET",
                url: "<?php echo e(_route('cart.by.date')); ?>",
                header: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                data: {
                  "activity_id": $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if(response.length > 0) {
                        $.each(response, function(key, elem) {
                            $('#order_date').append(`<option value="${elem}">${moment(elem).format('DD/MM/YYYY')}</option>`);
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown)
                }
            })
        });

        $('form').submit(function(event) {
            $('#phone').val(phoneMask1.unmaskedValue)
            _Swal({
                title: "Lütfen Bekleyiniz...",
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });

        const phoneMask1 = IMask(
            document.querySelector('#phone'),
            {
                mask: '(000)000-0000',
                lazy: false,
                placeholderChar: '_'
            }
        );

        const supportedRegions = <?php echo json_encode(phone_supported_regions(), 15, 512) ?>;
        const trRegion  = supportedRegions.find((element) => element === "TR");

        const filteredPhoneList = phoneList.filter(item => supportedRegions.includes(item.code));

        filteredPhoneList.sort((a, b) => (a.code === trRegion ? -1 : b.code === trRegion ? 1 : 0));

        const select = $(".countrySelect");
        filteredPhoneList.forEach(item => {
            select.append($('<option>', {
                value: item.code,
                text: item.emoji + ' ' + item.dial_code,
                "data-mask": item.mask
            }));
        });

        select.on('change', function (e) {
            let selectedOption = $(this).find(':selected');
            let maskValue = selectedOption.attr('data-mask');
            if(maskValue) {
                phoneMask1.updateOptions({
                    mask: maskValue,
                });
            } else {
                phoneMask1.updateOptions({
                    mask: Number,
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/applications/Transfers/src/../resources/views/transfers/add.blade.php ENDPATH**/ ?>