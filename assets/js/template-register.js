(function ($) {
  "use strict";

  $(document).ready(function () {
    new Cleave('#phone-number', {
      numericOnly: true,
      blocks: [3, 4, 4],
      delimiter: ''
    });
  });

})(jQuery);