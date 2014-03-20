<?php defined('SYSPATH') or die('No direct script access.');

class Lcsblockmodule extends Blockmodules {
 
 protected $maxlimitcomments = 5;
 protected $maxlimitsymbols = 555;
 
 public function Latestcomments () { 
  
 $comments = Model::factory('Comments')->getlastcommentsandusers($this->maxlimitcomments);
 
 $this->view->content = '';
 $commentid = 0;
 $strlenstring = 0;
 do {
  $myarray = explode('=', $comments[$commentid]['contenttypeandid']);
  if($myarray[0] == 'singlequestion') {
   $commentid = $commentid + 1;
  }
  else {
  $url = Kohana::$config->load('componentscomments.'.$myarray[0].'.url');
  $contenttype = Kohana::$config->load('componentscomments.'.$myarray[0].'.desc');
  $urlid = $url.$myarray[1].'.html';
  
  $commentbody = strip_tags($comments[$commentid]['comment']);
  //$commentbody = Text::limit_words($commentbody, 9); 
  $commentbody = Text::limit_chars($commentbody, 250, NULL, TRUE);
  
  $strlenstring += strlen($commentbody);
  $strlenstring += strlen($comments[$commentid]['title']);
  $strlenstring += strlen($comments[$commentid]['contenttitle']);
  
  $data = array(
          'commentid'    => ($commentid + 1),
          'datetime'     => $comments[$commentid]['created'],
          'username'     => $comments[$commentid]['username'],
          'contenttitle' => $comments[$commentid]['contenttitle'],
          'contenttype'  => $contenttype,
          'commenttitle' => $comments[$commentid]['title'],
          'commentbody'  => $commentbody,
          'contenturl'   => $urlid
                );
  $this->view->content .= View::factory('Public/Chunks/Latestcomments', $data);
  $commentid = $commentid + 1;
  }
 } while($commentid < $this->maxlimitcomments && $strlenstring < $this->maxlimitsymbols );
  
  $this->view->title = 'Последние комментарии';
  
  $this->view->classmodulemaincont = 'showcommens';
  $this->view->classmoduletitle = 'ht3-306';
  $this->view->classmodulecontentcont = 'cont460-322';
  $this->view->idmodulecontentcont = '';
  
  return $this->view;
 }
 
}