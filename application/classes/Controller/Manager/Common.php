<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Manager_Common extends Controller {
 
 protected $auth;
 protected $user;
 protected $session;
 
 protected $template;
 protected $log;
 protected $mainmenuact;
 protected $adminrole = 'admin';
 
 protected $tplactionmenu = 'Actionmenu';
 protected $action;
 protected $configfile = 'manager/';
 
 const GETTEREXT = '_getter'; 
 
 public function before() {
  Session::$default = 'database';
  $this->session = Session::instance();
  $this->auth = Auth::instance();
  if($this->auth->logged_in($this->adminrole)) :
   $this->loginpart();
  else :
   if(isset($_POST['adminlogin'])) :
    $post = Arr::map('trim', $_POST);
    if(!$this->auth->login($post['username'], $post['password'], FALSE)) :
     $this->request->action('login');
    else :
     if(!$this->auth->logged_in($this->adminrole)):
      $this->request->action('login');
     else :
      unset($_POST);
      $this->loginpart();
     endif;
    endif;
   else :
    $this->request->action('login');
   endif;
  endif;
 
 }
 
 private function loginpart()
 {
  
  $this->user = $this->auth->get_user();
  $this->log = Log::instance();
  $this->template = View::factory('Manager/Template');
  $sitetitle = Kohana::$config->load('configsite.sitetitle').'::';
  $siteurl = Kohana::$config->load('configsite.url');
  
  $this->template->base = $siteurl;
  $this->template->sitetitle = $sitetitle;
  $this->template->username = $this->user->username;
  $this->template->jslib = '';
  $this->template->js = '';
  $this->template->jsfunc = '';
  $this->template->css = '';
  $this->template->actionmenu = '';
  $this->beforeclient();
  $this->action = $this->request->action();
  $this->template->mainmenu = $this->mainmenu();
 }
 
 protected function action_login()
 {
  $this->template = View::factory('Manager/Login');
 }
 
 public function __get($name)
 {
  if(method_exists($this, $name.self::GETTEREXT)) :
   $method = $name.self::GETTEREXT;
   return $this->$method();
  endif;
 }
 
 protected function mainmenu()
 {
  
  $menucfg = Kohana::$config->load('managermainmenu');
  
  $menu = '';
  for($i=0; $i<8; $i++) :
   $item = (array)$menucfg[$i];
   $selected = ($this->mainmenuact == $i) ? ' class="selected"' : '';
   $menu .= '<li><a href="'.$item['url'].'"'.$selected.'><span>'.$item['title'].'</span></a></li>';
  endfor;
  
  return $menu;
 
 }
 
 public function after() {
  if($this->auth->logged_in($this->adminrole)) :
   $this->afterclient();
   if($this->template->js !== ''):
    $this->template->js = '$(document).ready( function() { 
                          '.$this->template->js.'
                          });
                          ' . $this->template->jsfunc;
   else:
    $this->template->js = $this->template->jsfunc;
   endif;
  endif;
  
  $this->response->body($this->template);
 }
 
 protected $chunkspath = 'Manager/Chunks/';
 
 protected function tableview($customheader, $tablecontent, $pagination)
 {
  
  $tableheaders = View::factory($this->cvpath.'Th');
  
  $data = array('customheader' => $customheader,
                'tableheaders' => $tableheaders,
                'tablecontent' => $tablecontent,
                'pagination'   => $pagination);
  
  return View::factory($this->chunkspath.'Tablelist/Index', $data);
  
 }
 
 protected function submitformjs()
 {
  
  return View::factory($this->chunkspath.'Add/Js/Submit');
  
 }
 
 protected function bildmenu()
 {
   
  $actionmenu = View::factory($this->cvpath.$this->tplactionmenu);
  $this->template->actionmenu = $actionmenu;
  
 }
 
 protected function generate($length = 8)
 {
   
  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) :
   $string .= substr($chars, rand(1, $numChars) - 1, 1);
  endfor;
  return $string;
  
  }
 
 abstract public function beforeclient();
 
 abstract public function afterclient(); 
 
 protected function orm_getter()
 {
  return Kohana::$config->load($this->configfile.'.'.$this->action.'.orm');
 }
 
 protected function cvpath_getter()
 {
  return Kohana::$config->load($this->configfile.'.'.$this->action.'.path');
 }
 
 protected function param_getter()
 {
  return Kohana::$config->load($this->configfile.'.'.$this->action);
 }
 
 protected function listlimit_getter()
 {
  return Kohana::$config->load($this->configfile.'.'.$this->action.'.listlimit');
 }
 
 protected function options_getter()
 {
  return Kohana::$config->load($this->configfile);
 }
 
}
