<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog extends Controller_Common {
 
 public $listlimit = 3;
 
 public function action_blog() {
	
  $this->pageproccesor('2');
  $middle = View::factory('Public/Middle/Colons2');
  
  $page   = (int)$this->request->param('page', '1');
  $tag   = (int)$this->request->param('tag', '0');
  
  if($tag == 0) {
    $bloglist = $this->bloglist($page);
  }
  else {
    $bloglist = $this->bloglisttag($tag, $page);	
  }
  $middle->component = $bloglist;
  
  $tags = new Tagsblockmodule;
  $middle->blockmodules = $tags->tags();
  $this->template->middle = $middle;
	 
 }
 
 protected function bloglist($page) {
  
  $model = ORM::factory('Blogslistorm');
     
  $countblogslist = $model->count_all();
     
     $offset = $this->listlimit*$page-$this->listlimit;
     
     $blogslist = $model->offset($offset)->limit($this->listlimit)->order_by('id', 'DESC')->find_all();
     
     if(!isset($blogslist[0]->id))
     {
	throw new HTTP_Exception_404('Блоги не найдены');
     }
     
     $response = '';
     $id = 0;
     
     while($id<count($blogslist)) {
     
     $model2 = ORM::factory('Blogslistorm', $blogslist[$id]->id);
     
     $tags = $model2->tags->find_all();
     
     $thistags = '';
     
     foreach ($tags as $tag) {
        
        $thistags .=  '<a href="blog/tag-'.$tag->id.'/page-1.html">'.$tag->name.'</a>, ';
        
        } 
     
      $thistags = rtrim($thistags, ', ');
      
      $componentid = 'singleblog='.$blogslist[$id]->url;
      $totalcomments = Request::factory('countcomments/'.$componentid)->execute();
      
      $data = array('tags' => $thistags,
                    'url' => $blogslist[$id]->url,
                    'blogtitle' => $blogslist[$id]->title,
                    'totalcomments' => $totalcomments,
                    'blogdate' => $blogslist[$id]->created,
                    'blogannonce' => $blogslist[$id]->annonce);
      $response .= View::factory('Public/Chunks/Bloglist', $data);
      
      $id = $id + 1;
     }
     
     $response .= '<div class="pagination">';
     $response .= Pagination::factory(array('total_items' => $countblogslist, 'view' => 'pagination/custom3', 'items_per_page' => $this->listlimit));
     $response .= '</div>';
     
     return $response;
 }
 
 protected function bloglisttag($tag, $page) {
     
     $model = ORM::factory('Tagsorm', $tag);
     
     $countblogslist = $model->blogslist->count_all();
     
     $offset = $this->listlimit*$page-$this->listlimit;
     
     $blogs = $model->blogslist->offset($offset)->limit($this->listlimit)->order_by('id', 'DESC')->find_all();
     
     if(!isset($blogs[0]->id))
     {
	throw new HTTP_Exception_404('Блоги не найдены');
     }
     
     $taghtml = '<a href="blog/tag-'.$tag.'/page-1.html">'.$model->name.'</a>';
     
     $response = '';
     foreach($blogs as $blog) {
      
      $componentid = 'singleblog='.$blog->url;
      $totalcomments = Request::factory('countcomments/'.$componentid)->execute();
      
      $data = array('tags' => $taghtml,
                    'url' => $blog->url,
                    'blogtitle' => $blog->title,
                    'totalcomments' => $totalcomments,
                    'blogdate' => $blog->created,
                    'blogannonce' => $blog->annonce);
      $response .= View::factory('Public/Chunks/Bloglist', $data);
        
     }
     
     $response .= '<div class="pagination">';
     $response .= Pagination::factory(array('total_items' => $countblogslist, 'view' => 'pagination/custom4', 'items_per_page' => $this->listlimit), null, $tag);
     $response .= '</div>';
     
     return $response;
  
 }
 
}

require_once APPPATH.'classes/Blockmodules/Tags'.EXT;
require_once APPPATH.'classes/Blockmodules/Calendar'.EXT;