<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Registr extends Controller_Common {

 public function action_registration() {
  
  $this->begin();
  $sitetitle = &$this->template->sitetitle;
  $sitetitle = $sitetitle.'Регистрация';
  $middle = View::factory('Public/Chunks/Registration');
  
  $middle->value_fullname  = '';
  $middle->value_username  = '';
  $middle->value_email     = '';
  
  $middle->error_fullname  = '';
  $middle->error_username  = '';
  $middle->error_password  = '';
  $middle->error_passwordconfirm = '';
  $middle->error_email     = '';
  $middle->error_qaptcha   = '<span>Перетащите ползунок вперёд, до упора!</span>';
  $this->template->middle  = $middle;
  
 }
 
  public function action_registrationpost() {
  
  $this->begin();
  
  $post = Arr::map('trim', $_POST);
  $post = Validation::factory($post);
  $post 
        -> rule('fullname', 'not_empty')
        -> rule('username', 'not_empty')
        -> rule('password', 'not_empty')
        -> rule('passwordconfirm', 'not_empty')
        -> rule('email', 'not_empty')
        -> rule('fullname', 'min_length', array(':value', 3))
        -> rule('fullname', 'max_length', array(':value', 20))
		-> rule('fullname', 'alpha_dash', array(':value', TRUE))
		-> rule('username', 'min_length', array(':value', 3))
        -> rule('username', 'max_length', array(':value', 20))
		-> rule('username', 'alpha_dash', array(':value', TRUE))
		-> rule('password', 'min_length', array(':value', 5))
        -> rule('password', 'max_length', array(':value', 13))
		-> rule('password', 'alpha_numeric', array(':value', TRUE))
		-> rule('passwordconfirm', 'matches', array(':validation', 'passwordconfirm', 'password'))
		-> rule('email', 'email');
  
  $qaptcha = Cookie::get('qaptcha_key', 'none');
  $delqaptcha = Cookie::delete('qaptcha_key');
  
  if($post->check() && $qaptcha !== 'none') {
   $dbvalid = $this->check_user_email($post);
   if($dbvalid['issetuser'] == 1 || $dbvalid['issetemail'] == 1) {
    $middle = $this->isset_user_email($post, $dbvalid);
   }
   else {
    $middle = $this->insertuser($post);
   }
  }
  else {
   $middle = $this->validationerrors($post, $qaptcha);
  }
  
  $this->template->middle  = $middle; 
 }
 
 protected function insertuser($post) {
  
  $usermodel   = ORM::factory('Usersite');
  $insertuser  = $usermodel
			   ->set('email', $post['email'])
			   ->set('fullname', $post['fullname'])
			   ->set('username', $post['username'])
			   ->set('password', hash_hmac('sha256', $post['password'], 'wigbble'))
			   ->save();
			   
  $config = Kohana::$config->load('email');
  Email::connect($config);
  
  $userenc = Encrypt::instance()->encode($post['username']);
  
    $to      = $post['email'];
    $subject = 'Регистрация пользователя на сайте '.Kohana::$config->load('configsite.url');
    $from    = Kohana::$config->load('configsite.siteemail');
    $message = 'Пользователь '.$post['username'].' успешно зарегестрирован. Для активации аккаунта перейдите по ссылке:
	'.Kohana::$config->load('configsite.url').'/activation/'.$userenc.'.html';
 
    email::send($to, $from, $subject, $message, $html = false);
	
	$this->redirect('utilites/sfregistration/');
  
 }

 protected function check_user_email($post) {
 
   $usermodel   = ORM::factory('Usersite');
   $issetuser   = $usermodel
                ->where('username', '=', $post['username'])
		        ->count_all();
	
   $issetemail  = $usermodel
                ->where('email', '=', $post['email'])
		        ->count_all();
				
   return array('issetuser' => $issetuser, 'issetemail' => $issetemail);
 } 
 
 protected function isset_user_email($post, $dbvalid) {
  $sitetitle = &$this->template->sitetitle;
  $sitetitle = $sitetitle.'Регистрация::Пользователь или email с такими данными уже зарегестрированы в системе';
  
   $middle = View::factory('Public/Chunks/Registration');
   
   $middle->value_fullname  = $post['fullname'];
   $middle->value_username  = $post['username'];
   $middle->value_email     = $post['email'];
   
   $middle->error_fullname  = '';
   if($dbvalid['issetuser'] = 1) {
    $middle->error_username  = 'Такой пользователь уже зарегестрирован в системе!';
   }
   else {
    $middle->error_username  = '';
   }
   $middle->error_password  = '';
   $middle->error_passwordconfirm = '';
   if($dbvalid['issetemail'] = 1) {
    $middle->error_email     = 'Такой email уже зарегестрирован в системе!';
   }
   else {
    $middle->error_email     = '';
   }
      
   return $middle;
 }
 
 
 protected function validationerrors($post, $qaptcha) {
 
   $sitetitle = &$this->template->sitetitle;
   $sitetitle = $sitetitle.'Регистрация::Ошибки при заполнении формы';
   
   $middle = View::factory('Public/Chunks/Registration');
   $middle->error_fullname  = '';
   $middle->error_username  = '';
   $middle->error_password  = '';
   $middle->error_passwordconfirm = '';
   $middle->error_email     = '';
   
   $middle->value_fullname  = $post['fullname'];
   $middle->value_username  = $post['username'];
   $middle->value_email     = $post['email'];
   
   $errors = $post->errors('comments');
   if(isset($errors['fullname'])) {
   $middle->error_fullname   = $errors['fullname'];
   }
   if(isset($errors['username'])) {
   $middle->error_username   = $errors['username'];
   }
   if(isset($errors['password'])) {
   $middle->error_password   = $errors['password'];
   }
   if(isset($errors['passwordconfirm'])) {
   $middle->error_passwordconfirm  = $errors['passwordconfirm'];
   }
   if(isset($errors['email'])) {
   $middle->error_email      = $errors['email'];
   }
   
   if($qaptcha == "none") {
    $middle->error_qaptcha = '<span class="error_qaptcha">Вы не прошли тест системы защиты!</span>';
   }
   else {
    $middle->error_qaptcha = '<span>Перетащите ползунок вперёд, до упора!</span>';
   }
   
   return $middle;
 }
 
 protected function begin () {
 
 if( Auth::instance()->logged_in() ) {
  
   $this->redirect('utilites/accessdenied/');
  
 }
  
  $stylesheet = &$this->template->stylesheet;
  $stylesheet = '<link rel="stylesheet" href="/public/css/registration.css" type="text/css" />
<link rel="stylesheet" href="/public/css/qaptcha.jquery.css" type="text/css" />';
  $js         = &$this->template->javascriptlib;
  $js         = '
<script type="text/javascript" src="/public/js/jquery-1.8.2.min.js"> </script>
<script type="text/javascript" src="/public/js/jquery-ui.js"> </script>
<script type="text/javascript" src="/public/js/jquery.ui.touch.js"> </script>
<script type="text/javascript" src="/public/js/qaptcha.jquery.js"> </script>';
  $this->template->menu  = $this->mainmenu(8);
  
 }

}