<?php $__env->startSection('title', 'Araçlar'); ?>
<?php $__env->startSection('MainPageUrl', url('/dashboard')); ?>
<?php $__env->startSection('MainPage', 'Panel'); ?>
<?php $__env->startSection('SubPage', 'Araçlar'); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on('submit', '.deleteAction', function(event) {
            event.preventDefault();
            _Swal({
                title: "Emin misin?",
                text: "Bu işlemi geri alamazsınız.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Evet, Sil!",
                cancelButtonText: "Hayır, İptal Et!"
            }).then((result) => {
                if (result.isConfirmed) {
                    _Swal({
                        title: "Lütfen Bekleyiniz...",
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    this.submit();
                }
                return false;
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/applications/Transfers/src/../resources/views/cars/list.blade.php ENDPATH**/ ?>