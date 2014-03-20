<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Newquestion extends Controller_Common {

 public function action_newquestion() {
  
  $this->begin();
  
  if( !$this->auth->logged_in() ) {
  
   $this->redirect('utilites/accessdenied/');
  
  }
  
  $sitetitle = &$this->template->sitetitle;
  $sitetitle = $sitetitle.'Новый вопрос';
  
  $middle = View::factory('Public/Middle/Colon');
  $this->javascriptcustom();
  $middle->component = $this->adquestion();
  $this->template->middle = $middle;
  
 }
 
 public function action_newquestionpost() {
  
  
  $post = Arr::map('trim', $_POST);
  $post = Validation::factory($post);
  $post 
        -> rule('title', 'not_empty')
        -> rule('desc', 'not_empty');
  
  
  if($post->check()) {
   if($post['mode'] == 'new') {
    $this->inserttodb($post);
   }
   else {
    $this->updatetodb($post);
   }
  }
  else {
  
  $this->begin();
  
  $sitetitle = &$this->template->sitetitle;
  $sitetitle = $sitetitle.'Новый вопрос::Ошибки при заполнении формы';
  
  $middle = View::factory('Public/Middle/Colon');
  $this->javascriptcustom();
  $middle->component = $this->adquestionerror($post);
  $this->template->middle = $middle;
  
  }
  
 }
 
 public function action_deletequestionpost() {
  
  try { 
   $post = Arr::map('trim', $_POST);
   ORM::factory('Questionsorm', $post['deleteid'])->delete();
   
   $this->redirect('utilites/sfdeletequestion/');
  }
  catch(Exception $e) { 
   $this->redirect('utilites/errdeletequestion/');
  }
  
 }
 
 public function action_editquestion() {
  $this->begin();
  $sitetitle = &$this->template->sitetitle;
  $sitetitle = $sitetitle.'Редактировать вопрос';
  
  $middle = View::factory('Public/Middle/Colon');
  $this->javascriptcustom();
  $middle->component = $this->editquestion();
  
  $this->template->middle = $middle;
 }
 
 public function action_deletequestion() {
 
  $stylesheet = &$this->template->stylesheet;
  $stylesheet = '<link rel="stylesheet" href="/public/css/questions.css" type="text/css" />';
  
  $menu  = Request::factory('Chunks_Menu/index/6')->execute();
  $this->template->menu  = $menu;
  
  $sitetitle = &$this->template->sitetitle;
  $sitetitle = $sitetitle.'Удалить вопрос';
  
  $middle = View::factory('Public/Middle/Colon');
  $middle->component = $this->deletequestion();
  
  $this->template->middle = $middle;
 }
 
 protected function generate($length = 8){
   
   $chars = 'abdefhiknrstyz123456789';
   $numChars = strlen($chars);
   $string = '';
   for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
   }
   return $string;
  
 }

 protected function updatetodb($post) {
  $modelorm   = ORM::factory('Questionsorm', $post['mode']);
  
  if(isset($post['private'])) {
   $private = 1;
  }
  else {
   $private = 0;
  }
  
  $result     = $modelorm
                ->set('catid', $post['catid'])
                ->set('userid', $post['userid'])
                ->set('private', $private)
                ->set('url', $this->generate().$post['created'])
                ->set('title', $post['title'])
                ->set('annonce', $post['desc'])
                ->set('content', $post['cont'])
                ->set('created', $post['created'])
		->update();
  
  $this->redirect('utilites/sfeditquestion/');
 }
 
 protected function inserttodb($post) {
  
  $modelorm   = ORM::factory('Questionsorm');
  
  if(isset($post['private'])) {
   $private = 1;
  }
  else {
   $private = 0;
  }
  
  $result     = $modelorm
                ->set('catid', $post['catid'])
                ->set('userid', $post['userid'])
                ->set('private', $private)
                ->set('url', $this->generate().$post['created'])
                ->set('title', $post['title'])
                ->set('annonce', $post['desc'])
                ->set('content', $post['cont'])
                ->set('created', $post['created'])
		->save();
  
  $this->redirect('utilites/sfadquestion/');
  
 }
 
 protected function adquestionerror($post) {
  
  $view = View::factory('Public/Chunks/Newquestion');
  
  if($post['mode'] == 'new') {
   $view->modetitle = 'Новый вопрос';
  }
  else {
   $view->modetitle = 'Редактирование';
  }
  
  if(!empty($post['title'])) {
   $view->titlepost = 'value="'.$post['title'].'"';;
  }
  else {
   $view->titlepost = '';
  }
  
  $view->descpost = $post['desc'];
  $view->contpost = $post['cont'];
  
  if(isset($post['private'])) {
   $view->privatepost = 'checked="checked"';
  }
  else {
   $view->privatepost = '';
  }
  
  $view->mode = $post['mode'];
  
  $errors = $post->errors('comments');
  
  $view->errortitle = '';
  $view->errordesc = '';
  $view->errorcont = '';
  
  if(isset($errors['title'])) {
   $view->errortitle   = $errors['title'];
  }
  
  if(isset($errors['desc'])) {
   $view->errordesc   = $errors['desc'];
  }
  
  if(isset($errors['cont'])) {
   $view->errorcont   = $errors['cont'];
  }
  
  $view->userid = $this->user->id;
  $view->catsselect = $this->catselect($post['catid']);
  
  return $view;
  
 }
 
 protected function deletequestion() {
  
  $view = View::factory('Public/Chunks/Deletequestion');
  
  $questionurl = $this->request->param('questionurl', '1');
  $modelorm   = ORM::factory('Questionsorm');
  $result = $modelorm->where('url', '=', $questionurl)->find();
  
  $this->accessdenied($result->userid);
  
  $view->deletetitle = $result->title;
  $view->url         = $result->url;
  $view->deleteid    = $result->id;
  
  return $view;
 }
 
 protected function editquestion() {
  
  $view = View::factory('Public/Chunks/Newquestion');
  
  $questionurl = $this->request->param('questionurl', '1');
  $modelorm   = ORM::factory('Questionsorm');
  $result = $modelorm->where('url', '=', $questionurl)->find();
  
  $this->accessdenied($result->userid);
  
  $view->modetitle = 'Редактирование';
  $view->titlepost = 'value="'.$result->title.'"';
  $view->descpost = $result->annonce;
  $view->contpost = $result->content;
  
  if($result->private == '1') {
   $view->privatepost = 'checked="checked"';
  }
  else {
   $view->privatepost = '';
  }
  
  $view->mode = $result->id;
  
  $view->errortitle = '';
  $view->errordesc = '';
  $view->errorcont = '';
  
  $view->userid = $result->userid;
  $view->catsselect = $this->catselect($result->catid);
  
  return $view;
 }
 
 protected function catselect($selectedid) {
  
  $modelorm = ORM::factory('Catsquestionsorm');
  
  $results = $modelorm->find_all();
  
  $catsselect = ''; 
  foreach($results as $result) {
   
   if($result->id == $selectedid) {
    $catsselect .= '<option value="'.$result->id.'" selected="selected">'.$result->title.'</option>';
   }
   else {
    $catsselect .= '<option value="'.$result->id.'">'.$result->title.'</option>';
   }
   
  }
  
  return $catsselect;
 }
 
 protected function adquestion() {
    
  $view = View::factory('Public/Chunks/Newquestion');
  
  $view->modetitle = 'Новый вопрос';
  $view->titlepost = '';
  $view->descpost = '';
  $view->contpost = '';
  $view->privatepost = '';
  
  $view->mode = 'new';
  
  $view->errortitle = '';
  $view->errordesc = '';
  $view->errorcont = '';
  
  $view->userid = $this->user->id;
  $view->catsselect = $this->catselect('5');
  
  return $view;
 }
 
 protected function javascriptcustom() {
  
  if($this->auth->logged_in()) {
   
  $javascriptcustom = "
  
  $(document).ready(function() {
  
  $('#wbbeditor1').wysibb({
    buttons: 'bold,italic,underline,strike,fontcolor,sup,sub,|,justifyleft,justifycenter,justifyright,bullist,|,img,link,video,|,quote,removeFormat'
  });
  
  $('#wbbeditor2').wysibb({
    buttons: 'bold,italic,underline,strike,fontcolor,sup,sub,|,justifyleft,justifycenter,justifyright,bullist,|,img,link,video,|,quote,removeFormat'
  });

})

function adquestionpost(adquestion) {
 $('#wbbeditor1').sync();
 $('#wbbeditor2').sync();
 $('#' + adquestion).submit();
}
  ";
  
  }
  
  else {
   
   $javascriptcustom = "
  
  ";
   
  }
  $javascript = &$this->template->javascriptcustom;
  $javascript = '
   <script>
   '.$javascript.$javascriptcustom.'
   </script>';
  
 }
 
 protected function accessdenied($userid) {
  
  if( !$this->auth->logged_in()) {
  
   $this->redirect('utilites/accessdenied/');
  
  }
  else {
   
   if ($this->user->id == $userid) { 
   
   }
   else {
    $this->redirect('utilites/accessdenied/');
   }
   
  }
  
 }
 
 protected function begin() {
 
  $stylesheet = &$this->template->stylesheet;
  $stylesheet = '<link rel="stylesheet" href="/public/css/questions.css" type="text/css" />
  <link rel="stylesheet" href="/public/css/wbbtheme.css" type="text/css" />';
  
  $js         = &$this->template->javascriptlib;
  $js         = '
<script src="/public/js/jquery-1.9.0.min.js"> </script>
<script src="/public/js/jquery.wysibb.js" charset="utf-8"> </script>';
 
  $this->template->menu  = $this->mainmenu(5);
 }

}