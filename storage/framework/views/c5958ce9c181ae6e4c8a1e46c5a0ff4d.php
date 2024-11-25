<div class="d-flex">
    <a href="<?php echo e(_route('cars.edit', ['car' => $row->id])); ?>" class="btn btn-primary shadow btn-xs sharp"><i class="fas fa-pencil"></i></a>
    <form class="deleteAction" action="<?php echo e(_route('cars.destroy', ['car' => $row->id])); ?>" method="POST">
        <?php echo method_field('DELETE'); ?>
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-primary shadow btn-xs sharp ms-2 deleteAction"><i class="fas fa-trash"></i></button>
    </form>
</div><?php /**PATH /var/www/html/applications/Transfers/src/../resources/views/cars/datatables-actions.blade.php ENDPATH**/ ?>