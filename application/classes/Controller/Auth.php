<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Auth extends Controller {

 protected $auth;
 protected $user;
 protected $session;
 //protected $cookie;
 
 
 public function before() {
  
  parent::before();
  Session::$default = 'database';
  $this->session = Session::instance();
  
  
  $this->auth = Auth::instance();
  $this->user = $this->auth->get_user();
  
  if(isset($_POST['login']) && $_POST['login'] = 'true') {

   $this->submitlogin();
  
  }
 
  
 }
 
 protected function submitlogin() {
 
  $post = $this->validation();
  if (!$this->auth->login($post['username'], $post['password'], FALSE)) {
   Cookie::set('url', $post['loginurl']);
   $this->redirect('utilites/invalidlogin2/');
  } 
  else {
   Cookie::set('url', $post['loginurl']);
   $this->redirect('utilites/login/');
  }
 }
 
 protected function validation() {
  $post = Arr::map('trim', $_POST);
  $post =  Validation::factory($post);
  $post -> rule(TRUE, 'not_empty');
  if($post -> check()) {
   return $post;
  }
  else {
   Cookie::set('url', $post['loginurl']);
   $this->redirect('utilites/invalidlogin/');
  }
 }

}