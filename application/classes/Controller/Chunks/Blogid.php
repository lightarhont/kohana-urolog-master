<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Blogid extends Controller_Ajaxauth {
 
 public function action_article() {
  
  $blogurl = $this->request->param('blogurl', '1');
  
  $model = ORM::factory('Blogslistorm');
  $result = $model->where('url', '=', $blogurl)->find();
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
  
  $response = json_encode(array('title'  => $result->title,
                                'componentid' => $componentid,
                                'singleblog' => serialize($view)));
  
  $this->template->body = $response;
  
 } 
    
}
