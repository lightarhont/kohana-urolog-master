<h1><?PHP echo $header; ?>РЕДАКТИРОВАТЬ КАТЕГОРИЮ</h1>
<form id="updaterecord" method="POST" action="manager/fotos/categorieslist.html"  enctype="multipart/form-data">
<p>
 <label for="icon">Изменить изображение:</label>
 <input type="text" name="icon" value="<?PHP echo $icon; ?>" class="text w_10">
</p>
<p>
 <label for="title">Название:</label>
 <input type="text" name="title" value="<?PHP echo $title; ?>" class="text w_30">
</p>
<p>
 <label for="desc">Описание:</label>
 <textarea name="desc" cols="55" rows="5"><?PHP echo $desc; ?></textarea>
</p>
<p>
 <label for="">Первая категория в списке:</label>
 <input type="checkbox" name="first" class="checkbox" <?PHP echo ($catdefault == 1) ? 'checked="checked"' : ''; ?>>
</p>
<input type="hidden" name="id" value="<?PHP echo $id; ?>" />
<input type="hidden" name="act" value="edited" />
</form>