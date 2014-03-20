<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Questions extends Controller_Common {
	
 public $listlimit = 3;
 
 public function action_questions() {
  
  $page   = (int)$this->request->param('page', '1');
  $catid   = (int)$this->request->param('catid', '0');
  
  $this->pageproccesor('5');
  $this->javascriptcustom();
  
  $middle = View::factory('Public/Middle/Colons2');
  
  $middle->component = $this->questionslist($page, $catid);
  $mqs = new mqsblockmodule;
  $middle->blockmodules = $mqs->show();
  $cqs = new cqsblockmodule;
  $middle->blockmodules .= $cqs->show();
  
  $this->template->middle = $middle;
  //View::factory('profiler/stats');
         
 }
 
 protected function javascriptcustom() {
  
  if($this->auth->logged_in()) {
   
  $javascriptcustom = "
  
  function newquestion() {
   window.location.href='/questionnew.html';
  }
  
  ";
  
  }
  
  else {
   
   $javascriptcustom = "";
   
  }
  
  $javascript = &$this->template->javascriptcustom;
  $javascript = '
   <script>
   '.$javascript.$javascriptcustom.'
   </script>';
  
 }
 
 protected function questionslist($page, $catid) {
  
  $modelorm = ORM::factory('Questionsorm');
  
  if(!empty($this->user->id)) {
   if($catid==0) {
    $countlist = $modelorm->where_open()->where('private', '=', '0')->or_where('userid', '=', $this->user->id)->where_close()->count_all();
   }
   else {
    $countlist = $modelorm->where_open()->where('private', '=', '0')->or_where('userid', '=', $this->user->id)->where_close()->where('catid', '=', $catid)->count_all();
   }
  }
  else {
   if($catid==0) {
    $countlist = $modelorm->where('private', '=', '0')->count_all();
   }
   else {
    $countlist = $modelorm->where('private', '=', '0')->where('catid', '=', $catid)->count_all();
   }
  }
  
  $offset = $this->listlimit*$page-$this->listlimit;
  if(!empty($this->user->id)) {
   $results = Model::factory('Questions')->Showquestions($offset, $this->listlimit, $catid, $this->user->id);
  }
  else {
   $results = Model::factory('Questions')->Showquestionsnouser($offset, $this->listlimit, $catid);
  }
  $component = '';
  
  
  foreach($results as $result) {
   
   $componentid = 'singlequestion='.$result->url;
   $totalcomments = Request::factory('countcomments/'.$componentid)->execute();
   
   if(isset($this->user->id) && $result->userid == $this->user->id) {
    $managerquestion = 1;
   }
   else {
    $managerquestion = 0;
   }
   
   $data = array(
    'url' => $result->url,
    'private' => $result->private,
    'title' => $result->title,
    'annonce' => $result->annonce,
    'fullname' => $result->fullname,
    'username' => $result->username,
    'questiondate' => $result->created,
    'cattitle' => $result->cattitle,
    'catid' => $result->catid,
    'totalcomments' => $totalcomments,
    'managerquestion' => $managerquestion
   );
   
   $component .= View::factory('Public/Chunks/Questionlist', $data);
   
  }
  
  $component .= '<div class="pagination">';
  if($catid==0) { 
   $paginationview = 'pagination/custom5';
  }
  else {
   $paginationview = 'pagination/custom6';
  }
  $component .= Pagination::factory(array('total_items' => $countlist, 'view' => $paginationview, 'items_per_page' => $this->listlimit), null, $catid);
  $component .= '</div>';
  
  return $component;
 }

}

require_once APPPATH.'classes/Blockmodules/Categoryquestions'.EXT;
require_once APPPATH.'classes/Blockmodules/Managerqustions'.EXT;