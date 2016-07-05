jQuery(document).ready(function($) {
    $("#widget-subscribe-form").validate({
        submitHandler: function(form) {
            $(form).find('.input-group-addon').find('.icon-email2').removeClass('icon-email2').addClass('icon-line-loader icon-spin');
            $(form).ajaxSubmit({
                target: '#widget-subscribe-form-result',
                success: function() {
                    $(form).find('.input-group-addon').find('.icon-line-loader').removeClass('icon-line-loader icon-spin').addClass('icon-email2');
                    $('#widget-subscribe-form').find('.form-control').val('');
                    $('#widget-subscribe-form-result').attr('data-notify-msg', $('#widget-subscribe-form-result').html()).html('');
                    SEMICOLON.widget.notifications($('#widget-subscribe-form-result'));
                }
            });
        }
    });
});