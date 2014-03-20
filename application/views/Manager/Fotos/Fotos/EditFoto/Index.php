<h1>МЕНЕДЖЕР ФОТО:РЕДАКТИРОВАТЬ ИЗОБРАЖЕНИЕ</h1>

<form id="updaterecord" action="manager/fotos/fotoslist.html" method="POST" enctype="multipart/form-data">
  <div style="float: left; margin-bottom: 10px;">
    <img src="<?PHP echo $pathandfilename; ?>" />
  </div>
  <div class="formobj">
   <label for="title">Название:</label>
   <input type="text" name="title" value="<?PHP echo $title; ?>" class="text w_30" />
   <br />
  </div>
  <div class="formobj">
   <label for="desc">Описание:</label>
   <textarea name="desc" cols="55" rows="5"><?PHP echo $description; ?></textarea>
  </div>
  <div class="formobj">
   <label for="category">Категория:</label>
   <select name="category">
    <?PHP echo $categories; ?>
   </select>
  </div>
  <div class="formobj">
    <label for="">Запретить/Разрешить комментарии:</label>
    <input type="checkbox" name="comments" class="checkbox" <?PHP echo ($comments == 1) ? 'checked="checked"' : ''; ?>>
  </div>
  
  <input type="hidden" name="id" value="<?PHP echo $id; ?>" />
  <input type="hidden" name="act" value="edited" />
  
</form>