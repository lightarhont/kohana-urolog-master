<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Chunks_Login extends Controller_Auth {
 
 public function action_index() {
  
  if ($this->auth->logged_in()) {
  $user = $this->user;
  $useroptions = View::factory('Public/Chunks/UserOptions');
  $useroptions->username = $user->username;
  $this->response->body($useroptions);
  }
  else {
  $showlogin = View::factory('Public/Chunks/FormLogin');
  $this->response->body($showlogin);
  }
 }
 
 public function action_logout() {
  $this->auth->logout(TRUE);
  $this->redirect('utilites/logout/');
 }
 
 public function action_access() {
  $this->response->body('');
 }
 
}