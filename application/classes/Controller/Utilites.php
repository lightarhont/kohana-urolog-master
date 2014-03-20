<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Utilites extends Controller_Template {
 
 public $template = 'Public/System-Message';
 
  public function before()
  {
    parent::before();
	$siteurl = Kohana::$config->load('configsite.url');
	$this->template->siteurl = $siteurl;
  }
 
 public function action_invalidlogin() {

  $redirecturl = Cookie::get('url', 'no url');
  $deleteurl = Cookie::delete('url');
  $pagetitle    = 'Ошибка: Вы не ввели данных в форму';
  $titlemessage = '<span class="mt">Ошибка:</span> Вы не ввели данных в форму!';
  //$redirecturl  = 'http://test4.ru/utilites/invalidlogin';
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = Kohana::$config->load('configsite.url').$redirecturl;
  
 }
 
 public function action_invalidlogin2() {

  $redirecturl = Cookie::get('url', 'no url');
  $deleteurl = Cookie::delete('url');
  $pagetitle    = 'Ошибка: Неправильный логин/пароль';
  $titlemessage = '<span class="mt">Ошибка:</span> Неправильный логин/пароль!';
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = Kohana::$config->load('configsite.url').$redirecturl;
  
 }
 
 public function action_login() {
  
  $redirecturl = Cookie::get('url', 'no url');
  $deleteurl = Cookie::delete('url');
  $pagetitle    = 'Успешно: Вы успешно вошли';
  $titlemessage = '<span class="sf">Успешно:</span> Вы успешно вошли!';
  //$redirecturl  = 'http://test4.ru/utilites/invalidlogin';
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = Kohana::$config->load('configsite.url').$redirecturl;
  
 }
 
 public function action_logout() {
  $pagetitle    = 'Успешно: Вы успешно вышли';
  $titlemessage = '<span class="sf">Успешно:</span> Вы успешно вышли!';
  $redirecturl  = Kohana::$config->load('configsite.url');
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = $redirecturl;
 }
 
 public function action_sfregistration() {
  $pagetitle    = 'Успешно: Вы успешно зарегестрировались';
  $titlemessage = '<span class="sf">Успешно:</span> Вы успешно зарегестрировались!';
  $redirecturl  = Kohana::$config->load('configsite.url');
  $this->template->desc         = 'Вам выслано письмо, с ссылкой, для активации аккаунта';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = $redirecturl;
 }
 
 public function action_sfadquestion() {
  $pagetitle    = 'Успешно: Добавлен новый вопрос';
  $titlemessage = '<span class="sf">Успешно:</span> Добавлен новый вопрос!';
  $redirecturl  = Kohana::$config->load('configsite.url');
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = $redirecturl;
 }
 
 public function action_sfeditquestion() {
  $pagetitle    = 'Успешно: Вопрос отредактирован';
  $titlemessage = '<span class="sf">Успешно:</span> Вопрос отредактирован!';
  $redirecturl  = Kohana::$config->load('configsite.url');
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = $redirecturl;
 }
 
 public function action_sfdeletequestion() {
  $pagetitle    = 'Успешно: Вопрос удалён';
  $titlemessage = '<span class="sf">Успешно:</span> Вопрос удалён!';
  $redirecturl  = Kohana::$config->load('configsite.url');
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = $redirecturl;
 }
 
 public function action_errdeletequestion() {
  $pagetitle    = 'Ошибка: Возникла ошибка при удалении вопроса';
  $titlemessage = '<span class="mt">Ошибка:</span> Возникла ошибка при удалении вопроса!';
  $redirecturl  = Kohana::$config->load('configsite.url');
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = $redirecturl;
 }
 
 public function action_newpassword() {
  $pagetitle    = 'Успешно: Активирован новый пароль';
  $titlemessage = '<span class="sf">Успешно:</span> Активирован новый пароль!';
  $redirecturl  = Kohana::$config->load('configsite.url');
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = $redirecturl;
 }
 
 public function action_noneuser() {
  $pagetitle    = 'Ошибка: Такого пользователя не существует';
  $titlemessage = '<span class="mt">Ошибка:</span> Такого пользователя не существует!';
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = Kohana::$config->load('configsite.url');
 }
 
 public function action_userisbeenact() {
  $pagetitle    = 'Ошибка: Пользователь уже был активирован';
  $titlemessage = '<span class="mt">Ошибка:</span> Пользователь уже был активирован!';
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = Kohana::$config->load('configsite.url');
 }
 
 public function action_useract() {
  $pagetitle    = 'Успешно: Пользователь активирован';
  $titlemessage = '<span class="sf">Успешно:</span> Пользователь активирован!';
  $this->template->desc         = 'Теперь вы можете использовать свой логин и пароль, что-бы зайти на сайт!';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = Kohana::$config->load('configsite.url');
 }
 
 public function action_sfresetpassword() {
  $pagetitle    = 'Успешно: Пароль успешлно сброшен';
  $titlemessage = '<span class="sf">Успешно:</span> Пароль успешлно сброшен!';
  $this->template->desc         = 'Вам отправлено письмо на email с паролем и инструкциями для его активации!';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = Kohana::$config->load('configsite.url');
 }
 
 public function action_accessdenied() {
  $pagetitle    = 'Ошибка: Доступ запрещён';
  $titlemessage = '<span class="sf">Ошибка:</span> Доступ запрещён!';
  $this->template->desc         = '';
  $this->template->pagetitle    = $pagetitle;
  $this->template->titlemessage = $titlemessage;
  $this->template->redirecturl  = Kohana::$config->load('configsite.url');
 }

}