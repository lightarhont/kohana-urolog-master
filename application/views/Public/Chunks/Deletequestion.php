<style>
div.deletequestion {
 float: left;
 clear: both;
 padding-top: 30px;
 height: 500px;
}

div.deletequestion h3 {
font-family:Arial, Helvetica, sans-serif;
font-size:16px;
font-weight: bold;
float:left;
clear:both;
margin-left:50px;
margin-top:0px;
margin-bottom:0px;
}

div.deletequestionnotice {
 float: left;
 clear: both;
 margin-top: 20px;
 margin-left: 50px;
}

div.deletequestionsubmit {
 float: left;
 clear: both;
 margin-top: 25px;
 margin-left: 270px;
}
</style>

<div class="deletequestion">
 <h3>Удаление:</h3>
 <?PHP echo Form::open('questiondeletepost.html', array('method' => 'post', 'id' => 'deletequestion')); ?>
 <div class="deletequestionnotice">Вы собираетесь удалить вопрос: <a target="_blank" href="questionview/<?PHP echo $url; ?>.html"><?PHP echo $deletetitle; ?></a><br />
 Подтвердите ваше намерение:
 </div>
 <input type="hidden" name="deleteid" value="<?PHP echo $deleteid; ?>" />
 <div class="deletequestionsubmit">
  <?PHP echo Form::formsubmit('Удалить вопрос', 'deletequestion'); ?>
 </div>
<?PHP echo Form::close(); ?>
</div>