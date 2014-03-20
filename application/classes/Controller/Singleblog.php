<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Singleblog extends Controller_Common {

 public function action_singleblog() {
  
  $this->begin();
  
  $blogurl = $this->request->param('blogurl', '1');
  
  $middle = View::factory('Public/Middle/Colons2');
  $bloglist = $this->article($blogurl);
  $middle->component = $bloglist;
  $sitetitle = &$this->template->sitetitle;
  $sitetitle = $sitetitle.$bloglist->title;
  $this->javascriptcustom($bloglist->componentid);
  $tags = new Tagsblockmodule;
  $middle->blockmodules = $tags->tags();
  
  $this->template->middle = $middle;
 
 }
 
 protected function article($blogurl) {
  
  $model = ORM::factory('Blogslistorm');
  $result = $model->where('url', '=', $blogurl)->find();
  if(!$result->loaded())
  {
	throw new HTTP_Exception_404('Блог не найден');
  }
  $view = View::factory('Public/Chunks/SingleBlog');
  if($this->auth->logged_in()) {
   $view->logged_in = '1';
   $view->title = $result->title;
   $view->blogdate = $result->created;
  
   $model2 = ORM::factory('Blogslistorm', $result->id);
  
   $tags = $model2->tags->find_all();
     
     $thistags = '';
     
     foreach ($tags as $tag) {
        
        $thistags .=  '<a href="blog/tag-'.$tag->id.'/page-1.html">'.$tag->name.'</a>, ';
        
        }
    
    $thistags = rtrim($thistags, ', ');
        
   $view->tags = $thistags;
   $view->blogannonce = $result->annonce;
   $view->blogcontent = $result->content;
   $componentid = 'singleblog='.$result->url;
   $view->componentid = $componentid;
   $view->userid = $this->user->id;
   $total = Request::factory('countcomments/'.$componentid)->execute();
   $view->total = $total;
  
  }
  else {
   $view->logged_in = '0';
   $view->title = $result->title;
   $view->blogdate = $result->created;
  
   $model2 = ORM::factory('Blogslistorm', $result->id);
  
   $tags = $model2->tags->find_all();
     
     $thistags = '';
     
     foreach ($tags as $tag) {
        
        $thistags .=  '<a href="blog/tag-'.$tag->id.'/page-1.html">'.$tag->name.'</a>, ';
        
        }
     
     $thistags = rtrim($thistags, ', ');
     
   $view->tags = $thistags;
   $view->blogannonce = $result->annonce;
   $view->blogcontent = $result->content;
   $componentid = 'singleblog='.$result->url;
   $view->componentid = $componentid;
   
   $total = Request::factory('countcomments/'.$componentid)->execute();
   $view->total = $total;
  }
  
  return $view;
 }
 
 protected function javascriptcustom($componentid) {
  
  if($this->auth->logged_in()) {
   
  $javascriptcustom = "
  
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
  
  if($this->auth->logged_in()) {
  
  $stylesheet = &$this->template->stylesheet;
  $stylesheet = '<link rel="stylesheet" href="/public/css/blog.css" type="text/css" />
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
  
  }
  else {
   
  $stylesheet = &$this->template->stylesheet;
  $stylesheet = '<link rel="stylesheet" href="/public/css/blog.css" type="text/css" />
  <link rel="stylesheet" href="/public/css/comments.css" type="text/css" />';
  $js         = &$this->template->javascriptlib;
  $js         = '
<script type="text/javascript" src="/public/js/jquery-1.9.0.min.js"> </script>
<script src="/public/js/comments.js" charset="utf-8"> </script>';
   
  }
  
  $this->template->menu  = $this->mainmenu(2);
  
 }
 
}

require_once APPPATH.'classes/Blockmodules/Tags'.EXT;