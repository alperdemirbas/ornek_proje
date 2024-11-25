<?php $__currentLoopData = config('sidebar'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(isset($item["submenu"])): ?>
        <?php if(empty($item['permissions']) || auth()->user()->hasAnyPermission($item['permissions'])): ?>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">
                        <?php echo app('translator')->get($item["title"]); ?>
                    </span>
                </a>
                <ul aria-expanded="false" >
                    <?php $__currentLoopData = $item["submenu"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(empty($subitem['permissions']) || auth()->user()->hasAnyPermission($subitem['permissions'])): ?>
                            <li>
                                <a  <?php if(isset($subitem["submenu"])): ?>class="has-arrow"<?php endif; ?> href="<?php if(isset($subitem["route"])): ?> <?php echo e(_route($subitem["route"])); ?> <?php else: ?> javascript:void() <?php endif; ?>" aria-expanded="false">
                                    <?php echo app('translator')->get($subitem["title"]); ?>
                                </a>
                                <?php if(isset($subitem["submenu"])): ?>
                                    <ul aria-expanded="false" class="left mm-collapse">
                                        <?php $__currentLoopData = $subitem["submenu"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subItemChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(empty($subItemChild['permissions']) || auth()->user()->hasAnyPermission($subItemChild['permissions'])): ?>
                                                <li>
                                                    <a href="<?php if(isset($subItemChild["route"])): ?> <?php echo e(_route($subItemChild["route"])); ?> <?php else: ?> # <?php endif; ?>">
                                                        <?php echo app('translator')->get($subItemChild["title"]); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        <?php endif; ?>
    <?php else: ?>
        <?php if(empty($item['permissions']) || auth()->user()->hasAnyPermission($item['permissions'])): ?>
            <li>
                <a href="<?php if(isset($item["route"])): ?> <?php echo e(_route($item["route"])); ?> <?php else: ?> # <?php endif; ?>" aria-expanded="false">
                    <i class="flaticon-381-user-9"></i>
                    <span class="nav-text">
                         <?php echo app('translator')->get($item["title"]); ?>
                    </span>
                </a>
            </li>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/resources/views/sections/sidebar-menu.blade.php ENDPATH**/ ?>