<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Singlequestion extends Controller_Common {

 public function action_singlequestion() {
  
  $this->begin();
  
  $questionurl = $this->request->param('questionurl', '1');
  
  $middle = View::factory('Public/Middle/Colons2');
  $question = $this->article($questionurl);
  $this->javascriptcustom($question->componentid);
  $middle->component = $question;
  $mqs = new mqsblockmodule;
  $middle->blockmodules = $mqs->show();
  $cqs = new cqsblockmodule;
  $middle->blockmodules .= $cqs->show();
  
  $this->template->middle = $middle;
    
 }
 
 protected function article($questionurl) {
 
  $view = View::factory('Public/Chunks/SingleQuestion');
  
  $result = Model::factory('Questions')->Showquestion($questionurl);
  
  if(!isset($result->questionid))
  {
	throw new HTTP_Exception_404('Вопрос не найден');
  }
  
  $componentid = 'singlequestion='.$result->url;
  
  if($result->private == '1') {
   
   if($this->auth->logged_in()) {
    
    if($this->user->id == $result->userid) {
     
     $view->logged_in = '1';
     $view->title = $result->title;
     $view->questiondate = $result->created;
     $view->questionannonce = $result->annonce;
     $view->questioncontent = $result->content;
     $view->questioncatid = $result->catid;
     $view->questioncategory = $result->cattitle;
     $view->componentid = $componentid;
     $view->userid = $result->userid;
     $total = Request::factory('countcomments/'.$componentid)->execute();
     $view->total = $total;
     
    }
    else {
     
     $this->redirect('utilites/accessdenied/');
     
    }
   
  }
  else {
   
   $this->redirect('utilites/accessdenied/');

  }
   
  }
  else {
  if($this->auth->logged_in()) {
   
   $view->logged_in = '1';
   $view->title = $result->title;
   $view->questiondate = $result->created;
   $view->questionannonce = $result->annonce;
   $view->questioncontent = $result->content;
   $view->questioncatid = $result->catid;
   $view->questioncategory = $result->cattitle;
   $view->componentid = $componentid;
   $view->userid = $result->userid;
   $total = Request::factory('countcomments/'.$componentid)->execute();
   $view->total = $total;
   
  }
  else {
   
   $view->logged_in = '0';
   $view->title = $result->title;
   $view->questiondate = $result->created;
   $view->questionannonce = $result->annonce;
   $view->questioncontent = $result->content;
   $view->questioncatid = $result->catid;
   $view->questioncategory = $result->cattitle;
   $view->componentid = $componentid;
   $total = Request::factory('countcomments/'.$componentid)->execute();
   $view->total = $total;

  }
  }
  
  return $view;
 }
 
 protected function javascriptcustom($componentid) {
  
  if($this->auth->logged_in()) {
   
  $javascriptcustom = "
  
  function newquestion() {
   window.location.href='/questionnew.html';
  }
  
  function commentsload() {
   $('.comments').load('/comments/".$componentid."/1')
  }
  
  $(document).ready(function() {
  
  $('#wbbeditor').wysibb({
    //Список настроек
    buttons: 'bold,italic,underline,strike,fontcolor,sup,sub,|,justifyleft,justifycenter,justifyright,bullist,|,img,link,video,|,quote,removeFormat'
  });
})
  ";
  
  }
  
  else {
   
   $javascriptcustom = "
  
  function commentsload() {
   $('.comments').load('/comments/".$componentid."/1')
  }
  
  ";
   
  }
  $javascript = &$this->template->javascriptcustom;
  $javascript = '
   <script>
   '.$javascript.$javascriptcustom.'
   </script>';
  
 }
 
 protected function begin() {
    
  $stylesheet = &$this->template->stylesheet;
  $stylesheet = '<link rel="stylesheet" href="/public/css/questions.css" type="text/css" />
  <link rel="stylesheet" href="/public/css/comments.css" type="text/css" />
  <link rel="stylesheet" href="/public/css/wbbtheme.css" type="text/css" />
  <link rel="stylesheet" href="/public/css/jquery.arcticmodal-0.3.css" type="text/css" />
  <link rel="stylesheet" href="/public/css/jquery.arcticmodal.theme.css" type="text/css" />';
  
  $js         = &$this->template->javascriptlib;
  $js         = '
<script type="text/javascript" src="/public/js/jquery-1.9.0.min.js"> </script>
<script src="/public/js/jquery.wysibb.js" charset="utf-8"> </script>
<script src="/public/js/jquery.arcticmodal-0.3.min.js" charset="utf-8"> </script>
<script src="/public/js/comments.js" charset="utf-8"> </script>';
  
  $this->template->menu  = $this->mainmenu(5);
 
 }

}

require_once APPPATH.'classes/Blockmodules/Categoryquestions'.EXT;
require_once APPPATH.'classes/Blockmodules/Managerqustions'.EXT;