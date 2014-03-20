<div class="comment">
<div class="commentinfo">
  <div class="commentid">#<?PHP echo $commentid; ?></div><div class="commentdate"><?PHP echo date("Y-m-d H:i", $datetime); ?></div><div class="commentusername"><?PHP echo $username; ?></div><div class="commentsubject"> прокомментировал(а) <?PHP echo $contenttype; ?>: <a target="_blank" href="<?PHP echo $contenturl; ?>"><?PHP echo $contenttitle; ?></a></div>
</div>
<div class="commentcontent">
 <div class="commenttitle"><?PHP echo $commenttitle; ?></div>
 <div class="commentbody"><?PHP echo $commentbody; ?></div>
</div>
</div>