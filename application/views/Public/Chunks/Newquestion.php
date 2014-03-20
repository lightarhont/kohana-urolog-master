<style>
div.newquestionpage {
 float: left;
 clear: both;
 margin-top: 30px;
 margin-bottom: 50px;
}

div.newquestionpage h3 {
font-family:Arial, Helvetica, sans-serif;
font-size:16px;
font-weight: bold;
float:left;
clear:both;
margin-left:50px;
margin-top:0px;
margin-bottom:0px;
}

div.newquestionpage label {
float:left;
margin-top:4px;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
width: 250px;
}

div.newquestionpage form {
 float: left;
 clear: both;
 margin-top: 20px;
}

div.newquestiontitle {
 float: left;
 clear: both;
 margin-left:50px;
 margin-bottom: 10px;
}

div.newquestiontitle input {
border:#dddddd 1px solid;
float:left;
width: 363px;
}

div.newquestiondesc {
 float: left;
 clear: both;
 margin-left:50px;
 margin-bottom: 20px;
 width: 616px;
}

div.newquestioncontlabel {
    float: left;
    clear: both;
    margin-left:50px;
    margin-bottom: 5px;
    font-family:Arial, Helvetica, sans-serif;
    font-size:14px;
}

div.newquestioncont {
 float: left;
 clear: both;
 margin-left:50px;
 margin-bottom: 20px;
 width: 616px;
}

div.newquestioncats {
 float: left;
 clear: both;
 margin-left:50px;
 margin-bottom: 10px;
}

div.newquestioncats select {
border:#dddddd 1px solid;
float:left; 
}

div.newquestionhidden {
 float: left;
 clear: both;
 margin-left:50px;
 margin-bottom: 30px;
}

div.newquestionsubmit {
 float: left;
 clear: both;
 margin-left:450px;
 margin-bottom: 30px;
}

div.errortitle, div.errordesc, div.errorcont {
 float: left;
 clear: both;
 font-family:Arial, Helvetica, sans-serif;
 font-size: 13px;
 color: red;
}
</style>

<div class="newquestionpage">

<h3><?PHP echo $modetitle; ?>:</h3>

<?PHP echo Form::open('questionnewpost.html', array('method' => 'post', 'id' => 'adquestion')); ?>
    
 <div class="newquestiontitle"><label>Заголовок вопроса:</label><input name="title" type="text" <?PHP echo $titlepost; ?>/>
 <div class="errortitle"><?PHP echo $errortitle; ?></div>
 </div>
 
 <div class="newquestiondesc"><textarea name="desc" id="wbbeditor1"><?PHP echo $descpost; ?></textarea>
 <div class="errordesc"><?PHP echo $errordesc; ?></div>
 </div>
 
 <div class="newquestioncontlabel">Подробно (уберётся под кат):</div>
 <div class="newquestioncont"><textarea name="cont" id="wbbeditor2"><?PHP echo $contpost; ?></textarea>
 <div class="errorcont"><?PHP echo $errorcont; ?></div>
 </div>
 
 <div class="newquestioncats"><label>Категория вопроса:</label><select name="catid"><?PHP echo $catsselect; ?></select></div>
 <div class="newquestionhidden"><label>Сделать вопрос анонимным:</label><input name="private" type="checkbox" disabled="disabled" <?PHP echo $privatepost; ?>/></div>
 <input type="hidden" name="userid" value="<?PHP echo $userid; ?>" />
 <input type="hidden" name="created" value="<?PHP echo time(); ?>" />
 <input type="hidden" name="mode" value="<?PHP echo $mode; ?>" />
 <div class="newquestionsubmit"><?PHP echo Form::formsubmitfunc('Задать вопрос', 'adquestion', 'adquestionpost'); ?></div>
 
<?PHP echo Form::close(); ?>

</div>