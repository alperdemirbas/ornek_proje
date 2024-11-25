<!-- Header -->
<header class="site-header mo-left header header-transparent">
    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix ">
            <div class="container clearfix">

                <!-- Website Logo -->
                <div class="logo-header">
                    <a href="<?php echo e(url('/')); ?>" class="logo-dark"><img src="<?php echo e(asset('frontend/assets/images/logo.svg')); ?>" alt=""></a>
                </div>

                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <!-- Extra Nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <button type="button" class="btn btn-light btn-lg btn-shadow" data-bs-toggle="modal" data-bs-target="#contactModal">Bize Ulaşın</button>
                    </div>
                </div>

                <!-- Header Nav -->
                <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                    <div class="logo-header">
                        <a href="<?php echo e(url('/')); ?>" class="logo-dark"><img src="<?php echo e(asset('frontend/assets/images/logo.svg')); ?>" alt=""></a>
                    </div>
                    <ul class="nav navbar-nav navbar navbar-left">
                        <li><a href="#home">Anasayfa</a></li>
                        <li><a href="#how-it-work">Nasıl Çalışır</a></li>
                        <li><a href="#features">Özellikler</a></li>
                        <li><a href="#faq">SSS</a></li>
                        <li><a href="<?php echo e(url('/v1/documentation')); ?>">Kullanım Klavuzu</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header End -->
</header>
<!-- Header End --><?php /**PATH /var/www/html/applications/PaymentManagement/src/../resources/views/includes/header.blade.php ENDPATH**/ ?>