<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_Index extends Controller_Manager_Common {
    
 public function beforeclient()
 {
  
  $this->mainmenuact = 10;
  
 }
 
 public function action_index() {
  $this->template->middle = 'this'; 
 }
 
 public function action_logout()
 {
  
  $this->auth->logout(TRUE);
  $this->redirect('manager/');
  
 }
 
 public function afterclient()
 {
 }
 
}