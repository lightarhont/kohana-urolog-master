<?php defined('SYSPATH') or die('No direct script access.');

class Lbsblockmodule extends Blockmodules {
 
 public function latestblogs() {
  
  $model = ORM::factory('Blogslistorm');
  
  $blogslist = $model->limit(1)->order_by('id', 'DESC')->find_all();
  $response = '';
     $id = 0;
     
     while($id<count($blogslist)) {
     
     $model2 = ORM::factory('Blogslistorm', $blogslist[$id]->id);
     
     $tags = $model2->tags->find_all();
     
     $thistags = '';
     
     foreach ($tags as $tag) {
        
        $thistags .=  '<a href="blog/tag-'.$tag->id.'/page-1.html">'.$tag->name.'</a>, ';
        
        } 
     
      
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
  $this->view->content = $response;
  
  $this->view->title = 'Новое в блоге';
  
  $this->view->classmodulemaincont = 'showblog';
  $this->view->classmoduletitle = 'ht3-587';
  $this->view->classmodulecontentcont = 'cont400';
  $this->view->idmodulecontentcont = '';
  
  return $this->view;
 }
 
}