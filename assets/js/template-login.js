(function ($) {
  "use strict";

  $(document).ready(function () {
    console.log(window.location.hostname)
    // handle login
    $('.btn-submit-login').on('click', function (e) {
      e.preventDefault()

      const fromUser = $(this).closest('.form-user')
      const userName = fromUser.find('#username').val()
      const password = fromUser.find('#password').val()
      const security = fromUser.find('#security').val()
      const url = $(this).data('url')

      $.ajax({
        url: loginAjax.url,
        type: 'POST',
        data: ({
          action: 'paint_login_from',
          username: userName,
          password: password,
          security: security
        }),
        success: function (result) {
          const { success, data } = result

          if (success) {
            document.location.href = url;
          } else {
            fromUser.prepend(`<p class="text-center txt-error">${data.message}</p>`)
          }
        }
      })
    })
  });

})(jQuery);