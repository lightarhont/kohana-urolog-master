<div class="<?PHP echo $classmodulemaincont; ?>">
 <div class="ht">
  <div class="ht2">
   <div class="<?PHP echo $classmoduletitle; ?>">
    <?PHP echo $title; ?>
   </div>
  </div>
 </div>
 <div <?PHP if($idmodulecontentcont=='') {} else { ?>id="<?PHP echo $idmodulecontentcont; ?>" <?PHP } ?> class="<?PHP echo $classmodulecontentcont; ?>">
 <?PHP echo $content; ?>
 </div>
</div>