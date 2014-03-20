<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Форма POST</title>
<base href="http://test4.ru/">
<script type="text/javascript" src="/public/js/jquery-1.8.2.min.js"> </script>
<script src="/public/js/jquery.wysibb.js" charset="utf-8"></script>
<script>


$(document).ready(function() {

   var wbbOpt = {
    allButtons: {
     quote: {
      transform: {
        '<div class="quote">{SELTEXT}</div>':'[quote]{SELTEXT}[/quote]',
        '<div class="quote"><cite>{AUTHOR} написал:</cite>{SELTEXT}</div>':'[quote={AUTHOR}]{SELTEXT}[/quote]'
      }
     }
   }
  }
  
  $('#wbbeditor').wysibb({
    //Список настроек
    buttons: 'bold,italic,underline,sup,sub,|,img,link,video,|,quote,smilebox'
  });
})

function submitajax(adcomment) {
 $("#wbbeditor").sync();
 
 var titleis    = $('.titlecomment input').val();
 var commentis  = $('.bodycomment textarea').val();
 var comidis    = $('#componentid').val();
 var useridis   = $('#userid').val();
 $.post("commentpost.html",
   { title: titleis, comment: commentis, userid: useridis, comid: comidis },
   function(data){
    if(data == '<ul><li class="ready">Комментарий успешно добавлен!</li></ul>') {
	 $('#adcomment').css('display', 'none');
	 $('#messagertimer').css('display', 'block');
	 setTimeout(comentready, 3000);
	}
    $("#result").html(data);
   }
  );

}

function comentready() {

 	 $('#adcomment').css('display', 'block');
	 $('#messagertimer').css('display', 'none');
	 $('.titlecomment input').val('');
	 $('.bodycomment textarea').val('');
	 
	 $("#wbbeditor").clearEmpty();

}

</script>

<link rel="stylesheet" href="/public/css/wbbtheme.css" type="text/css" />

<style>
div.btn1 {
padding-left:7px;
background-image:url(/public/images/form/b1.gif);
background-repeat:no-repeat;
cursor:pointer;
}

div.btn2 {
background-image:url(/public/images/form/b2.gif);
background-repeat:no-repeat;
background-position:right;
padding-right:7px;
}

div.btn3 {
background-image:url(/public/images/form/t3.gif);
background-repeat:repeat-x;
background-color:#f0f0f0;
}

div.btn4 {
height:28px;
background-image:url(/public/images/form/t3.gif);
background-repeat:repeat-x;
background-position:bottom;
font-family:Arial, Helvetica, sans-serif;
font-size:16px;
font-weight:bold;
padding-left:8px;
padding-right:8px;
padding-top:8px;
}

div.submit-button {
float:left;
clear:both;
padding-left:300px;
}

#adcomment label {
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
float:left;
margin-right:20px;
}

div.titlecomment {
float:left;
clear:both;
margin-bottom:10px;
}

div.bodycomment {
float:left;
clear:both;
margin-bottom:10px;
}

#adcomment input {
border:#dddddd 1px solid;
float:left;
width:346px;
}

#messagertimer {
display:none;
}

</style>
</head>
<body>
<div id="result"></div>
<div id="messagertimer">Ограничение в 3 секунды при отправке новых комментариев!</div>
<form id="adcomment">
 <div class="titlecomment"> <label>Тема:</label> <input type="text" name="title" /></div>
 <div class="bodycomment"><textarea name="comment" id="wbbeditor"></textarea></div>
 <input id="componentid" type="hidden" value="<?PHP echo $componentid; ?>" />
 <input id="userid" type="hidden" value="<?PHP echo $userid; ?>" />
 <div class="submit-button"><?PHP echo Form::formsubmitajax('Далее', 'adcomment'); ?></div>
</form>
</body>
</html>