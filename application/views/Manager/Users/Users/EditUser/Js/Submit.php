$(document).ready(function() { 
 $('.changepassword').click( function(event){
  $('.changepassword').css('display', 'none');
  $('.ifchangepassword').css('display', 'block');
 });
 $('.generatepassword').click( function(event){
    var password = generate(); 
    $('input[name="password"]').val(password);
    $('input[name="passwordconfirm"]').val(password);
    alert('Пароль сгенерирован, запишите его: ' + password);
 });
});

function rand (min, max)
{
  min = parseInt(min);
  max = parseInt(max);
  return Math.floor( Math.random() * (max - min + 1) ) + min;
}

function generate(length = 8) {
 var chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
 var string = '';
 for (i=0; i<length; i++)
 {
  string += chars.charAt(rand(1, chars.length)); 
 }
 return string;
}

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
 
  formvalues.id              = $('input[name="id"]').val();
  formvalues.username        = $('input[name="username"]').val();
  formvalues.fullname        = $('input[name="fullname"]').val();
  formvalues.email           = $('input[name="email"]').val();
  formvalues.password        = $('input[name="password"]').val();
  formvalues.passwordconfirm = $('input[name="passwordconfirm"]').val();
 
  var url = '<?PHP echo Kohana::$config->load('configsite.url'); ?>/manager/fav/edituser';
  var param = {};
  param.cache = false;
  param.data  = formvalues;
  param.type  = 'POST';
  param.success = response;
  
  $.ajax(url, param);
  
 }