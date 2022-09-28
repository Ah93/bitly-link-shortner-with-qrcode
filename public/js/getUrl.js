$(document).ready(function () {
  $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

$('body').on('click', '#btn-link', function (event) {
    
  event.preventDefault();
  var link = $("#link").val();

  $('#link-error').text('');

  $.ajax({
    type: "get",
    url: '/get-link',
    dataType: 'json',
    data: {link: link},
    success: function (data) {

      var rows = ' <div class="input-group">\
      <input type="text" class="form-control form-control" id="copy-url"\
          value="'+data.bitlyUrl+'" readonly>\
      <span class="input-group-btn">\
          <button class="btn btn-success btn-copy" type="submit" data-clipboard-target="#copy-url">copy!</button>\
      </span>\
  </div>';
    $("#shortUrl").html(rows);
    // jQuery('#qrcode').qrcode({ 
    //   width: 130,
    //   height: 130,
    //   text: data.bitlyUrl
    // });
    jQuery(function(){
      jQuery('#qrcode').qrcode({ 
      width: 140,
      height: 140,
      text: data.bitlyUrl
    });
      var canvas = $('#output canvas');
      console.log(canvas);
      var img = canvas.get(0).toDataURL("image/png");
      //or
      //var img = $(canvas)[0].toDataURL("image/png");
      document.write('<img src="'+img+'"/>');
  });
    },
    error: function(response){
      $('#link-error').text("You can not reuse the shorten link");
      $('#link-error').text(response.responseJSON.errors.link);
  }
});

});
});