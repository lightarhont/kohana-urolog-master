<div class="singleblog">
 <div class="blogtitle"><?PHP echo $title; ?></div>
 <div class="blogdatetags"><div class="blogdate">Опубликованно: <?PHP echo $blogdate; ?></div> <div class="blogtags">Тэги: <?PHP echo $tags; ?></div></div>
 <div class="blogannonce"><?PHP echo $blogannonce; ?></div>
 <div class="blogcontent"><?PHP echo $blogcontent; ?></div>
 <div class="blogcomments">
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
 <input id="titlecontent" type="hidden" value="<?PHP echo $title; ?>" />
 <input id="userid" type="hidden" value="<?PHP echo $userid; ?>" />
 <input id="updateid" type="hidden" value="0" />
 <div class="submit-button"><?PHP echo Form::formsubmitajax('Оставить комментарий', 'adcomment'); ?></div>
 </form>

 </div>
 </div>
  <?PHP } ?>
<div class="comments" style="width:616px;"><?PHP if($total=='0') { ?><div style="text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Тут ещё нет комментариев!</div><?PHP } else { ?><div onclick="commentsload();" class="commentsload"> <div class="showcomments">Показать комментарии</div> <div class="num"><?PHP echo $total; ?></div> </div><?PHP } ?></div>

 </div>

</div>

