<?php defined('SYSPATH') or die('No direct script access.');

class Tagsblockmodule extends Blockmodules {
 
 public function tags() {
 
     $model = ORM::factory('Tagsorm');
     $tags = $model->find_all();
     
     $this->view->title = 'Теги';
     
     $this->view->content = '<div class="alltags"><a href="blog.html">Весь блог</a></div><div class="tags">';
     foreach($tags as $tag) {
      $this->view->content .= '<a href="blog/tag-'.$tag->id.'/page-1.html" >'.$tag->name.'</a>, ';  
     }
     $this->view->content = rtrim($this->view->content, ', ');
     
     $this->view->content .= '</div>';
     
     return $this->view;
 }
 
}