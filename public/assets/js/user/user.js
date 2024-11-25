(function () {
    'use strict'

    /**
     * add body navbar active attribute
     */
    $('body').attr("data-navbar-bottom", "active");

    function slideUpModalToggle(element) {
        if($(element).is(":visible") && $('.slideup-content', element).is(":visible")) {
            $('.slideup-content', element).hide("slide", { direction: "down" }, 400);
            $(element).hide();
        } else {
            $(element).show();
            $('.slideup-content', element).show("slide", { direction: "down" }, 400);
        }
    }

    $('[data-bs-toggle="slideup"]').click(function() {
        var target = $(this).attr('data-bs-target');
        slideUpModalToggle($(target));
    });

    $('.slideup-modal .close-slideup').click(function () {
        if($('.slideup-modal').is(":visible") && $('.slideup-modal .slideup-content').is(":visible")) {
            $('.slideup-modal .slideup-content').hide("slide", { direction: "down" }, 400);
            $('.slideup-modal').hide();
        }
    })

    $('.increase').click(function () {
        var value = parseInt($(this).prev().val(), 10);
        value = isNaN(value) ? 0 : value;
        value++;
        $(this).prev().val(value);
    });

    $('.decrease').click(function () {
        var value = parseInt($(this).next().val(), 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        $(this).next().val(value);
    });

})()