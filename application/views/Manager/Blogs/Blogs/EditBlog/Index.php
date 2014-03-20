<h1><?PHP echo $header; ?>:РЕДАКТИРОВАТЬ ПОСТ</h1>
<form id="formsubmit" method="POST" action="<?PHP echo $uripath; ?>blogslist.html">
<div class="col w7">
 <div class="content">
 <div class="formobj">
  <label>Название:</label><input value="<?PHP echo $title; ?>" type="text" name="title" class="text w_30" />
 </div>
 <div class="formobj">
  <label>Псевдоним:</label><input value="<?PHP echo $url; ?>" type="text" name="url" class="text w_30" />
 </div>
 <div class="formobj">
  <label>Запретить/Разрешить комментарии:</label><input type="checkbox" class="checkbox" name="comments" <?PHP echo ($comments == 1) ? 'checked="checked"' : ''; ?> />
 </div>
 <div class="formobj">
  <label style="margin-bottom:-15px;">Анонс:</label><?PHP echo HTML::wysiwyg('annonce', $annonce, TRUE, '160'); ?>
 </div>
 <div class="formobj">
  <label>Содержимое:</label><?PHP echo HTML::wysiwyg('content', $content); ?>
 </div>
 </div>
</div>
<div class="col w3 last">
 <div class="box header">
 <div class="head"><div></div></div>
 <h2>Выбрать тэги</h2>
 <div class="desc">
  <?PHP echo $tags; ?>
 </div>
 <div class="bottom"><div></div></div>
</div> 
</div>
<input type="hidden" name="id" value="<?PHP echo $id; ?>" />
<input type="hidden" name="act" value="edited" />
</form>