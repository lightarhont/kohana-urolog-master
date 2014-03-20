<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Remember extends Controller_Common {

 public function action_rememberpassword () {
  $this->begin();
  
  $middle = View::factory('Public/Chunks/Rememberpass');
  
  $middle->error_username  = '';
  $middle->error_email     = '';
  
  $middle->value_username     = '';
  $middle->value_email        = '';
  
  $middle->error_qaptcha   = '<span>Перетащите ползунок вперёд, до упора!</span>';
  $this->template->middle  = $middle;
 }
 
 public function action_rememberpasswordpost () {
  $this->begin();
  
  $post = Arr::map('trim', $_POST);
  
  if(empty($post['username']) && empty($post['email'])) {
   
   $this->rememberpasswordempty();
   
  }
  else {
   if(!empty($post['username']) && !empty($post['email'])) {
   
    $this->rememberpasswordnotempty($post);
   
   }
   else {
  
    if(empty($post['username'])) {
   
     $this->rememberpasswordemptyusr($post);
   
    }
    else {
   
     $this->rememberpasswordemptymil($post);
   
    }
	
   }
   
  }
  
 }
  
  protected function rememberpasswordnotempty($post) {
  
   $post = Validation::factory($post);
   $post 
         -> rule('email', 'email')
         -> rule('username', 'alpha_dash', array(':value', TRUE));
   
   $qaptcha = Cookie::get('qaptcha_key', 'none');
   $delqaptcha = Cookie::delete('qaptcha_key');
   
   if($post->check() && $qaptcha !== 'none') {
   
    $this->searchuseremail('emailandusername', $post);
   
   }
   
   else {
   
    $this->validationerrors($post, $qaptcha);
   
   }
  
  }
 
  protected function rememberpasswordemptymil($post) {
  
   $post = Validation::factory($post);
   $post 
         -> rule('username', 'alpha_dash', array(':value', TRUE));
   
   $qaptcha = Cookie::get('qaptcha_key', 'none');
   $delqaptcha = Cookie::delete('qaptcha_key');
   
   if($post->check() && $qaptcha !== 'none') {
   
    $this->searchuseremail('username', $post);
   
   }
   
   else {
   
    $this->validationerrors($post, $qaptcha);
   
   }
   
  }
  
  protected function rememberpasswordemptyusr($post) {
   
   $post = Validation::factory($post);
   $post
         -> rule('email', 'email');
   
   $qaptcha = Cookie::get('qaptcha_key', 'none');
   $delqaptcha = Cookie::delete('qaptcha_key');
   
   if($post->check() && $qaptcha !== 'none') {
   
    $this->searchuseremail('email', $post);
   
   }
   
   else {
   
    $this->validationerrors($post, $qaptcha);
   
   }
   
  }
  
  protected function searchuseremail ($operator, $post) {
  
   $usermodel   = ORM::factory('Usersite');
   
   switch($operator) {
    
	case 'emailandusername':
	 
	 $issetuser  = $usermodel
                 ->where('username', '=', $post['username'])
				 ->where('email', '=', $post['email'])
		         ->find();
	 
	 break;
	 
	case 'username':
	
	 $issetuser  = $usermodel
                 ->where('username', '=', $post['username'])
		         ->find();
				 
	 break;
	 
	case 'email':
	
	 $issetuser  = $usermodel
				 ->where('email', '=', $post['email'])
		         ->find();
				 
	 break;
   
   }
   
   if(isset($issetuser->id) && !empty($issetuser->id)) {
    
    $resetpassmodel  = ORM::factory('Resetpassorm');
	
	$find         = $resetpassmodel 
	              ->where('user_id', '=', $issetuser->id)
	              ->find();
	
	if(isset($find->id) && !empty($find->id)) {
				  
	 $find->delete();
	
	}
	
	$lifetime = time() + 86400;
	
	$url_key     = $this->generate(13);
	$newpassword = $this->generate(8);
	
	$resetpassmodel
	    ->set('user_id', $issetuser->id)
		->set('url_key', $url_key)
        ->set('newpassword', $newpassword)
		->set('lifetime', $lifetime)
		->create();
	
	$config = Kohana::$config->load('email');
    email::connect($config);
	
	$to      = $issetuser->email;
    $subject = 'Сброс пароля на сайте '.Kohana::$config->load('configsite.url');
    $from    = Kohana::$config->load('configsite.siteemail');
    $message = 'Кто-то, возможно вы('.$issetuser->username.') сбросил(а) пароль. 
	
	Новый пароль будет:
	'.$newpassword.'
	
	В том случае, если его подтвердить - перейдя по ссылке для его активации:
	'.Kohana::$config->load('configsite.url').'/activationpassword/'.$url_key.'.html
	
	Иначе, система удалит его по истечении 24 часов!';
	
	Email::send($to, $from, $subject, $message, $html = false);
	
	$this->redirect('utilites/sfresetpassword/');
   
   }
   
   else {
   
    $this->usernotfound($post);
   
   }
   
  }
  
  protected function generate($length = 8){
   
   $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
   $numChars = strlen($chars);
   $string = '';
   for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
   }
   return $string;
  
  }
  
  protected function validationerrors ($post, $qaptcha) {
  
   $middle = View::factory('Public/Chunks/Rememberpass');
   
   $middle->error_username  = '';
   $middle->error_email     = '';
   
   $middle->value_username     = '';
   $middle->value_email        = '';
   
   $errors = $post->errors('comments');
   
   if(!empty($post['username'])) {
    $middle->value_username = $post['username'];
   }
   
   if(!empty($post['email'])) {
    $middle->value_email = $post['email'];
   }
   
   if(isset($errors['username'])) {
   $middle->error_username  = $errors['username'];
   }
   
   if(isset($errors['email'])) {
   $middle->error_email     = $errors['email'];
   }
   
   if($qaptcha == 'none') {
    $middle->error_qaptcha = '<span class="error_qaptcha">Вы не прошли тест системы защиты!</span>';
   }
   else {
    $middle->error_qaptcha = '<span>Перетащите ползунок вперёд, до упора!</span>';
   }
   
   $this->template->middle  = $middle;
  
  }
  
  protected function usernotfound ($post) {
   
   $middle = View::factory('Public/Chunks/Rememberpass');
   
   $middle->error_username  = 'Пользователь с такими данными не найден';
   $middle->error_email     = 'Пользователь с такими данными не найден';
   
   $middle->value_username     = '';
   $middle->value_email        = '';
   
   if(!empty($post['username'])) {
    $middle->value_username = $post['username'];
   }
   
   if(!empty($post['email'])) {
    $middle->value_email = $post['email'];
   }
   
   $middle->error_qaptcha   = '<span>Перетащите ползунок вперёд, до упора!</span>';
   $this->template->middle  = $middle;
   
  }
  
  protected function rememberpasswordempty () {
   
   $middle = View::factory('Public/Chunks/Rememberpass');
   
   $middle->error_username  = 'Имя пользователя не должно быть пустым';
   $middle->error_email     = 'Электроная почта не должно быть пустым';
   
   $middle->value_username     = '';
   $middle->value_email        = '';
   
   $middle->error_qaptcha   = '<span>Перетащите ползунок вперёд, до упора!</span>';
   $this->template->middle  = $middle;
   
  }
 
  protected function begin () {
  
  if( Auth::instance()->logged_in() ) {
  
   $this->redirect('utilites/accessdenied/');
  
  }
  
  $stylesheet = &$this->template->stylesheet;
  $stylesheet = '<link rel="stylesheet" href="/public/css/remember.css" type="text/css" />
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