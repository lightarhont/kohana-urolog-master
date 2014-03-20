<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Latestcomments extends Controller {
 
 protected $maxlimitcomments = 5;
 protected $maxlimitsymbols = 555;

 public function action_lastcomment() {
 $comments = Model::factory('Comments')->getlastcommentsandusers($this->maxlimitcomments);
 
 $body = '';
 $commentid = 0;
 $strlenstring = 0;
 do {
  $myarray = explode('=', $comments[$commentid]['contenttypeandid']);
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
  $body .= View::factory('Public/Chunks/Latestcomments', $data);
  $commentid = $commentid + 1;
 } while($commentid < $this->maxlimitcomments && $strlenstring < $this->maxlimitsymbols );
 $this->response->body($body);
 }

}