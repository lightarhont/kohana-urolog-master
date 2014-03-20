<h1><?PHP echo $header; ?>:НОВЫЙ ПОСТ</h1>
<form id="formsubmit" method="POST" action="<?PHP echo $uripath; ?>blogslist.html">
<div class="col w7">
 <div class="content">
 <div class="formobj">
  <label>Название:</label><input type="text" name="title" class="text w_30" />
 </div>
 <div class="formobj">
  <label>Псевдоним:</label><input type="text" name="url" class="text w_30" />
 </div>
 <div class="formobj">
  <label>Запретить/Разрешить комментарии:</label><input type="checkbox" class="checkbox" name="comments" />
 </div>
 <div class="formobj">
  <label style="margin-bottom:-15px;">Анонс:</label><?PHP echo HTML::wysiwyg('annonce', 'test', TRUE, '160'); ?>
 </div>
 <div class="formobj">
  <label>Содержимое:</label><?PHP echo HTML::wysiwyg('content', 'test'); ?>
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
<input type="hidden" name="act" value="created" />
</form>