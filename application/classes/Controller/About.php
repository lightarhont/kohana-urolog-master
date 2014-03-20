<?php defined('SYSPATH') or die('No direct script access.');

class Controller_About extends Controller_Common {
 
 public function action_about() {
	
    $this->pageproccesor('1');
    
    $this->template->middle = $this->about();
	 
 }
 
 protected function about() {
  
  $view = View::factory('Public/Chunks/AboutPage');
  
  return $view;
 }
 
}