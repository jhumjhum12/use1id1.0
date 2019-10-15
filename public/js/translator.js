document.addEventListener("DOMContentLoaded", function(event) {
  $(".edit-trans").focusout(function(){
    var self = $(this);
    var parentRow = $(this).parents("div.row").first();
    var data = {
      "id": $(this).data("id"),
      'key': $(this).data("key"),
      'lng': $(this).data("lang"),
      'cat': $(this).data("cat"),
      'text': $(this).val().trim()
    };

    if (data.text === '' || data.text === $(this).data("text")) {
      return;
    }

    $.ajax({
      url: "/translator/ajax",
      type: "post",
      dataType: "json",
      data: data,
      success: function(response) {
        //console.log(response);
        if (response.status === 'success' && typeof response.data.new_id !== 'undefined') {
          $(self).attr("data-id", response.data.new_id);
          $(parentRow).find(".success-msg").show();
        } else {
          $(parentRow).find(".error-msg").show();
        }
      },
      error: function(err) {
        console.log("ERROR", err);
      },
    });
  });

  $('div.data-rows').on('keydown', 'input', function(e) {
    var self = $(this)
      , form = self.parents('div.data-rows')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        }
        return false;
    }
  });
});
