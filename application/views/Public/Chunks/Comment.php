<div class="comment">
 <div class="info">
  <div class="itemid"><a href="#">#<?PHP echo $id; ?></a></div><div class="username"><a id="uc<?PHP echo $commentid; ?>" href="javascript: void(0);"><?PHP echo $username; ?></a></div> <div id="dc<?PHP echo $commentid; ?>" class="datetime"><?PHP echo date("Y-m-d H:i", $datetime); ?></div>
  <?PHP echo $options; ?>
 </div>
 <div class="titlecomment" id="tc<?PHP echo $commentid; ?>"><?PHP echo $title; ?></div>
 <div class="bodycomment" id="bc<?PHP echo $commentid; ?>"><?PHP echo $content; ?></div>
</div>