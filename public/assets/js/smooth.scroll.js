/**
 * @description
 * @sample use  $("#elementId").smooth();
 */
jQuery.fn.extend({
    smooth: function() {
        var name = $(this).attr("smooth-name");
        var element = $("[smooth-name='"+name+"']");

        if (element){
                var cardBodies = element.find('.card-body');
                var offset = element.offset().top - 200

                cardBodies.on('mouseover',function(){
                    $(this).css('box-shadow', 'unset');
                });

                cardBodies.css('box-shadow', '0 0 20px rgba(0, 0, 0, 0.3)');
                setTimeout(()=>{
                    cardBodies.css('box-shadow', 'unset');
                },1000);
            }

            window.scrollTo({
                top: offset,
                behavior: 'smooth'
            });
        }
});