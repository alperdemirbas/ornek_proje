$('.content-body').addClass('mb-9');
// Start : Puanlama sistemi
jQuery.fn.extend({
    point: function(selector,star) {
        // 0.5 yıldız
        if(star < 1)
        {
            $(selector).html(''
                +'<i class="fa fa-star-half-stroke text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
            )
        }
        // 1 Yıldız
        else if(star == 1 )
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
            )
        }
        // 1.5 Yıldız
        else if(star > 1 && star <= 1.5)
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star-half-stroke text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
            )
        }

        // 2 Yıldız
        else if(star > 1.5 && star < 2.5)
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
            )
        }

        // 2.5 Yıldız
        else if(star > 2 && star < 3)
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star-half-stroke text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
            )
        }

        // 3 Yıldız
        else if(star > 2.5 && star < 3.5)
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
            )
        }

        // 3.5 Yıldız
        else if(star > 3 && star < 4)
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star-half-stroke text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
            )
        }


        // 4 Yıldız
        else if(star > 3.5 && star < 4.5)
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa-regular fa-star text-primary"></i>'
            )
        }

        // 4.5 Yıldız
        else if(star > 3.5 && star < 5)
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star-half-stroke text-primary"></i>'
            )
        }

        // 5 Yıldız
        else if(star > 4.5)
        {
            $(selector).html(''
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
                +'<i class="fa fa-star text-primary"></i>'
            )
        }
        else
        {
            console.error("Girilen puan aralığı 0.5 ile 5.00 arasında olmalıdır.");
        }
    },

    /* Start : Progress bar içini verilen yüzde kadar doldurur.
   *
   * Örnek 1 : $(document).progress_fill(".progress-bar",2.5);
   * Örnek 2 : $(document).progress_fill("#progress-bar",4.3);
   *
   */
    progress_fill: function(selector,point) {
        let percentage = Number(point * 20);
        $(selector).css({"width":+percentage+"%"})
    },
});
// End : Puanlama sistemi


/* Start : Taban yuvarlama fonksiyonu
*
* Örnek 1 : roundHalf(2.4) 2'ye yuvarlar
* Örnek 2 : roundHalf(2.7) 3'e yuvarlar
* Örnek 3 : roundHalf(4.4) 4'e yuvarlar
*/
const roundHalf = (num) => {
    return Math.round(num).toFixed(1);
};

/*
* Hizmet puanlarını ortalamasını göster.
*/
const service =  2.34;
const entertainment = 2.1;
const contact = 4.8;

const points_option = {
    service_point : null,
    set service(point){
        this.service = point;
    },

    entertainment_point : null,
    set entertainment(point){
        this.entertainment_point = point;
    },

    contact_point : null,
    set contact(point){
        this.contact_point = point;
    }
};

points_option.service_point = roundHalf(service);
$("#service_point").text(points_option.service_point);
$(document).progress_fill("#service",roundHalf(service))


points_option.entertainment_point = roundHalf(entertainment);
$("#entertainment_point").text(points_option.entertainment_point);
$(document).progress_fill("#entertainment",roundHalf(entertainment))

points_option.contact_point = roundHalf(contact);
$("#contact_point").text(points_option.contact_point);
$(document).progress_fill("#contact",roundHalf(contact));

$("#activity-calendar").datepicker($.extend({},
    $.datepicker.regional["tr"], {
        minDate: 0,
        dateFormat: 'yy-mm-dd'
    }
));

var swiper = new Swiper(".mySwiper", {
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        type: "fraction",
    },
    autoplay: {
        delay: 5000,
    },
});