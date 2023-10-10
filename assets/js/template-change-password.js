(function ($) {
  "use strict";
  
  $(document).ready(function () {
    $('#change-password-form').validate({
      ignore: ":hidden",
      rules: {
        old_password: {
          required: true,
        },
        password: {
          required: true,
          rangelength: [8, 32],
        },
        password_confirm: {
          rangelength: [8, 32],
          equalTo: "#password"
        }
      },
      messages: {
        old_password: {
          required: 'Mật khẩu cũ không được để trống'
        },
        password: {
          required: 'Mật khẩu không được để trống',
          rangelength: 'Độ dài tối thiểu của mật khẩu là 8 và tối đa là 32 kí tự'
        },
        password_confirm: {
          rangelength: 'Độ dài tối thiểu của mật khẩu là 8 và tối đa là 32 kí tự',
          equalTo: 'Mật khẩu không khớp'
        }
      },
      submitHandler: function (form) {
        $.ajax({
          url: changePasswordAjax.url,
          type: 'POST',
          data: ({
            action: 'paint_change_password',
            formData: $(form).serialize()
          }),
          success: function(response) {

          }
        })
      }
    })
  })
  
})(jQuery)