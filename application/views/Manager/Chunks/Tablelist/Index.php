<div class="componentheader"><h1><?PHP echo $header.$customheader; ?></h1></div>
<div class="col w10 last">
  <div class="content" style="margin-top:10px;">
   <div id="actionmessage"></div>
   <form action="" method="POST" id="tablelist">
    <table>
     <tbody>
      <tr>
        <?PHP echo $tableheaders ?>
      </tr>
      <?PHP echo $tablecontent; ?>
     </tbody>
    </table>
    <input type="hidden" name="act" id="act" value="">
   </form>
   <div class="adminpaginationblock">
    <div class="adminpagination"><?PHP echo $pagination; ?></div>
   </div>
  </div>
</div>