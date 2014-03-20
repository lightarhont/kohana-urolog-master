<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Ajaxauth extends Controller_Auth {
 
 public $template = NULL;
 
 public function before() {
 
 parent::before();
 $this->template = View::factory('Public/Blank');
 
 $login = Request::factory('Chunks_Login/access')->execute();
 $this->template->login = $login;
 }
 
 public function after() {
 $this->response->body($this->template);
 parent::after();
 }

}