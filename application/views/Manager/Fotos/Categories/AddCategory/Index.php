<h1><?PHP echo $header; ?>ДОБАВИТЬ КАТЕГОРИЮ</h1>
<form id="createrecord" method="POST" action="manager/fotos/categorieslist.html"  enctype="multipart/form-data">
<p>
 <label for="icon">Взять иконку категории с фото(указать id):</label>
 <input type="text" name="icon" class="text w_5">
</p>
<p>
 <label for="title">Название:</label>
 <input type="text" name="title" class="text w_30">
</p>
<p>
 <label for="desc">Описание:</label>
 <textarea name="desc" cols="55" rows="5"></textarea>
</p>
<p>
 <label for="">Первая категория в списке:</label>
 <input type="checkbox" name="first" class="checkbox">
</p>
<input type="hidden" name="act" value="created" />
</form>