/**
 * Created by su on 03.08.2015.
 */

$().ready(function(){
    $('.phone input').inputmask('+7(999)999-99-99',{"placeholder": "_",clearMaskOnLostFocus: false});
        $('.form_phone').on('ajaxSuccess', function(ev, context, data, status, jqXHR) {
            if (data.error === true) {
                return console.log(arguments);
            } else {
                return $('.post_form').hide(1000);
            }
        });

});