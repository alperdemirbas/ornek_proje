
    <div class="nav-header">
        <a href="index.html" class="brand-logo">
            <img src="<?php echo e(asset('assets/images/rezyon.svg')); ?>" height="60px">
        </a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar">
                            <?php echo $__env->yieldContent('title','Rezyon'); ?>
                        </div>
                    </div>
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown notification_dropdown">
                            <a class="nav-link bell dz-theme-mode p-0" href="javascript:void(0);">
                                <i id="icon-light" class="fas fa-sun"></i>
                                <i id="icon-dark" class="fas fa-moon"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                Merhaba, <?php echo e(auth()->user()->firstname ?? "demo"); ?>!
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item ai-icon">
                                    <svg id="icon-user2" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span class="ms-2"><?php echo app('translator')->get('profile.fakeKey'); ?> </span>
                                </a>

                                <!-- Start : Logout -->
                                <?php
                                    if(\Illuminate\Support\Facades\Auth::guard('companies')->check()){
                                        $route = _route('companies.logout');
                                    }else {
                                        $route = route('admin.auth.logout');
                                    }
                                ?>
                                <form action="<?php echo e($route); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="_method" value="POST" />
                                    <button type="submit" class="dropdown-item ai-icon">
                                        <svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2"><?php echo app('translator')->get('auth.logout'); ?> </span>
                                    </button>
                                </form>
                                <!-- End : Logout -->

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
<?php /**PATH /var/www/html/resources/views/sections/header.blade.php ENDPATH**/ ?>