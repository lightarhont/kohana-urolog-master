<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Tagslist extends Controller {
    
    public function action_showtags() {
     $model = ORM::factory('Tagsorm');
     $tags = $model->find_all();
     $result = '<div class="alltags"><a href="blog.html">Весь блог</a></div><div class="tags">';
     foreach($tags as $tag) {
      $result .= '<a href="blog/tag-'.$tag->id.'/page-1.html" >'.$tag->name.'</a>, ';  
     }
     $result = rtrim($result, ', ');
     
      $result .= '</div>';
     $this->response->body($result); 
    }
}