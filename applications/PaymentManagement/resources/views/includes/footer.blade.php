<!-- Footer -->
<footer class="site-footer style-1 position-relative">
    <div class="footer-top bg-light sapping">
        <div class="container">
            <div class="row p-50">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="widget wow fadeInUp text-center text-lg-start" data-wow-delay="1.4s">
                        <div class="footer-logo">
                            <a href="{{ url('/') }}" class="logo-dark"><img src="{{ asset('frontend/assets/images/logo.svg') }}" alt=""></a>
                        </div>
                        <p>Rezyon, turizm firmaları için geliştirilen bir yazılımdır. Tur satışı, etkinlik düzenleme, otel rezervasyonu ve tatil hizmetleri gibi işlemleri kolaylaştırarak müşterilere daha iyi hizmet sunmayı sağlar.</p>
                        <div class="widget_getintuch ">
                            <ul>
                                <li class="text-center">
                                    <i class="fa-regular fa-comments"></i>
                                    info@rezyon.com
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-md-center text-md-center bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="footer-inner text-center ">
                        <p class="copyright-text wow fadeInUp" data-wow-delay="2.4s">&copy; {{ now()->format('Y') }} Rezyon. <br /> Developed by <a class="text-primary" href="https://kaat.digital" target="_blank">Kaat Digital</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->