(function ($) {
  "use strict";

  $(document).ready(function () {
    $('.btn-user-save').on('click', function () {
      const postId = $(this).data('post-id')

      $.ajax({
        url: userSaveAjax.url,
        type: 'POST',
        data: ({
          action: 'paint_user_saved',
          postId: postId
        }),
        beforeSend: function () {

        },
        success:function (response) {

        },
        complete: function () {

        }
      })
    })
  })

})(jQuery)