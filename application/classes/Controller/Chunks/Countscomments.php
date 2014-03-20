<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Countscomments extends Controller {
 
  public function action_index() {
  
  $componentid = $this->request->param('componentid', '0');
  
  $commentscount = ORM::factory('Commentsorm');
  
  $total = $commentscount
            ->where('thread', '=', $componentid)
            ->count_all();
  
  $this->response->body($total);
  
 }

}