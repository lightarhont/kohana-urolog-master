<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?PHP echo $pagetitle; ?></title>
<base href="http://test4.ru/">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/public/js/jquery-1.9.0.min.js"> </script>
<?PHP if($logged_in == '1') { ?>
<script src="/public/js/jquery.wysibb.js" charset="utf-8"> </script>
<script src="/public/js/jquery.arcticmodal-0.3.min.js" charset="utf-8"> </script>
<?PHP } ?>
<script src="/public/js/comments.js" charset="utf-8"> </script>
<script>
 
function commentsload() {
 $('.comments').load('/comments/<?PHP echo $componentid; ?>/1')
} 
<?PHP if($logged_in == '1') { ?>

$(document).ready(function() {
  $('#wbbeditor').wysibb({
    //Список настроек
    buttons: 'bold,italic,underline,strike,fontcolor,sup,sub,|,justifyleft,justifycenter,justifyright,bullist,|,img,link,video,|,quote,removeFormat'
  });
})
<?PHP } ?>

  
</script>
<link rel="stylesheet" href="/public/css/comments.css" type="text/css" />
<link rel="stylesheet" href="/public/css/fotoid.css" type="text/css" />
<link rel="stylesheet" href="/public/css/wbbtheme.css" type="text/css" />
<link rel="stylesheet" href="/public/css/jquery.arcticmodal-0.3.css" type="text/css" />
<link rel="stylesheet" href="/public/css/jquery.arcticmodal.theme.css" type="text/css" />

</head>
<body>
<div class="mainframe">
<div class="img"><img src="/public/usr/root/foto/fullimgs/<?PHP echo $full_img ?>" /></div>
<div class="title" style="width:616px;"><?PHP echo $name; ?></div>
<div class="desc" style="width:616px;"><?PHP echo $description; ?></div>
<?PHP if($logged_in == '1') { ?>
<div class="adcommentform" style="width:616px;">
<div class="commentingform">

<div id="result">
</div>

<div id="messagertimer">Ограничение в 3 секунды при отправке новых комментариев!</div>
<form id="adcomment">
 <div class="titlecomment"> <label>Тема:</label> <input type="text" name="title" /></div>
 <div class="bodycomment"><textarea name="comment" id="wbbeditor"></textarea></div>
 <input id="componentid" type="hidden" value="<?PHP echo $componentid; ?>" />
 <input id="titlecontent" type="hidden" value="<?PHP echo $name; ?>" />
 <input id="userid" type="hidden" value="<?PHP echo $userid; ?>" />
 <input id="updateid" type="hidden" value="0" />
 <div class="submit-button"><?PHP echo Form::formsubmitajax('Оставить комментарий', 'adcomment'); ?></div>
</form>

</div>
</div>
<?PHP } ?>
<div class="comments" style="width:616px;"><?PHP if($total=='0') { ?><div style="text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Тут ещё нет комментариев!</div><?PHP } else { ?><div onclick="commentsload();" class="commentsload"> <div class="showcomments">Показать комментарии</div> <div class="num"><?PHP echo $total; ?></div> </div><?PHP } ?></div>
</div>

</body>
</html>