<h1><?PHP echo $header; ?>:НОВЫЙ ТЭГ</h1>
<form id="formsubmit" method="POST" action="<?PHP echo $uripath; ?>tagslist.html">
<div class="col w10">
 <div class="content">
  <div class="formobj">
   <label>Название:</label><input value="<?PHP echo $title; ?>" type="text" name="title" class="text w_30" />
  </div>
 </div> 
</div>
<input type="hidden" name="id" value="<?PHP echo $id; ?>" />
<input type="hidden" name="act" value="edited" />
</form>