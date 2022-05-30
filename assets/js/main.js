jQuery(document).ready(function ($) {

    const ccsForm = $('#custom-contact-form'),
        submitBtn = ccsForm.find(".ccf-submit"),
        inputTel = ccsForm.find("input[name='phone']");

    inputTel.inputmask(
        {
            "mask": "+99(999)-999-9999",
            showMaskOnHover: false,
        }
    );

    ccsForm.find("input").keyup(function () {
        let empty = true;
        ccsForm.find("input").each(function () {
            if (($(this).val().length !== 0) && inputTel.inputmask("isComplete")) {
                empty = false;
            } else {
                empty = true;
                return false;
            }
        });
        if (empty) {
            submitBtn.prop('disabled', true);
        } else {
            submitBtn.prop('disabled', false);
        }
    });

    ccsForm.on('submit', function (e) {

        e.preventDefault();
        const form_data = $(this).serializeArray();
        form_data.push({"name": "security", "value": ajax_ccf.ajax_nonce});
        form_data.push({"name": "action", "value": "send_form"});

        $.ajax({
            url: ajax_ccf.ajaxurl,
            type: 'post',
            data: form_data,
            success: function () {
                $(".success_msg").css("display", "block");
            },
            error: function () {
                $(".error_msg").css("display", "block");
            },
        });
        return false;
    });

});