<div class="questionlist">
 <div class="questiontitle"><?PHP echo $title; ?></div>
 <div class="questiondatetags"><div class="questiondate">Опубликованно: <?PHP echo date("Y-m-d H:i", $questiondate); ?></div> <div class="questioncategory">Категория: <a href="questions/catid-<?PHP echo $catid; ?>.html"><?PHP echo $cattitle; ?></a></div></div>
 <div class="questionannonce"><?PHP echo $annonce; ?></div>
 <div class="questionauthor"><a href="#"><?PHP echo $fullname; ?>[<?PHP echo $username; ?>]</a><?PHP if($private == '1') { echo '<span class="anonymous">(анонимно)</span>'; } ?></div>
 <div class="questionoptions"><a href="questionview/<?PHP echo $url; ?>.html" class="first">Подробнее</a> | <a href="questionview/<?PHP echo $url; ?>.html">Комментарии(<?PHP echo $totalcomments; ?>)</a>
 <?PHP if($managerquestion == '1') { ?>
 | <a href="questionedit/<?PHP echo $url; ?>.html">Редактировать</a> | <a href="questiondelete/<?PHP echo $url; ?>.html">Удалить</a>
 <?PHP } ?>
 </div>
</div>