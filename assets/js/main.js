/**
 * Created by su on 03.08.2015.
 */

$().ready(function(){
    $('.phone input').inputmask('+7(999)999-99-99',{"placeholder": "_",clearMaskOnLostFocus: false});
    var formPhone = $('.form_phone');
    formPhone.submit(function() {
        var phone = formPhone.find('.phone input').val();
        phone = phone.replace(/[^0-9]/g, '');
        if(phone.length !== 11) {
            alert('Не верно указан телефон!');
            return false;
        }
        else {
            return true;
        }
    });
    formPhone.on('ajaxSuccess', function(ev, context, data, status, jqXHR) {
            if (data.error === true) {
                return console.log(arguments);
            } else {
                return $('.post_form').hide(1000);
            }
        });

});