/**
 * Created by su on 03.08.2015.
 */

$().ready(function(){
    $('.phone input').inputmask('+7(999)999-99-99',{"placeholder": "_",clearMaskOnLostFocus: false});
    var formPhone = $('.form_phone');
    formPhone.submit(function() {
        var phoneEl = formPhone.find('.phone input');
        var phone = phoneEl.val();
        phone = phone.replace(/[^0-9]/g, '');
        if(phone.length !== 11) {
            phoneEl.focus();
            $('.call_back .error').show();
            phoneEl.addClass('wrong');
            return false;
        }
        else {
            $('.call_back .error').hide();
            phoneEl.removeClass('wrong');
            return true;
        }
    });
    formPhone.on('ajaxSuccess', function(ev, context, data, status, jqXHR) {
            if (data && data.error === true) {
                return console.log(arguments);
            } else {
                return $('.post_form').hide(1000);
            }
        });

});
