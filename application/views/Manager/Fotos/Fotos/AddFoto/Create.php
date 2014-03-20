<h1>МЕНЕДЖЕР ФОТО:СОЗДАНИЕ ЗАПИСИ ИЗОБРАЖЕНИЯ</h1>

<form id="createrecord" action="manager/fotos/fotoslist.html" method="POST" enctype="multipart/form-data">
  <div>
    <img src="<?PHP echo $pathandfilename; ?>" />
  </div>
  <p>
   <label for="title">Название:</label>
   <input type="text" name="title" value="" class="text w_30" />
   <br />
  </p>
  <p>
   <label for="desc">Описание:</label>
   <textarea name="desc" cols="55" rows="5"></textarea>
  </p>
  <p>
   <label for="category">Категория:</label>
   <select name="category">
    <?PHP echo $categories; ?>
   </select>
  </p>
  <p>
    <label for="">Запретить/Разрешить комментарии:</label>
    <input type="checkbox" name="comments" class="checkbox">
  </p>
  
  
  <input type="hidden" name="imagesnames" value="<?PHP echo $filename; ?>" />
  <input type="hidden" name="act" value="created" />
  
</form>