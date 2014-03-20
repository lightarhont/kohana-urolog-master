function response(data) {
    if (data == 'success') {
     $('.fielderror').remove();
     $('#formsubmit').submit();
    }
    else {
    var result
    result = $.parseJSON(data);
    $('.fielderror').remove();
    i=0;
    while (i<5) {
     var error = null;
     switch (i) {
        case 0 :
        if (result.username != null) {
         error = result.username;
        }
        break;
        case 1 :
        if (result.fullname != null) {
         error = result.fullname;
        }
        break;
        case 2 :
        if (result.email != null) {
         error = result.email;
        }
        break;
        case 3 :
        if (result.password != null) {
         error = result.password;
        }
        break;
        case 4 :
        if (result.passwordconfirm != null) {
         error = result.passwordconfirm;
        }
        break;
        default :
        error = 'Error!';    
     }
     if (error !== null) {
      var formobj = null;
      var value = null;
      value = $('.formobj input').eq(i).val();
      formobj = $('.formobj').eq(i).html();
      $('.formobj').eq(i).html(formobj + '<div class="fielderror">' + error + '</div>');
      $('.formobj input').eq(i).val(value);
     }
     i++;
    }
    }
    
}

function formsubmit() {
 
  var formvalues = {};
 
  formvalues.username        = $('input[name="username"]').val();
  formvalues.fullname        = $('input[name="fullname"]').val();
  formvalues.email           = $('input[name="email"]').val();
  formvalues.password        = $('input[name="password"]').val();
  formvalues.passwordconfirm = $('input[name="passwordconfirm"]').val();
 
  var url = '<?PHP echo Kohana::$config->load('configsite.url'); ?>/manager/fav/adduser';
  var param = {};
  param.cache = false;
  param.data  = formvalues;
  param.type  = 'POST';
  param.success = response;
  
  $.ajax(url, param);
  
 }