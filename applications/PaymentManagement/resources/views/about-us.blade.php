@extends('applications.frontend::layouts.core')

@section('content')
    <!-- Banner  -->
    <div class="dz-bnr-inr dz-bnr-inr-sm text-center overlay-primary-dark" style="background-image: url(assets/images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>Hakkımızda</h1>
                <!-- Breadcrumb Row -->
                <nav aria-label="breadcrumb" class="breadcrumb-row m-t15">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('applications.frontend::home') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hakkımızda</li>
                    </ul>
                </nav>
                <!-- Breadcrumb Row End -->
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <section id="how-it-work" class="content-inner overflow-hidden position-relative">
        <div class="container">
            <div class="section-head text-center">
                <h6 class="text wow fadeInUp" data-wow-delay="0.6s">Çalışma Süreci</h6>
                <h2 class="title wow fadeInUp" data-wow-delay="0.8s">Nasıl Çalışır?</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 m-b30">
                    <div class="icon-bx-wraper style-1 bg-clr-sky wow bounceInLeft" data-wow-delay="1.2s" >
                        <div class="icon-media">
                            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" version="1.0" width="70" height="70" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                    <path d="M748 4683 c-420 -420 -438 -439 -438 -475 0 -25 7 -44 22 -58 21 -19 33 -20 391 -20 252 0 382 4 408 12 51 15 114 69 142 122 21 40 22 52 25 374 l3 332 1080 0 1080 0 24 -25 25 -24 0 -1336 0 -1335 -258 0 c-196 0 -271 -4 -315 -15 -164 -43 -296 -166 -350 -328 -20 -58 -21 -88 -25 -460 l-3 -397 -1031 2 -1030 3 -19 24 c-18 23 -19 59 -19 1390 0 845 -4 1379 -10 1400 -26 92 -131 77 -145 -21 -3 -24 -5 -655 -3 -1403 3 -1494 -1 -1387 63 -1463 43 -51 98 -75 188 -80 l77 -5 0 -38 c0 -111 45 -197 127 -246 l48 -28 876 -3 876 -3 6 -89 c14 -195 94 -330 250 -424 110 -65 118 -66 876 -66 458 0 697 4 733 11 146 31 279 135 344 272 48 102 56 190 52 624 -3 329 -4 352 -22 372 -26 29 -86 29 -112 0 -18 -20 -19 -46 -24 -453 -5 -422 -5 -432 -28 -477 -36 -74 -87 -125 -160 -161 l-67 -33 -715 0 -715 0 -56 26 c-109 52 -176 137 -199 254 -8 43 -10 255 -8 730 l3 670 27 57 c35 75 94 138 165 174 l58 29 725 0 725 0 47 -23 c71 -36 134 -96 165 -160 26 -53 28 -69 34 -209 4 -129 8 -155 24 -173 24 -27 85 -27 109 -1 24 26 31 147 17 270 -24 216 -165 383 -366 436 -44 11 -112 15 -257 15 l-198 0 0 1176 c0 898 -3 1186 -12 1218 -16 54 -90 128 -144 144 -23 6 -71 12 -108 12 l-66 0 0 61 c0 118 -43 193 -134 235 l-51 24 -1144 0 -1144 0 -439 -437z m397 -330 c-3 -18 -17 -41 -32 -53 -24 -19 -39 -20 -287 -20 l-261 0 290 290 290 290 3 -237 c2 -131 0 -252 -3 -270z m2670 272 l25 -24 0 -1176 0 -1175 -90 0 -90 0 0 1200 0 1200 65 0 c57 0 69 -3 90 -25z m-1255 -3810 l0 -85 -850 0 c-937 0 -897 -3 -919 61 -6 18 -11 49 -11 70 l0 39 890 0 890 0 0 -85z"/>
                                    <path d="M1714 4675 c-54 -27 -84 -60 -102 -114 -9 -25 -12 -203 -12 -641 l0 -608 28 -53 c22 -43 38 -59 81 -81 l53 -28 612 0 c573 0 613 2 651 19 22 10 52 31 67 47 59 63 58 48 58 709 0 661 1 646 -58 709 -15 16 -45 37 -67 47 -38 17 -78 19 -651 19 l-610 0 -50 -25z m1268 -142 c17 -15 18 -47 18 -606 0 -535 -2 -592 -17 -609 -13 -15 -31 -18 -100 -18 l-83 0 0 130 c0 106 -4 139 -21 184 -24 65 -96 149 -150 177 l-39 20 17 32 c14 25 18 56 18 142 0 129 -15 166 -89 232 -124 109 -317 68 -392 -83 -26 -53 -28 -243 -2 -290 l17 -31 -38 -21 c-47 -27 -113 -97 -139 -149 -28 -53 -42 -139 -42 -250 l0 -93 -77 0 c-124 0 -113 -63 -113 623 0 535 2 592 17 609 15 17 47 18 606 18 535 0 592 -2 609 -17z m-540 -432 c32 -29 33 -31 33 -115 0 -79 -2 -88 -26 -112 -16 -16 -41 -28 -67 -31 -37 -5 -45 -2 -77 30 -34 34 -35 37 -35 112 0 74 1 78 34 111 45 45 92 47 138 5z m86 -426 c47 -20 79 -50 103 -97 16 -31 19 -59 19 -158 l0 -120 -280 0 -280 0 0 90 c0 118 14 178 52 225 50 60 94 75 231 75 84 0 128 -4 155 -15z"/>
                                    <path d="M1130 3543 c-8 -3 -79 -69 -157 -146 -125 -123 -143 -146 -143 -174 0 -22 8 -38 26 -52 52 -41 67 -32 221 122 130 130 143 146 143 178 0 49 -47 87 -90 72z"/>
                                    <path d="M873 2710 c-44 -18 -57 -86 -23 -120 20 -20 33 -20 1124 -20 1037 0 1105 1 1124 18 12 9 24 29 28 44 5 22 0 33 -24 58 l-30 30 -1089 -1 c-602 0 -1098 -4 -1110 -9z"/>
                                    <path d="M855 2315 c-32 -31 -33 -74 -2 -103 l23 -22 618 0 c402 0 624 4 636 10 50 27 49 100 0 125 -25 13 -120 15 -640 15 l-611 0 -24 -25z"/>
                                    <path d="M855 1935 c-32 -31 -33 -74 -2 -103 23 -22 28 -22 348 -22 l326 0 21 23 c31 33 29 80 -4 106 -26 20 -38 21 -346 21 l-319 0 -24 -25z"/>
                                    <path d="M1813 1948 c-48 -24 -51 -103 -4 -127 11 -6 82 -11 166 -11 143 0 146 0 172 26 20 20 24 31 19 57 -12 58 -22 62 -184 64 -91 2 -155 -2 -169 -9z"/>
                                    <path d="M4061 1614 c-20 -8 -136 -116 -273 -252 l-238 -236 -83 81 c-148 148 -218 151 -359 16 -96 -92 -128 -143 -128 -205 0 -27 6 -61 14 -76 8 -15 106 -118 218 -229 192 -191 206 -202 261 -218 68 -20 120 -14 187 21 62 31 733 704 755 756 20 49 19 84 -4 133 -21 46 -175 199 -215 215 -38 14 -95 12 -135 -6z m151 -201 c38 -37 68 -72 68 -77 0 -6 -152 -162 -337 -348 -342 -342 -373 -368 -425 -353 -25 7 -388 363 -388 380 0 12 141 155 154 155 6 0 62 -52 126 -115 94 -93 122 -115 146 -115 24 0 71 42 299 270 148 148 274 270 280 270 5 0 40 -30 77 -67z"/>
                                    <path d="M856 1559 c-34 -27 -36 -77 -3 -107 l23 -22 623 0 622 0 24 25 c32 31 32 69 0 100 l-24 25 -619 0 c-611 0 -620 0 -646 -21z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="icon-content">
                            <h4 class="title">Rezyon'a Kayıt Ol</h4>
                            <p class="text">Turizm firması veya tedarikçi firması olarak kayıt olduktan sonra sizden istenilen belgeleri tarafımıza iletmeniz gerekmektedir. Daha sonrasında bir aktivasyon sürecinden geçtikten sonra hesabınız aktif edilecektir. Burada firmanız sistemimize kaydedilip size yönetici hesabı verilecektir.</p>
                        </div>
                        <h3 class="count">01</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 m-b30">
                    <div class="icon-bx-wraper style-1 bg-clr-pink wow bounceInUp" data-wow-delay="1.0s">
                        <div class="icon-media">
                            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" version="1.0" width="70" height="70" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                    <path d="M80 4452 l0 -589 463 -167 c437 -159 469 -173 599 -250 83 -48 138 -87 138 -97 0 -42 37 -116 76 -156 32 -32 58 -47 102 -59 l59 -17 17 -59 c23 -81 82 -141 163 -164 l58 -16 18 -58 c18 -64 88 -145 133 -156 22 -6 34 -24 16 -24 -21 0 -224 -145 -294 -210 -160 -148 -313 -396 -372 -602 -75 -263 -72 -558 10 -806 116 -348 364 -636 690 -800 84 -42 242 -96 349 -118 121 -25 383 -26 505 -1 371 74 692 290 892 602 254 394 287 895 87 1314 -71 151 -150 262 -264 377 -103 104 -241 203 -366 264 l-66 33 13 36 c7 20 13 43 14 52 0 11 13 19 37 24 101 19 179 96 198 197 6 33 11 37 46 43 96 16 185 115 196 217 l5 55 177 105 176 105 480 148 c264 81 508 156 543 167 l62 19 0 589 0 590 -250 0 -250 0 -560 -320 -561 -320 -62 0 c-47 0 -125 18 -322 74 -143 40 -282 76 -310 80 -27 4 -135 34 -240 67 -280 89 -299 93 -465 93 -143 0 -149 -1 -444 -67 l-300 -68 -346 231 -345 230 -253 0 -252 0 0 -588z m781 210 l326 -217 -99 -365 c-55 -201 -102 -367 -104 -369 -2 -2 -170 56 -374 130 l-370 134 0 453 0 452 148 0 147 0 326 -218z m4017 -233 l-3 -451 -450 -139 c-247 -76 -456 -139 -462 -139 -7 0 -102 133 -210 296 -158 236 -194 298 -183 305 8 4 238 136 510 293 l495 284 153 1 152 1 -2 -451z m-2693 112 c50 -11 115 -28 145 -39 l55 -19 -222 -112 c-248 -125 -281 -151 -310 -250 -50 -173 59 -340 232 -358 74 -8 108 6 307 124 196 116 233 128 300 96 40 -20 715 -623 735 -657 20 -34 15 -66 -16 -97 -21 -21 -39 -29 -64 -29 -40 0 -40 0 -312 228 l-180 152 -52 -58 c-29 -31 -52 -59 -52 -62 0 -3 98 -86 217 -185 136 -113 220 -190 226 -207 19 -55 -26 -108 -94 -108 -31 0 -60 22 -330 249 l-155 130 -52 -57 c-29 -31 -52 -59 -52 -62 0 -3 98 -86 217 -185 136 -113 220 -190 226 -207 18 -52 -26 -108 -87 -108 -26 0 -80 31 -119 68 -23 21 -28 34 -28 72 0 117 -71 215 -178 247 l-60 18 -16 58 c-23 81 -83 140 -164 163 l-59 17 -17 59 c-23 82 -82 141 -164 164 l-59 17 -17 59 c-41 146 -206 218 -347 150 -28 -13 -96 -73 -178 -157 l-134 -134 -93 56 c-58 34 -94 62 -94 72 0 22 205 770 213 778 4 3 75 21 159 40 450 102 510 108 673 74z m804 -221 c218 -62 296 -80 345 -80 l63 0 201 -303 c111 -166 202 -305 202 -309 0 -4 -61 -43 -135 -88 l-135 -81 -357 322 c-375 337 -409 362 -509 375 -93 11 -144 -7 -344 -127 -169 -101 -188 -110 -224 -106 -55 8 -88 43 -93 104 -8 76 8 88 281 225 132 67 259 127 281 134 80 25 131 18 424 -66z m-1178 -669 c20 -21 29 -39 29 -62 0 -29 -17 -50 -138 -171 -121 -121 -142 -138 -171 -138 -45 0 -91 46 -91 91 0 29 17 50 138 171 121 121 142 138 171 138 23 0 41 -9 62 -29z m240 -240 c20 -21 29 -39 29 -62 0 -29 -17 -50 -138 -171 -121 -121 -142 -138 -171 -138 -45 0 -91 46 -91 91 0 29 17 50 138 171 121 121 142 138 171 138 23 0 41 -9 62 -29z m240 -240 c20 -21 29 -39 29 -62 0 -29 -17 -50 -138 -171 -121 -121 -142 -138 -171 -138 -45 0 -91 46 -91 91 0 29 17 50 138 171 121 121 142 138 171 138 23 0 41 -9 62 -29z m240 -240 c20 -21 29 -39 29 -62 0 -29 -17 -50 -138 -171 -121 -121 -142 -138 -171 -138 -45 0 -91 46 -91 91 0 29 17 50 138 171 121 121 142 138 171 138 23 0 41 -9 62 -29z m153 -301 c38 -42 43 -63 25 -103 -26 -58 -102 -62 -160 -10 l-40 36 58 59 c31 32 63 58 69 58 6 0 28 -18 48 -40z m402 -114 c432 -213 691 -646 671 -1121 -14 -314 -131 -580 -351 -801 -171 -170 -371 -280 -606 -330 -106 -23 -352 -26 -455 -5 -375 74 -689 312 -859 648 -131 261 -161 581 -79 863 29 102 105 264 163 350 90 132 245 275 387 356 l76 43 39 -40 c22 -22 55 -47 75 -55 l35 -15 -72 -35 c-153 -73 -323 -219 -411 -354 -212 -321 -236 -707 -67 -1044 53 -107 88 -156 177 -249 126 -132 257 -216 426 -274 296 -101 652 -50 915 130 67 47 194 172 249 246 295 401 260 957 -84 1320 -117 123 -231 200 -388 262 -43 16 -71 33 -70 41 11 68 28 107 47 111 52 10 78 4 182 -47z m-371 -211 c174 -31 337 -117 465 -245 344 -343 344 -898 1 -1241 -343 -343 -898 -343 -1241 1 -345 344 -345 896 0 1240 206 206 487 295 775 245z"/>
                                    <path d="M2480 2081 l0 -79 -47 -7 c-103 -15 -196 -84 -243 -180 -19 -41 -24 -66 -24 -135 -1 -78 2 -90 33 -148 38 -70 70 -101 145 -139 46 -24 65 -27 203 -32 132 -5 155 -9 179 -27 53 -39 69 -71 69 -134 0 -63 -16 -95 -69 -134 -25 -19 -42 -21 -166 -21 -124 0 -141 2 -166 21 -53 39 -68 70 -72 144 l-4 70 -81 0 -80 0 5 -84 c9 -135 65 -224 177 -281 26 -13 68 -26 94 -30 l47 -7 0 -79 0 -79 80 0 80 0 0 79 0 79 47 7 c53 8 125 41 170 79 16 14 45 53 64 88 31 58 34 70 34 148 0 78 -3 90 -34 148 -38 70 -70 101 -145 139 -46 24 -65 27 -203 32 -164 6 -180 12 -227 75 -29 39 -29 133 0 172 45 61 66 69 192 72 67 2 132 -1 153 -7 46 -14 96 -69 105 -116 l6 -35 80 0 80 0 -7 48 c-8 59 -59 155 -98 188 -45 38 -117 71 -170 79 l-47 7 0 79 0 79 -80 0 -80 0 0 -79z"/>
                                    <path d="M446 2489 c-148 -198 -267 -362 -264 -365 3 -2 31 -24 64 -48 l58 -44 166 221 165 221 3 -837 2 -837 80 0 80 0 2 837 3 837 165 -221 166 -221 58 44 c33 24 61 46 64 48 5 6 -529 725 -538 725 -3 0 -126 -162 -274 -360z"/>
                                    <path d="M4126 2489 c-148 -198 -267 -362 -264 -365 3 -2 31 -24 64 -48 l58 -44 166 221 165 221 3 -837 2 -837 80 0 80 0 2 837 3 837 165 -221 166 -221 58 44 c33 24 61 46 64 48 5 6 -529 725 -538 725 -3 0 -126 -162 -274 -360z"/>
                                    <path d="M640 560 l0 -80 80 0 80 0 0 80 0 80 -80 0 -80 0 0 -80z"/>
                                    <path d="M4320 560 l0 -80 80 0 80 0 0 80 0 80 -80 0 -80 0 0 -80z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="icon-content">
                            <h4 class="title">Aktivite Oluştur/Sat</h4>
                            <p class="text">Tedarikçi firması olarak kayıt olduktan sonra satış yapmak için sisteme satışa açık bir aktivite eklemeniz gerekmektedir. Turizm firmaları bu aktiviteleri aktivite mağazasında görebilir ve aktivite havuzuna tedarikçi firmasının belirlediği fiyatına eşit veya üstünde özel fiyat belirleyip müşterilerine satabilir.</p>
                        </div>
                        <h3 class="count">02</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 m-b30">
                    <div class="icon-bx-wraper style-1 bg-clr-green wow bounceInRight" data-wow-delay="1.2s">
                        <div class="icon-media">
                            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" version="1.0" width="70" height="70" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                    <path d="M105 5106 c-42 -18 -93 -79 -100 -118 -3 -18 -4 -999 -3 -2179 l3 -2146 29 -37 c39 -52 95 -76 179 -76 l67 0 0 -65 c0 -71 18 -126 53 -163 36 -38 57 -46 147 -52 l85 -5 5 -80 c6 -95 27 -132 93 -164 43 -21 47 -21 1248 -21 l1204 0 367 368 368 367 0 388 0 387 68 0 c143 0 335 46 490 116 93 43 112 59 112 96 0 40 -16 67 -47 79 -21 8 -42 1 -126 -37 -368 -169 -790 -128 -1111 108 l-69 50 370 370 369 369 502 -132 c473 -125 502 -134 496 -154 -17 -59 -101 -212 -158 -290 -36 -48 -66 -95 -66 -105 0 -34 39 -70 77 -70 42 0 78 35 154 150 87 131 148 275 186 442 24 106 24 375 -1 486 -55 255 -173 470 -355 645 -219 211 -485 328 -783 344 l-107 6 -3 237 -3 237 -29 37 c-39 52 -95 76 -177 76 l-66 0 -5 74 c-9 132 -64 186 -199 194 l-79 5 0 37 c0 63 -19 140 -41 172 -12 17 -40 39 -63 49 -39 18 -99 19 -1546 18 -1222 0 -1511 -2 -1535 -13z m3025 -155 c5 -11 10 -40 10 -65 l0 -46 -879 0 c-873 0 -878 0 -905 -21 -33 -26 -36 -79 -6 -109 20 -20 33 -20 1033 -20 775 0 1016 -3 1025 -12 7 -7 12 -34 12 -60 l0 -48 -1368 -2 -1368 -3 -41 -27 c-80 -53 -73 145 -73 -2107 l0 -2012 -67 3 -68 3 -3 2119 c-1 1558 1 2122 9 2132 9 11 68 14 290 14 266 0 280 1 299 20 30 30 27 83 -7 110 -26 21 -34 21 -323 18 -288 -3 -296 -4 -332 -26 -20 -13 -47 -40 -60 -60 l-23 -37 -3 -2008 -2 -2008 -63 3 -62 3 -3 2120 c-1 1166 0 2126 3 2133 3 9 310 12 1484 12 1453 0 1480 0 1491 -19z m568 -758 c3 -247 10 -224 -73 -238 -72 -12 -199 -56 -286 -100 -330 -163 -558 -444 -656 -805 -34 -129 -44 -380 -19 -515 69 -374 289 -685 614 -869 84 -48 222 -102 307 -121 39 -8 80 -18 93 -20 l22 -5 0 -335 0 -335 -262 0 c-150 0 -279 -5 -300 -10 -48 -14 -97 -55 -114 -97 -11 -25 -14 -99 -14 -313 l0 -280 -1142 2 -1143 3 -3 2120 c-1 1166 0 2126 3 2133 3 10 306 12 1487 10 l1483 -3 3 -222z m363 -378 c46 -8 110 -22 141 -32 l57 -18 -220 -490 -220 -490 -379 -379 -378 -379 -51 69 c-96 130 -166 289 -195 444 -20 105 -21 304 -1 407 84 443 432 787 878 868 98 18 267 18 368 0z m421 -164 c326 -213 522 -621 481 -1005 -6 -53 -12 -98 -14 -100 -4 -4 -950 243 -957 250 -6 4 401 904 409 904 3 0 40 -22 81 -49z m-1103 -3169 l-214 -218 -3 210 c-2 161 1 211 10 218 7 4 105 8 217 8 l203 0 -213 -218z"/>
                                    <path d="M1161 3854 c-24 -31 -26 -43 -9 -79 7 -16 24 -29 47 -36 24 -7 285 -9 779 -7 l744 3 19 24 c25 30 24 76 -1 101 -20 20 -33 20 -789 20 l-770 0 -20 -26z"/>
                                    <path d="M1161 3304 c-12 -15 -21 -33 -21 -40 0 -28 24 -63 49 -74 18 -7 205 -10 610 -8 l583 3 19 24 c25 30 24 76 -1 101 -20 20 -33 20 -619 20 l-600 0 -20 -26z"/>
                                    <path d="M1161 2754 c-12 -15 -21 -33 -21 -40 0 -28 24 -63 49 -74 18 -7 182 -10 530 -8 l503 3 19 24 c25 30 24 72 -1 99 l-21 22 -519 0 -519 0 -20 -26z"/>
                                    <path d="M1670 1920 c-19 -19 -20 -33 -20 -265 l0 -245 -169 0 -170 0 -20 -26 c-20 -26 -21 -39 -21 -304 l0 -277 -41 -6 c-22 -3 -49 -13 -60 -23 -25 -23 -25 -78 1 -104 20 -20 33 -20 740 -20 707 0 720 0 740 20 46 46 13 117 -58 127 l-42 6 0 372 c0 362 -1 373 -21 399 l-20 26 -170 0 -169 0 0 148 c0 206 20 192 -260 192 -207 0 -221 -1 -240 -20z m350 -625 l0 -495 -110 0 -110 0 0 495 0 495 110 0 110 0 0 -495z m380 -170 l0 -325 -115 0 -115 0 0 325 0 325 115 0 115 0 0 -325z m-750 -95 l0 -230 -115 0 -115 0 0 230 0 230 115 0 115 0 0 -230z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="icon-content">
                            <h4 class="title">Raporları Al</h4>
                            <p class="text">Gün/Hafta/Ay sonu raporlarınızı grafiksel olarak alın. Tüm satışlarınızı detaylı olarak gözden geçirin.</p>
                        </div>
                        <h3 class="count">03</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-inner overflow-hidden position-relative">
        <div class="container">
            <div class="section-head text-center">
                <h6 class="text wow fadeInUp" data-wow-delay="0.6s">Rezyon ile ilgili bazı özellikler</h6>
                <h2 class="title wow fadeInUp" data-wow-delay="0.8s">Özellikler</h2>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper style-2 text-center wow fadeInUp" data-wow-delay="1.0s" >
                        <div class="icon-media">
                            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" version="1.0" width="56" height="56" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                    <path d="M685 5108 c-27 -5 -87 -27 -133 -49 -150 -72 -259 -208 -302 -374 -20 -77 -20 -112 -20 -1770 0 -1658 0 -1693 20 -1770 49 -193 183 -336 380 -407 l65 -23 735 -3 735 -3 52 -78 c151 -224 399 -421 661 -525 611 -244 1316 -46 1712 482 389 519 395 1221 13 1743 -196 270 -515 484 -830 559 l-53 12 0 491 c-1 361 -4 499 -13 519 -17 38 -1113 1187 -1144 1199 -32 12 -1811 10 -1878 -3z m1735 -588 c6 -413 7 -422 62 -517 56 -99 143 -170 264 -215 55 -20 81 -22 412 -26 l352 -4 0 -413 0 -413 -115 -1 c-318 -2 -655 -123 -896 -322 l-46 -38 -702 -3 -703 -3 -29 -33 c-57 -64 -29 -153 56 -172 22 -5 293 -10 603 -10 309 0 562 -2 562 -5 0 -2 -26 -44 -57 -92 -31 -48 -72 -121 -90 -161 l-34 -72 -505 0 -506 0 -29 -29 c-41 -41 -41 -98 0 -143 l29 -33 472 -3 472 -3 -5 -22 c-23 -94 -31 -174 -31 -312 1 -201 19 -310 91 -528 5 -17 -27 -17 -668 -15 l-674 3 -55 27 c-109 54 -180 151 -200 275 -13 78 -13 3278 0 3356 26 160 141 281 292 306 29 5 418 8 863 7 l810 -1 5 -385z m621 -205 l313 -330 -257 -3 c-244 -2 -260 -1 -307 19 -27 12 -67 41 -89 64 -65 70 -71 107 -71 414 l0 266 49 -50 c27 -28 190 -198 362 -380z m530 -1606 c294 -38 550 -167 754 -380 457 -478 461 -1230 9 -1719 -56 -60 -177 -159 -259 -212 -304 -194 -735 -237 -1087 -107 -373 137 -661 447 -772 830 -38 134 -49 234 -43 398 12 317 124 582 342 810 275 289 669 430 1056 380z"/>
                                    <path d="M1021 3069 c-55 -55 -37 -142 36 -170 14 -5 258 -9 579 -9 611 0 597 -1 630 61 22 43 11 91 -27 123 l-31 26 -578 0 -578 0 -31 -31z"/>
                                    <path d="M3373 2273 c-29 -16 -628 -649 -667 -705 -9 -12 -16 -40 -16 -61 0 -77 83 -122 157 -85 12 6 120 116 240 245 l218 234 5 -593 c4 -456 8 -598 18 -615 15 -26 61 -53 92 -53 31 0 77 27 92 53 10 17 14 159 18 616 l5 593 220 -237 c134 -146 232 -243 252 -251 85 -36 175 62 130 143 -12 21 -587 642 -644 694 -38 36 -80 44 -120 22z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="icon-content">
                            <h5 class="fs-20 mb-0"><a href="javascript:void(0);">Toplu Müşteri Entegrasyonu</a></h5>
                            <p class="text"><a href="javascript:void(0);">Uçakla gelen müşterileri excel dosyası ile toplu entegre edin.</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper style-2 text-center wow fadeInUp" data-wow-delay="1.2s" >
                        <div class="icon-media">
                            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" version="1.0" width="56" height="56" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                    <path d="M1229 5101 c-110 -35 -188 -110 -230 -221 -17 -45 -22 -79 -23 -186 -1 -117 1 -134 18 -153 26 -28 86 -29 112 0 15 17 19 43 24 157 3 75 11 146 17 157 19 34 76 83 115 99 32 14 104 16 488 16 l450 0 0 -63 c0 -128 50 -219 144 -263 47 -22 64 -24 216 -24 152 0 169 2 216 24 94 44 144 135 144 263 l0 63 453 0 c416 0 455 -2 492 -19 53 -24 112 -90 122 -138 4 -21 8 -216 8 -433 l0 -395 -1432 -3 -1431 -2 -4 144 c-4 166 -12 186 -78 186 -63 0 -69 -16 -72 -180 l-3 -145 -220 -5 c-209 -5 -222 -6 -258 -28 -56 -36 -71 -71 -77 -187 l-5 -100 -107 -5 c-105 -5 -108 -6 -140 -38 l-33 -32 -3 -136 c-4 -146 2 -176 45 -216 22 -20 37 -24 131 -28 l107 -5 3 -62 3 -63 -98 0 c-80 0 -104 -4 -130 -20 -53 -32 -63 -63 -63 -205 0 -202 20 -227 188 -233 l102 -4 0 -58 0 -58 -102 -4 c-168 -6 -188 -31 -188 -233 0 -142 10 -173 63 -205 26 -16 50 -20 130 -20 l98 0 -3 -63 -3 -62 -107 -5 c-105 -5 -108 -6 -140 -38 l-33 -32 0 -155 0 -155 33 -32 c32 -32 35 -33 140 -38 l107 -5 5 -100 c6 -119 24 -157 89 -192 42 -22 54 -23 252 -23 l207 0 4 -422 c4 -406 5 -425 25 -477 46 -114 124 -188 234 -222 58 -18 116 -19 1329 -19 1213 0 1271 1 1329 19 110 34 188 108 234 222 20 52 21 71 25 477 l4 422 206 0 c188 0 209 2 248 21 68 32 88 74 94 194 l5 100 107 5 c105 5 108 6 140 38 l33 32 3 136 c4 146 -2 176 -45 216 -22 20 -37 24 -131 28 l-107 5 -3 63 -3 62 98 0 c80 0 104 4 130 20 53 32 63 63 63 205 0 202 -20 227 -187 233 l-103 4 0 58 0 58 103 4 c166 6 187 32 187 233 0 142 -10 173 -63 205 -26 16 -50 20 -130 20 l-98 0 3 63 3 62 107 5 c94 4 109 8 131 28 43 40 49 70 45 216 l-3 136 -33 32 c-32 32 -35 33 -140 38 l-107 5 -5 100 c-6 119 -24 157 -89 192 -42 22 -54 23 -252 23 l-207 0 -4 423 c-4 405 -5 424 -25 476 -46 114 -124 188 -234 222 -58 18 -115 19 -1332 18 -1194 0 -1275 -1 -1328 -18z m1541 -191 c0 -66 -18 -113 -49 -130 -11 -5 -83 -10 -161 -10 -78 0 -150 5 -161 10 -31 17 -49 64 -49 130 l0 60 210 0 210 0 0 -60z m1778 -1167 l3 -83 -96 0 c-167 0 -185 -22 -185 -225 0 -203 18 -225 185 -225 l95 0 0 -64 0 -64 -106 -4 -106 -3 -34 -37 -34 -38 0 -143 c0 -133 2 -147 23 -178 29 -44 71 -58 175 -58 l82 -1 0 -60 0 -60 -85 0 c-102 0 -147 -16 -175 -62 -17 -29 -20 -50 -20 -176 l0 -142 34 -38 34 -37 106 -3 106 -4 0 -64 0 -64 -95 0 c-167 0 -185 -22 -185 -225 0 -203 18 -225 185 -225 l96 0 -3 -82 -3 -83 -923 -5 -924 -5 -19 -24 c-26 -32 -24 -67 6 -96 l24 -25 641 0 640 0 0 -320 0 -320 -1430 0 -1430 0 0 320 0 320 640 0 641 0 24 25 c30 29 32 64 6 96 l-19 24 -924 5 -923 5 -3 83 -3 82 96 0 c167 0 185 22 185 225 0 203 -18 225 -185 225 l-95 0 0 64 0 64 106 4 106 3 34 37 34 38 0 142 c0 126 -3 147 -20 176 -28 46 -73 62 -175 62 l-85 0 0 60 0 60 83 1 c103 0 145 14 174 58 21 31 23 45 23 178 l0 143 -34 38 -34 37 -106 3 -106 4 0 64 0 64 98 0 c106 1 132 9 163 56 16 25 19 47 19 167 0 205 -17 227 -185 227 l-95 0 0 78 c0 43 3 82 7 85 3 4 898 6 1987 5 l1981 -3 3 -82z m-3848 -308 l0 -75 -210 0 -210 0 0 75 0 75 210 0 210 0 0 -75z m4140 0 l0 -75 -210 0 -210 0 0 75 0 75 210 0 210 0 0 -75z m-4140 -585 l0 -80 -210 0 -210 0 0 80 0 80 210 0 210 0 0 -80z m4140 0 l0 -80 -210 0 -210 0 0 80 0 80 210 0 210 0 0 -80z m-4140 -580 l0 -80 -210 0 -210 0 0 80 0 80 210 0 210 0 0 -80z m4140 0 l0 -80 -210 0 -210 0 0 80 0 80 210 0 210 0 0 -80z m-4140 -585 l0 -75 -210 0 -210 0 0 75 0 75 210 0 210 0 0 -75z m4140 0 l0 -75 -210 0 -210 0 0 75 0 75 210 0 210 0 0 -75z m-850 -1354 c0 -54 -61 -133 -125 -162 -38 -18 -103 -19 -1305 -19 -1211 0 -1267 1 -1305 19 -68 32 -125 105 -125 162 0 19 23 19 1430 19 1407 0 1430 0 1430 -19z"/>
                                    <path d="M1065 3560 c-52 -27 -73 -57 -86 -124 -6 -35 -9 -301 -7 -718 3 -598 5 -666 20 -693 25 -44 448 -462 481 -474 19 -8 421 -11 1283 -11 1043 0 1260 2 1287 14 52 22 86 66 97 125 13 71 14 1689 0 1760 -12 65 -34 95 -86 121 -40 20 -57 20 -1495 20 -1440 0 -1454 0 -1494 -20z m2925 -1000 l0 -870 -1232 0 -1233 0 -197 197 -198 198 0 672 0 673 1430 0 1430 0 0 -870z"/>
                                    <path d="M2275 2931 c-136 -33 -210 -169 -156 -287 25 -55 65 -83 192 -133 139 -55 170 -87 134 -138 -40 -57 -160 -51 -236 13 -47 39 -89 44 -119 14 -67 -67 35 -177 194 -210 71 -14 134 -6 196 25 56 28 83 57 109 115 27 60 26 106 -4 166 -33 66 -83 101 -221 156 -95 38 -109 47 -112 69 -8 66 104 87 190 36 60 -35 100 -35 127 -1 25 32 26 52 5 82 -48 70 -201 117 -299 93z"/>
                                    <path d="M2755 2915 l-25 -24 0 -331 0 -331 25 -24 c27 -28 42 -30 78 -14 44 20 47 42 47 369 0 327 -3 349 -47 369 -36 16 -51 14 -78 -14z"/>
                                    <path d="M3149 2925 c-14 -8 -31 -27 -37 -42 -13 -34 -112 -588 -112 -626 0 -37 33 -67 73 -67 55 0 66 22 100 209 17 94 34 167 37 163 4 -4 26 -74 50 -157 23 -82 49 -162 56 -176 25 -50 101 -61 139 -19 8 9 36 91 62 181 25 90 49 167 53 172 3 4 19 -61 34 -145 16 -84 34 -167 42 -185 14 -37 52 -51 93 -37 55 20 55 32 -10 374 -57 303 -61 316 -89 343 -37 33 -70 34 -107 3 -25 -21 -37 -51 -83 -215 -29 -105 -56 -191 -60 -191 -3 0 -31 84 -61 187 -31 108 -62 197 -74 210 -25 29 -72 37 -106 18z"/>
                                    <path d="M1533 2834 c-61 -22 -137 -95 -169 -161 -24 -48 -28 -68 -27 -137 2 -151 65 -256 191 -318 57 -28 76 -33 142 -32 149 0 258 88 203 162 -28 37 -66 39 -130 7 -44 -23 -61 -26 -96 -21 -47 8 -111 45 -127 76 -11 20 -8 20 168 20 242 0 262 8 262 108 0 115 -63 223 -161 276 -44 25 -67 30 -134 33 -54 2 -94 -2 -122 -13z m199 -159 c27 -21 58 -65 58 -84 0 -7 -48 -11 -150 -11 -82 0 -150 3 -150 8 0 19 43 74 72 93 42 26 131 23 170 -6z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="icon-content">
                            <h5 class="fs-20 mb-0"><a href="javascript:void(0);">eSim</a></h5>
                            <p class="text"><a href="javascript:void(0);">Yurt dışından gelen müşterilere elektronik sim kartı hizmeti sağlayın.</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper style-2 text-center wow fadeInUp" data-wow-delay="1.4s" >
                        <div class="icon-media">
                            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" version="1.0" width="56" height="56" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                    <path d="M346 5024 c-34 -11 -64 -31 -102 -68 -92 -93 -84 140 -84 -2396 0 -2533 -8 -2303 83 -2394 93 -93 -12 -87 1377 -84 l1215 3 45 24 c61 32 97 67 128 126 l27 50 3 617 3 618 857 2 857 3 50 27 c59 31 94 67 126 128 l24 45 3 775 c3 892 7 846 -84 937 -87 87 -35 83 -996 83 l-838 0 0 639 c0 737 3 708 -86 798 -89 89 10 83 -1358 82 -1038 0 -1208 -2 -1250 -15z m745 -281 c24 -97 41 -145 56 -160 l22 -23 431 0 431 0 22 23 c15 15 32 63 56 160 l33 138 334 -3 334 -3 32 -33 33 -32 0 -2250 0 -2250 -33 -32 -32 -33 -1210 0 -1210 0 -32 33 -33 32 0 2249 0 2249 25 27 c14 15 34 31 45 35 11 5 165 9 341 9 l322 1 33 -137z m867 57 l-20 -80 -338 0 -338 0 -20 80 -20 80 378 0 378 0 -20 -80z m2803 -1476 c23 -23 33 -44 36 -78 l6 -46 -882 0 -881 0 0 80 0 80 845 -2 845 -3 31 -31z m39 -364 l0 -80 -880 0 -880 0 0 80 0 80 880 0 880 0 0 -80z m-2 -725 l-3 -485 -33 -32 -32 -33 -845 -3 -845 -2 0 80 0 80 175 0 c173 0 176 0 200 25 l25 24 0 271 0 271 -25 24 c-24 25 -27 25 -200 25 l-175 0 0 120 0 120 880 0 881 0 -3 -485z m-1518 -75 l0 -160 -120 0 -120 0 0 160 0 160 120 0 120 0 0 -160z"/>
                                    <path d="M1457 3509 c-128 -19 -291 -83 -406 -161 -82 -55 -222 -207 -272 -293 -103 -179 -134 -295 -133 -495 1 -205 39 -345 142 -510 58 -94 195 -233 288 -293 164 -106 324 -152 529 -152 195 1 314 33 490 134 109 63 263 217 326 326 102 177 133 294 133 495 0 201 -32 321 -133 495 -62 107 -208 254 -320 323 -189 116 -423 163 -644 131z m333 -172 c100 -28 168 -57 243 -107 427 -278 490 -875 131 -1234 -359 -359 -956 -296 -1234 131 -89 136 -125 259 -125 433 0 174 36 297 124 432 119 182 304 308 521 354 80 17 262 12 340 -9z"/>
                                    <path d="M1779 2613 l-268 -266 -142 106 c-156 117 -181 126 -224 82 -27 -26 -33 -71 -12 -98 6 -9 90 -75 186 -147 135 -100 181 -130 205 -130 27 0 68 38 333 303 274 273 303 305 303 335 0 44 -38 82 -82 82 -29 0 -59 -27 -299 -267z"/>
                                    <path d="M1225 455 c-16 -15 -25 -36 -25 -55 0 -19 9 -40 25 -55 l24 -25 351 0 351 0 24 25 c16 15 25 36 25 55 0 19 -9 40 -25 55 l-24 25 -351 0 -351 0 -24 -25z"/>
                                    <path d="M3785 2455 c-16 -15 -25 -36 -25 -55 0 -19 9 -40 25 -55 l24 -25 391 0 391 0 24 25 c16 15 25 36 25 55 0 19 -9 40 -25 55 l-24 25 -391 0 -391 0 -24 -25z"/>
                                    <path d="M3785 2215 c-16 -15 -25 -36 -25 -55 0 -19 9 -40 25 -55 l24 -25 391 0 391 0 24 25 c16 15 25 36 25 55 0 19 -9 40 -25 55 l-24 25 -391 0 -391 0 -24 -25z"/>
                                    <path d="M4185 1975 c-16 -15 -25 -36 -25 -55 0 -19 9 -40 25 -55 24 -25 26 -25 215 -25 189 0 191 0 215 25 16 15 25 36 25 55 0 19 -9 40 -25 55 -24 25 -26 25 -215 25 -189 0 -191 0 -215 -25z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="icon-content">
                            <h5 class="fs-20 mb-0"><a href="javascript:void(0);">Online Ödeme</a></h5>
                            <p class="text"><a href="javascript:void(0);">Sisteme entegre olan sanal pos ile online ödeme alın.</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="icon-bx-wraper style-2 bg-primary text-center wow fadeInUp" data-wow-delay="2.4s" >
                        <div class="icon-content">
                            <h4 class="title"><a href="javascript:void(0);">Ve Daha Fazlası...</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-inner-1 overflow-hidden position-relative bg-white">
        <div class="container">
            <div class="section-head text-center">
                <h6 class="text wow fadeInUp" data-wow-delay="0.6s">Rezyon'la İlgili Soruların Cevapları</h6>
                <h2 class="title wow fadeInUp" data-wow-delay="0.8s">Sıkça Sorulan Sorular</h2>
            </div>
            <div class="accordion" id="accordionFaq">
                <div class="accordion-item bg-light">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Rezyon'a nasıl kayıt olurum? Süreç nasıl işliyor?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            Rezyon'a turizm firması veya tedarikçi firması olarak kayıt olduğunuzda yüklemeniz gereken belgeler olacak belgeleri bize ilettiğinizde hesabınızın aktivasyon süreci başlayacak. Hesabınız aktif olduğunda kayıt olduğunuz bilgilerle size bir kullanıcı oluşturulacak ve sistemi kullanmaya başlayacaksınız.
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-light">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Demo hesabı açabilir miyim?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            Elbette. Demo talep formunu doldurduktan sonra aktivasyon süreciniz olacak bu süreçten sonra 1 aylık deneme paketinden faydalanıp sistemi kullanabileceksiniz. 1 ay sonunda paketler üzerinden faturalandırılmaya başlayacaksınız.
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-light">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Hem turizm firması hem de tedarikçi firması olarak kayıt olabiliyor muyum?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            Elbette. Hem turizm firması iseniz hem de etkinlik (aktivite) tedariği yapıyor iseniz gerekli belgeleri sağladıktan sonra iki türlü hesap oluşturabilirsiniz.
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-light">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Üyeliğimi iptal edebiliyor muyum?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            Elbette. Üyeliğinizi iptal edebilirsiniz. Ancak burada dikkat edilmesi gereken bazı hususlar vardır.
                            Örneğin:
                            <ul>
                                <li>Turizm firması iseniz eğer aktif, tamamlanmamış olan satışlarınız varsa bunlar tamamlanana kadar iptaliniz onaylanmayacaktır. İptal talebinizi oluşturduğunuz andan itibaren, müşterileriniz yeni satın almalar yapamayacak ve tüm müşterilerin satın aldığı tüm etkinliklerin tarihi geçtikten sonra üyeliğiniz iptal olacak ve firmaya bağlı tüm müşteriler hesaplarına erişim sağlayamayacaktır.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection